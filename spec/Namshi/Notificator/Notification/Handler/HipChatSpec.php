<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\HipChat\HipChatNotification;
use PhpSpec\ObjectBehavior;

class HipChatSpec extends ObjectBehavior
{
    /**
     * @param \HipChat\HipChat $hipChatClient
     */
    function let($hipChatClient)
    {
        $this->beConstructedWith($hipChatClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\HipChat');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    function it_should_handle_hipchat_notifications_only()
    {
        $hipChatNotification = new HipChatNotification('a', 'b', []);
        $otherNotification = new EmailNotification('a', []);
        if (!$this->getWrappedObject()->shouldHandle($hipChatNotification)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
    }
}
