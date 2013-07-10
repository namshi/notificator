<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface that defines the behavior of notification handlers.
 */
interface HandlerInterface
{
    /**
     * Checks whether the handler is supposed to handle the given
     * $notification.
     * 
     * @param Namshi\Notificator\Notification\NotificationInterface $notification
     * @return bool
     */
    public function shouldHandle(NotificationInterface $notification);
    
    /**
     * Handles a notification, deciding whether this handler should trigger it,
     * and if it should stop the propagation of the notification.
     * 
     * If the handler returns (bool) false, propagation should be stopped.
     * 
     * @param Namshi\Notificator\Notification\NotificationInterface $notification
     */
    public function handle(NotificationInterface $notification);
}