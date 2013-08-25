<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\Handler\NotifySend;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;
use PhpSpec\ObjectBehavior;

class NotifySendSpec extends ObjectBehavior
{
    /**
     * @param \Symfony\Component\Process\ExecutableFinder $finder
     */
    function let($finder)
    {
        $this->beConstructedWith($finder);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\NotifySend');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    /**
     * @param \Symfony\Component\Process\ExecutableFinder $finder
     */
    function it_should_handle_notifysend_notifications_only($finder)
    {
        $notification = new NotifySendNotification('message', []);
        $otherNotification = new EmailNotification('recipient', []);
        $finder->find(NotifySend::NOTIFY_SEND_COMMAND)->willReturn(true);
        if (!$this->getWrappedObject()->shouldHandle($notification)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
        $finder->find(NotifySend::NOTIFY_SEND_COMMAND)->willReturn(null);
        if ($this->getWrappedObject()->shouldHandle($notification)) {
            throw new \Exception('fails');
        }
    }
}
