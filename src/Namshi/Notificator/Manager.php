<?php

namespace Namshi\Notificator;

use Namshi\Notificator\Notification\Handler\ChainedNotificationHandler;
use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Psr\Log\LoggerInterface;

/**
 * This class is responsible for dispatching a notification to the various
 * handlers attached to an event.
 */
class Manager implements ManagerInterface
{
    /**
     * @var HandlerInterface[]
     */
    protected $handlers = array();

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param array           $handlers
     * @param LoggerInterface $logger
     */
    public function __construct(array $handlers = array(), LoggerInterface $logger = null)
    {
        $handlers[] = new ChainedNotificationHandler($this);
        $this->handlers = $handlers;
        $this->logger   = $logger;
    }
    
    /**
     * @inheritDoc
     */
    public function trigger(NotificationInterface $notification)
    {
        foreach ($this->getHandlers() as $handler) {
            if ($handler->shouldHandle($notification)) {
                if ($logger = $this->getLogger()) {
                    $message = sprintf('notification handler "%s" processed message', get_class($handler));
                    $logger->info($message, array('Notification' => serialize($notification)));
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
     * @return HandlerInterface[]
     */
    public function getHandlers()
    {
        return $this->handlers;
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
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}