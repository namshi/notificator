<?php

namespace spec\Namshi\Notificator\Notification\RabbitMQ;

use Cordoval\PhpSpec\ObjectBehaviorComplete;

class RabbitMQNotificationSpec extends ObjectBehaviorComplete
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