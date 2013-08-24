<?php

namespace spec\Namshi\Notificator\Messaging\RabbitMQ\Symfony2;

use PhpAmqpLib\Message\AMQPMessage;
use PhpSpec\ObjectBehavior;

class ConsumerSpec extends ObjectBehavior
{
    /**
     * @param \Namshi\Notificator\ManagerInterface $manager
     */
    function let($manager)
    {
        $this->beConstructedWith($manager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Messaging\RabbitMQ\Symfony2\Consumer');
    }

    /**
     * @param \Namshi\Notificator\ManagerInterface $manager
     * @param \Namshi\Notificator\Notification $notification
     */
    function it_process_message_implementing_message_interface($manager, $notification)
    {
        $notification->setMessage('hello');
        $amqpMessage = new AMQPMessage(serialize($notification));
        $this->execute($amqpMessage)->shouldReturn('AAA');
    }
}
