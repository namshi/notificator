<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\HipChat\HipChatNotification;
use Namshi\Notificator\Notification\Kahuna\KahunaNotification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Namshi\Notificator\Notification\Client\Kahuna as KahunaClient;

class KahunaSpec extends ObjectBehavior
{
    function let(KahunaClient $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\Kahuna');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    function it_should_handle_kahuna_push_notification_only()
    {
        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];
        $kahunaNotificaton = new KahunaNotification('push message', ['push_array' => $pushArray]);
        $otherNotification = new HipChatNotification('a', 'b', []);

        if (!$this->getWrappedObject()->shouldHandle($kahunaNotificaton)) {
            throw new \Exception('fails');
        }
        if ($this->getWrappedObject()->shouldHandle($otherNotification)) {
            throw new \Exception('fails');
        }
    }

    function it_handles_kahuna_notification(KahunaNotification $kahunaNotification, KahunaClient $client)
    {
        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];
        $kahunaNotification->getPushArray()->shouldBeCalled()->willReturn($pushArray);
        $kahunaNotification->getDefaultParams()->shouldBeCalled()->willReturn([]);
        $kahunaNotification->getDefaultConfig()->shouldBeCalled()->willReturn([]);
        $client->sendPush($pushArray, [], [])->shouldBeCalled()->willReturn(true);

        $this->handle($kahunaNotification)->shouldBe(true);
    }

}
