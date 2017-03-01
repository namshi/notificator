<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use HipChat\HipChat;
use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\HipChat\HipChatNotification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HipChatSpec extends ObjectBehavior
{
    function let(HipChat $hipChatClient)
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
        $otherNotification   = new EmailNotification(['a'], []);

        if (!$this->getWrappedObject()->shouldHandle($hipChatNotification)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
    }

    function it_handles_hipchat_notifications(HipChatNotification $hipChatNotification, Hipchat $hipChatClient)
    {
        $hipChatNotification->getParameter(Argument::any())->willReturn('something');
        $hipChatNotification->getHipChatRoom()->willReturn('something');
        $hipChatNotification->getHipChatSenderId()->willReturn('someId');
        $hipChatNotification->getMessage()->willReturn('something');

        $hipChatClient->message_room(
            'something',
            'someId',
            'something',
            'something',
            'something',
            'something'
        )->shouldBeCalled();

        $this->handle($hipChatNotification);
    }
}
