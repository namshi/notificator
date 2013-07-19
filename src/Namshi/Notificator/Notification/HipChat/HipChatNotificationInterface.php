<?php

namespace Namshi\Notificator\Notification\HipChat;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface used to identify notifications that should be sent on HipChat
 */
interface HipChatNotificationInterface extends NotificationInterface
{
    /**
     * Returns the room where the message should be published.
     * 
     * @retutn string
     */
    public function getHipChatRoom();
    
    /**
     * Returns the ID of the message's sender.
     * 
     * @retutn string
     */
    public function getHipChatSenderId();
}