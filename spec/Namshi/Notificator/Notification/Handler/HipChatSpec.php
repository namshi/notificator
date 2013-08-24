<?php

namespace spec\Namshi\Notificator\Notification\Handler;

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

    /**
     * @param \Namshi\Notificator\Notification\HipChat\HipChatNotificationInterface $hipChatNotification
     * @param \Namshi\Notificator\Notification\Email\EmailNotificationInterface $otherNotification
     */
    function it_should_handle_hipchat_notifications_only($hipChatNotification, $otherNotification)
    {
        $this->object->shouldHandle($hipChatNotification)->shouldReturn(true);
        $this->object->shouldHandle($otherNotification)->shouldReturn(false);
    }
}
