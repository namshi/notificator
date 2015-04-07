<?php

namespace spec\Namshi\Notificator\Notification\Email;

use Cordoval\PhpSpec\ObjectBehaviorComplete;

class EmailNotificationSpec extends ObjectBehaviorComplete
{
    function let()
    {
        $this->beConstructedWith(['recipient'], []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Email\EmailNotification');
        $this->shouldHaveType('Namshi\Notificator\Notification');
        $this->shouldImplement('Namshi\Notificator\Notification\Email\EmailNotificationInterface');
    }

    function it_should_handle_string_as_recipient()
    {
        $this->beConstructedWith('template', 'recipient');

        $this->getRecipientAddresses()->shouldReturn(['recipient']);
    }

    function it_should_handle_array_of_recipient()
    {
        $this->beConstructedWith('template', ['recipient', 'recipient2', 'recipient3']);

        $this->getRecipientAddresses()->shouldReturn(['recipient', 'recipient2', 'recipient3']);
    }
}
