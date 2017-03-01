<?php

namespace spec\Namshi\Notificator;

use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Namshi\Notificator\NotificationInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Manager');
        $this->shouldImplement('Namshi\Notificator\ManagerInterface');
    }

    function it_comes_with_no_handlers_by_default()
    {
        $this->getHandlers()->shouldHaveCount(0);
    }

    function it_can_hold_several_handlers(HandlerInterface $handler)
    {
        $this->addHandler($handler);
        $this->addHandler($handler);
        $this->getHandlers()->shouldHaveCount(2);
    }

    function it_can_stop_propagation_of_notifications(HandlerInterface $handler, NotificationInterface $notification)
    {
        foreach (range(1,6) as $i) { $this->addHandler($handler); };
        $this->getHandlers()->shouldHaveCount(6);

        $handler->shouldHandle(Argument::any())->shouldBeCalled()->willReturn(true);
        $handler->handle(Argument::any())->shouldBeCalledTimes(1)->willReturn(false);

        $this->trigger($notification);
    }
}
