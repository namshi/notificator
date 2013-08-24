<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NotifySendSpec extends ObjectBehavior
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
}
