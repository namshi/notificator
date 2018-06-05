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
     * @param $message
     * @param array $parameters
     */
    public function __construct($message, array $parameters = array())
    {
        $this->message    = $message;
        $this->parameters = $parameters;
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
     * Returns a parameter.
     * @param string $id
     * @return mixed
     */
    public function getParameter($id)
    {
        if (isset($this->parameters[$id])) {
            return $this->parameters[$id];
        }
    }

    /**
     * Sets a parameter.
     *
     * @param string $id
     * @param string $value
     */
    public function setParameter($id, $value)
    {
        $this->parameters[$id] = $value;
    }

    /**
     * @inheritDoc
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
