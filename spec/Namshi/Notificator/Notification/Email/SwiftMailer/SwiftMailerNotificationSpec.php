<?php

namespace spec\Namshi\Notificator\Notification\Email\SwiftMailer;

use Cordoval\PhpSpec\ObjectBehaviorComplete;

class SwiftMailerNotificationSpec extends ObjectBehaviorComplete
{
    function let()
    {
        $this->beConstructedWith(new \Swift_Message(), []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\NotificationInterface');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\Email\SwiftMailer\SwiftMailerNotificationInterface');
    }
}