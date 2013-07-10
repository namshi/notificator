<?php

namespace Namshi\Notificator;

/**
 * This interface is responsible to force type-hinting for all the notifications
 * that need to be processed.
 */
interface NotificationInterface
{
    /**
     * Returns an array of parameters that are sent along with this
     * notification.
     * They are usually used by handlers to build the actual notification (ie. 
     * dynamic content in emails or smses).
     * 
     * @return array
     */
    public function getParameters();
    
    /**
     * Sets an array of parameters that are sent along with this
     * notification.
     * They are usually used by handlers to build the actual notification (ie. 
     * dynamic content in emails or smses).
     */
    public function setParameters(array $parameters);
}