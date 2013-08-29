<?php

namespace spec\Namshi\Notificator\Notification\Email;

use Cordoval\PhpSpec\ObjectBehaviorComplete;

class EmailNotificationSpec extends ObjectBehaviorComplete
{
    function let()
    {
        $this->beConstructedWith('recipient', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Email\EmailNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\Email\EmailNotificationInterface');
    }
}