<?php

namespace spec\Namshi\Notificator\Messaging\RabbitMQ\Symfony2;

use Namshi\Notificator\ManagerInterface;
use Namshi\Notificator\Notification;
use PhpAmqpLib\Message\AMQPMessage;
use PhpSpec\ObjectBehavior;

class ConsumerSpec extends ObjectBehavior
{

    function let(ManagerInterface $manager)
    {
        $this->beConstructedWith($manager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Messaging\RabbitMQ\Symfony2\Consumer');
    }

    function it_process_message_implementing_message_interface(ManagerInterface $manager)
    {
        $notification = new Notification('hello');
        $amqpMessage = new AMQPMessage(serialize($notification));

        $manager->trigger($notification)->willReturn('AAA');

        $this->execute($amqpMessage)->shouldReturn('AAA');
    }

    function it_throws_exception_when_message_does_not_implement_interface()
    {
        $notification = new \StdClass('hello');
        $amqpMessage = new AMQPMessage(serialize($notification));

        $this
            ->shouldThrow(new \InvalidArgumentException('The body of the AMQP must be a serialized instance of Namshi\Notificator\NotificationInterface'))
            ->duringExecute($amqpMessage)
        ;
    }
}
