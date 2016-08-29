<?php

namespace spec\Namshi\Notificator\Notification\HipChat;

use PhpSpec\ObjectBehavior;

class HipChatNotificationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('message', 'from', 'room', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\HipChat\HipChatNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\HipChat\HipChatNotificationInterface');
    }
}