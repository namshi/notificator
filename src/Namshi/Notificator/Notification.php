<?php

namespace Namshi\Notificator;

/**
 * Base notification class.
 */
class Notification implements NotificationInterface
{
    protected $parameters = array();
    protected $message;
    
    /**
     * Constructor
     * 
     * @param array $parameters
     */
    public function __construct($message, array $parameters = array())
    {
        $this->setMessage($message);
        $this->setParameters($parameters);
    }
    
    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message transported by this notification.
     * 
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * @inheritDoc
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}