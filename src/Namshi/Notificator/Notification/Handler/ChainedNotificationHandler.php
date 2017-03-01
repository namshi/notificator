<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Chained\ChainedNotificationInterface;
use Namshi\Notificator\NotificationInterface;

class ChainedNotificationHandler implements HandlerInterface
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * Constructor
     *
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritdoc
     */
    function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceof ChainedNotificationInterface;
    }

    /**
     * @inheritdoc
     */
    function handle(NotificationInterface $notification)
    {
        foreach ($notification->getNotifications() as $notify) {
            $this->manager->trigger($notify);
        }
    }
}