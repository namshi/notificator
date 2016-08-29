<?php

namespace spec\Namshi\Notificator\Notification\RabbitMQ;

use PhpSpec\ObjectBehavior;

class RabbitMQNotificationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('message', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\RabbitMQ\RabbitMQNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\RabbitMQ\RabbitMQNotificationInterface');
    }
}