<?php

namespace Namshi\Notificator\Notification\HipChat;

use Namshi\Notificator\Notification;

/**
 * This class represents a notification that would end on HipChat.
 */
class HipChatNotification extends Notification implements HipChatNotificationInterface
{
    protected $room;
    protected $from;
    
    /**
     * Constructor.
     * 
     * @param string $message
     * @param string $from
     * @param string $room
     * @param array $parameters
     */
    public function __construct($message, $from, $room, array $parameters = array())
    {
        parent::__construct($message, $parameters);
        
        $this->room = $room;
        $this->from = $from;
    }
    
    /**
     * @inheritDoc
     */
    public function getHipChatRoom()
    {
        return $this->room;
    }

    /**
     * @inheritDoc
     */
    public function getHipChatSenderId()
    {
        return $this->from;
    }
}