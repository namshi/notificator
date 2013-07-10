<?php

namespace Namshi\Notificator\Notification\Email;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface responsible to define notifications that should be sent via
 * email.
 */
interface EmailNotificationInterface extends NotificationInterface
{
    /**
     * Returns the email address that will receive this notification.
     * 
     * @return true|null
     */
    public function getRecipientAddress();
    
    /**
     * Sets the email address that will receive this notification.
     */
    public function setRecipientAddress($recipientAddress);
}
