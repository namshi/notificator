<?php

namespace Namshi\Notificator;

/**
 * Base notification class.
 */
class Notification implements NotificationInterface
{
    protected $parameters = array();
    
    /**
     * Constructor
     * 
     * @param array $parameters
     */
    public function __construct(array $parameters = array())
    {
        $this->setParameters($parameters);
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