<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Email\EmailNotificationInterface;

/**
 * This class handles notifications that should be sent via email.
 */
abstract class Email implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceof EmailNotificationInterface;
    }
}