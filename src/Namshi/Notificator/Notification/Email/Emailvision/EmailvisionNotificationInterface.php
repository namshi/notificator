<?php

namespace Namshi\Notificator\Notification\Email\Emailvision;

use Namshi\Notificator\Notification\Email\EmailNotificationInterface;

/**
 * Interface responsible to define notifications that should be sent via
 * email.
 */
interface EmailvisionNotificationInterface extends EmailNotificationInterface
{
    /**
     * Returns the email template that should be used for this notification.
     * 
     * @return string
     */
    function getEmailTemplate();
}
