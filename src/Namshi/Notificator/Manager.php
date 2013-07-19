<?php

namespace Namshi\Notificator;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Handler\HandlerInterface;

/**
 * This class is responsible for dispatching a notification to the various
 * handlers attached to an event.
 */
class Manager implements ManagerInterface
{
    protected $handlers = array();
    
    /**
     * Constructor.
     * 
     * @param array $handlers
     */
    public function __construct(array $handlers = array())
    {
        $this->setHandlers($handlers);
    }
    
    /**
     * @inheritDoc
     */
    public function trigger(NotificationInterface $notification)
    {
        foreach ($this->getHandlers() as $handler) {
            if ($handler->shouldHandle($notification)) {
                if (false === $handler->handle($notification)) {
                    return true;
                }
            }
        }
        
        return true;
    }
    
    /**
     * Returns all the handlers associated to this manager.
     * 
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * Sets all the handlers associated to this manager.
     * 
     * @param array $handlers
     */
    public function setHandlers($handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * Adds an handler to this manager.
     *
     * @param HandlerInterface $handler
     */
    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }
}