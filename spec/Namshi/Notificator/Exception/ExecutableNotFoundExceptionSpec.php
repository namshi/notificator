<?php

namespace spec\Namshi\Notificator\Exception;

use PhpSpec\ObjectBehavior;

class ExecutableNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Exception\ExecutableNotFoundException');
    }

    function it_extends_runtime_exception()
    {
        $this->shouldHaveType('\RuntimeException');
    }
}
