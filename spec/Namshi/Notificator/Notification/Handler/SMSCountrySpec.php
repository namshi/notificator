<?php

namespace spec\Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Sms\SmsNotification;
use PhpSpec\ObjectBehavior;
use Namshi\SMSCountry\Client;

class SMSCountrySpec extends ObjectBehavior
{
    /**
     * @param \Namshi\SMSCountry\Client $client
     */
    function let($client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Handler\SMSCountry');
        $this->shouldImplement('Namshi\Notificator\Notification\Handler\HandlerInterface');
    }

    function it_should_handle_sms_notifications_only()
    {
        $smsNotification = new SmsNotification('a', 'b', []);
        if (!$this->getWrappedObject()->shouldHandle($smsNotification)) {
            throw new \Exception('fails');
        }
    }

    /**
     * @param  \Namshi\Notificator\Notification\Sms\SmsNotification $notification
     * @param  \Namshi\SMSCountry\Client $client
     */
    function it_handles_sms_notification($notification, $client)
    {
        $notification->getRecipientNumber()->willReturn('Number')->shouldBeCalled();
        $notification->getMessage()->willReturn('body')->shouldBeCalled();

        $this->handle($notification)->shouldBe(true);

        $client->sendSms(
            'Number',
            'body'
        )->shouldBeCalled();
    }
}
