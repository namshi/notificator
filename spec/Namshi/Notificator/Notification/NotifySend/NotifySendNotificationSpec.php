<?php

namespace spec\Namshi\Notificator\Notification\NotifySend;

use Cordoval\PhpSpec\ObjectBehaviorComplete;

class NotifySendNotificationSpec extends ObjectBehaviorComplete
{
    function let()
    {
        $this->beConstructedWith('message', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\NotifySend\NotifySendNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\NotifySend\NotifySendNotificationInterface');
    }
}