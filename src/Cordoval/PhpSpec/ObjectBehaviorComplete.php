<?php

namespace Cordoval\PhpSpec;

use PhpSpec\ObjectBehavior;

class ObjectBehaviorComplete extends ObjectBehavior
{
    /**
     * @param array $arguments
     * @return self
     */
    public function shouldBe(array $arguments = array())
    {
        $method = 'shouldBe';

        return call_user_func_array(array($this->object, $method), $arguments);
    }
}
