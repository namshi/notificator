<?php

namespace spec\Namshi\Notificator\Notification\Kahuna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KahunaNotificationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'message',
            [
                'push_array' => [
                    [
                        'target' => ['email' => 'hey@mail.com'],
                        'notification' => ['alert' => 'Hey, like this!']
                    ]
                ]
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Kahuna\KahunaNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\Kahuna\KahunaNotificationInterface');
    }

    function it_should_throw_exception_if_constructed_without_array_push_parameter()
    {
        $this->beConstructedWith('', []);
        $this->shouldThrow(new \InvalidArgumentException('push_array is required for kahuna notification in params'))->duringInstantiation();
    }

    function it_should_throw_exception_if_constructed_with_array_push_non_array_parameter()
    {
        $this->beConstructedWith('', ['push_array' => '']);
        $this->shouldThrow(new \InvalidArgumentException('push_array must be an array'))->duringInstantiation();
    }

    function it_should_return_push_array_parameter()
    {
        $this->getPushArray()->shouldBe( [
            [
                'target' => ['email' => 'hey@mail.com'],
                'notification' => ['alert' => 'Hey, like this!']
            ]
        ]);
    }
}
