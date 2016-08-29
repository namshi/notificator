<?php

namespace spec\Namshi\Notificator\Notification\NotifySend;

use PhpSpec\ObjectBehavior;

class NotifySendNotificationSpec extends ObjectBehavior
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