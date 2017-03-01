<?php

namespace Namshi\Notificator\Notification\Chained;

use Namshi\Notificator\NotificationInterface;

interface ChainedNotificationInterface extends NotificationInterface
{
    /**
     * Returns an array of all the notifications to publish
     * 
     * @retutn array
     */
    public function getNotifications();

    /**
     * Add a notification to the chain
     *
     * @param NotificationInterface $notification
     */
    public function addNotifications(NotificationInterface $notification);
}