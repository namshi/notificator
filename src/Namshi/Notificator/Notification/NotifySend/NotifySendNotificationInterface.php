<?php

namespace Namshi\Notificator\Notification\NotifySend;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface for notifications that should be outputter through the notify-send
 * utility (available under linux).
 */
interface NotifySendNotificationInterface extends NotificationInterface
{
    /**
     * Returns the message that will be outputted via notify-send.
     * 
     * @return string
     */
    public function getMessage();
}