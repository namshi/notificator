<?php

namespace Namshi\Notificator\Notification\Email\SwiftMailer;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface responsible to define notifications that should be sent via
 * email.
 */
interface SwiftMailerNotificationInterface extends NotificationInterface
{
    /**
     * Returns the message to be sent through SwiftMailer.
     *
     * @return \Swift_Message
     */
    function getMessage();
}
