<?php

namespace Namshi\Notificator;

use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Psr\Log\LoggerInterface;

/**
 * This class is responsible for dispatching a notification to the various
 * handlers attached to an event.
 */
class Manager implements ManagerInterface
{
    /**
     * @var array
     */
    protected $handlers = array();

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    
    /**
     * Constructor.
     * 
     * @param array $handlers
     */
    public function __construct(array $handlers = array(), LoggerInterface $logger = null)
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
                if ($logger = $this->getLogger()) {
                    $message = sprintf('notification handler "%s" processed the message "%s"', get_class($handler), $notification->getMessage());
                    $logger->info($message);
                }

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

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}