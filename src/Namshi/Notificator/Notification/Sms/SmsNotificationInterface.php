<?php

namespace Namshi\Notificator\Notification\Sms;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface responsible to define notifications that should be sent via
 * sms.
 */
interface SmsNotificationInterface extends NotificationInterface
{
    /**
     * Returns the phone number that will receive this notification.
     * 
     * @return int
     */
    public function getRecipientNumber();
    
    /**
     * Sets the phone number that will receive this notification.
     */
    public function setRecipientNumber($recipientNumber);
}
