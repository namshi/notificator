<?php

namespace Namshi\Notificator\Notification\Email\Emailvision;

interface ClientInterface
{
    function sendEmail($template, $recipient, array $parameters);
}
