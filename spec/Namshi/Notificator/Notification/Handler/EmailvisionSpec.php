<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotification;
use PhpSpec\ObjectBehavior;

class EmailvisionSpec extends ObjectBehavior
{
    /**
     * @param \Namshi\Notificator\Notification\Email\Emailvision\ClientInterface $client
     */
    function let($client)
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
        $emailvisionNotification = new EmailvisionNotification('a', 'b', []);
        $otherNotification = new EmailNotification('a', []);
        if (!$this->getWrappedObject()->shouldHandle($emailvisionNotification)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
    }

    /**
     * @param \Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotification $notification
     * @param \Namshi\Notificator\Notification\Email\Emailvision\ClientInterface $client
     */
    function it_handles_emailvision_notification($notification, $client)
    {
        $notification->getEmailTemplate()->willReturn('template')->shouldBeCalled();
        $notification->getRecipientAddress()->willReturn('recipient')->shouldBeCalled();
        $notification->getParameters()->willReturn(['s', 'i'])->shouldBeCalled();

        $this->handle($notification)->shouldBe(true);

        $client->sendEmail(
            'template',
            'recipient',
            ['s', 'i']
        )->shouldBeCalled();
    }
}
