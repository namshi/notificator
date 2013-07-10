<?php

namespace Namshi\Notificator\Notification\NotifySend;

use Namshi\Notificator\Notification;

class NotifySendNotification extends Notification implements NotifySendNotificationInterface
{
    protected $message;
    
    public function __construct($message, array $parameters = array())
    {
        $this->message = $message;
        
        parent::__construct($parameters);
    }
    
    public function getMessage()
    {
        return $this->message;
    }
}