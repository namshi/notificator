<?php

namespace spec\Namshi\Notificator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NotificationSpec extends ObjectBehavior
{
    function let()
    {
        $message = 'sample';
        $parameters = [];
        $this->beConstructedWith($message, $parameters);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\NotificationInterface');
    }
}
