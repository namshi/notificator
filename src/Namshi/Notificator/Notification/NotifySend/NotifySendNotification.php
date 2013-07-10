<?php

namespace Namshi\Notificator\Notification\NotifySend;

use Namshi\Notificator\Notification;

/**
 * Sample notification that will be triggered via the notify-send utility.
 */
class NotifySendNotification extends Notification implements NotifySendNotificationInterface
{
    protected $message;
    
    /**
     * Constructor
     * 
     * @param string $message
     * @param array $parameters
     */
    public function __construct($message, array $parameters = array())
    {
        $this->message = $message;
        
        parent::__construct($parameters);
    }
    
    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->message;
    }
}