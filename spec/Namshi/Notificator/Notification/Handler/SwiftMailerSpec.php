<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotification;
use Namshi\Notificator\Notification\Email\SwiftMailer\SwiftMailerNotification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SwiftMailerSpec extends ObjectBehavior
{
    /**
     * @param \Swift_Mailer $mailer
     */
    function let($mailer)
    {
        $this->beConstructedWith($mailer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\SwiftMailer');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    function it_should_handle_swiftmailer_notifications_only()
    {
        $notification = new SwiftMailerNotification(new \Swift_Message(), []);
        $otherNotification = new EmailNotification(['a'], []);
        if (!$this->getWrappedObject()->shouldHandle($notification)) {
            throw new \Exception('fails, does not handle');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails, handles too much :)');
        }
    }

    /**
     * @param \Namshi\Notificator\Notification\Email\SwiftMailer\SwiftMailerNotification $notification
     * @param \Swift_Message $message
     * @param \Swift_Mailer $mailer
     */
    function it_handles_emailvision_notification($notification, $message, $mailer)
    {
        $notification->getMessage()->willReturn($message)->shouldBeCalled();
        $this->handle($notification)->shouldBe(true);
        $mailer->send($message)->shouldBeCalled();
    }
}
