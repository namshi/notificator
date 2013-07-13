<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotificationInterface;

/**
 * Handler to dispatch notification with the notify-send utility available
 * under linux (same thing can be done under MacOSX with growl).
 */
class NotifySend implements HandlerInterface
{
    const NOTIFY_SEND_COMMAND = 'notify-send "%s"';
    
    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf NotifySendNotificationInterface;
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        shell_exec($this->getCommand($notification));
    }

    /**
     * Returns the command to be executed via CLI.
     *
     * @param NotifySendNotificationInterface $notification
     * @return string
     */
    protected function getCommand(NotifySendNotificationInterface $notification)
    {
        return sprintf(self::NOTIFY_SEND_COMMAND, $notification->getMessage());
    }
}