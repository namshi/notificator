<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\Email\Emailvision\ClientInterface;
use Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotification;
use PhpSpec\ObjectBehavior;

class EmailvisionSpec extends ObjectBehavior
{
    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\Emailvision');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    function it_should_handle_emailvision_notifications_only()
    {
        $emailvisionNotification = new EmailvisionNotification('a', ['b'], []);
        $otherNotification = new EmailNotification(['a'], []);
        if (!$this->getWrappedObject()->shouldHandle($emailvisionNotification)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
    }

    function it_handles_emailvision_notification(EmailvisionNotification $notification, ClientInterface $client)
    {
        $notification->getEmailTemplate()->willReturn('template')->shouldBeCalled();
        $notification->getRecipientAddresses()->willReturn(['recipient'])->shouldBeCalled();
        $notification->getParameters()->willReturn(['s', 'i'])->shouldBeCalled();

        $this->handle($notification)->shouldBe(true);

        $client->sendEmail(
            'template',
            'recipient',
            ['s', 'i']
        )->shouldBeCalled();
    }
}
