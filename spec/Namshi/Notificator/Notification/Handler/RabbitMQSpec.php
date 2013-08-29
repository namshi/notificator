<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\RabbitMQ\RabbitMQNotification;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RabbitMQSpec extends ObjectBehavior
{
    /**
     * @param \PhpAmqpLib\Channel\AMQPChannel $publisher
     */
    function let($publisher)
    {
        $this->beConstructedWith($publisher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\RabbitMQ');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    function it_should_handle_rabbitmq_notifications_only()
    {
        $notification = new RabbitMQNotification('message', []);
        $otherNotification = new EmailNotification('recipient', []);
        if (!$this->getWrappedObject()->shouldHandle($notification)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
    }

    /**
     * @param \PhpAmqpLib\Channel\AMQPChannel $publisher
     * @param \Namshi\Notificator\Notification\RabbitMQ\RabbitMQNotification $notification
     */
    function it_handles_rabbitmq_notification($publisher, $notification)
    {
        $publisher->basic_publish(Argument::any())->willReturn(Argument::any())->shouldBeCalled();
        $notification->getMessage()->willReturn('message')->shouldBeCalled();
        $this->handle($notification);
    }
}
