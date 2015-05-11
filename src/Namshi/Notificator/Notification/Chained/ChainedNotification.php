<?php

namespace Namshi\Notificator\Notification\Chained;

use Namshi\Notificator\Notification;
use Namshi\Notificator\NotificationInterface;

class ChainedNotification extends Notification implements ChainedNotificationInterface
{
    protected $notifications = array();

    /**
     * Constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications = array())
    {
        foreach ($notifications as $notification) {
            $this->addNotifications($notification);
        }
    }

    /**
     * @inheritdoc
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @inheritdoc
     */
    public function addNotifications(NotificationInterface $notification)
    {
        $this->notifications[] = $notification;
    }
}