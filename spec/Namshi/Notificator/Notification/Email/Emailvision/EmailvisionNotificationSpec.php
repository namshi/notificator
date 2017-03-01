<?php

namespace spec\Namshi\Notificator\Notification\Email\Emailvision;

use PhpSpec\ObjectBehavior;

class EmailvisionNotificationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('template', ['recipient'], []);
    }


    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Email\EmailNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotificationInterface');
    }
}