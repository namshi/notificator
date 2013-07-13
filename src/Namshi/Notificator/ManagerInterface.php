<?php

namespace Namshi\Notificator;

/**
 * This interface defines how notification manager is defined.
 */
interface ManagerInterface
{
    /**
     * Triggers a notification to the various handlers that should process it.
     *
     * If an handler returns (bool) false, the manager should stop propagating
     * the $notification to other handlers.
     *
     * @param NotificationInterface $notification
     * @return boolean|void
     */
    function trigger(NotificationInterface $notification);
}