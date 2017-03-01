<?php

namespace spec\Namshi\Notificator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Manager');
        $this->shouldImplement('Namshi\Notificator\ManagerInterface');
    }

    function it_comes_with_one_handler_by_default()
    {
        $this->getHandlers()->shouldHaveCount(1);
    }

    /**
     * @param Namshi\Notificator\Notification\Handler\HandlerInterface $handler
     */
    function it_can_hold_several_handlers($handler)
    {
        $this->addHandler($handler);
        $this->addHandler($handler);
        $this->getHandlers()->shouldHaveCount(3);
    }

    /**
     * @param \Namshi\Notificator\Notification\Handler\HandlerInterface $handler
     * @param \Namshi\Notificator\NotificationInterface $notification
     */
    function it_can_stop_propagation_of_notifications($handler, $notification)
    {
        foreach (range(1,6) as $i) { $this->addHandler($handler); };
        $this->getHandlers()->shouldHaveCount(7);

        $handler->shouldHandle(Argument::any())->shouldBeCalled()->willReturn(true);
        $handler->handle(Argument::any())->shouldBeCalledTimes(1)->willReturn(false);

        $this->trigger($notification);
    }
}
