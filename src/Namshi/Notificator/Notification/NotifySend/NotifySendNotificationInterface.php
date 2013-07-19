<?php

namespace Namshi\Notificator\Notification\NotifySend;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface for notifications that should be output through the notify-send
 * utility (available under linux).
 */
interface NotifySendNotificationInterface extends NotificationInterface
{
}