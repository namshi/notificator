<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\HipChat\HipChatNotificationInterface;
use HipChat\HipChat as HipChatClient;

/**
 * Handler to dispatch a raw notification through RabbitMQ.
 */
class HipChat implements HandlerInterface
{
    protected $hipchat;
    
    /**
     * Constructor.
     *
     */
    public function __construct(HipChatClient $hipchat)
    {
        $this->setHipchat($hipchat);
    }

    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf HipChatNotificationInterface;
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {        
        $notify = $notification->getParameter('hipchat_notify') ?: true;
        $color  = $notification->getParameter('hipchat_color') ?: HipChatClient::COLOR_YELLOW;
        $format = $notification->getParameter('hipchat_message_format') ?: HipChatClient::FORMAT_TEXT;
                    
        $this->getHipchat()->message_room(
            $notification->getHipChatRoom(),
            $notification->getHipChatSenderId(),
            $notification->getMessage(),
            $notify,
            $color,
            $format
        );
    }
    
    /**
     * Returns the HipChat instance associated with this handler.
     * 
     * @return \HipChat\HipChat
     */
    public function getHipchat()
    {
        return $this->hipchat;
    }

    /**
     * Sets the HipChat instance associated with this handler.
     * 
     * @param \HipChat\HipChat $hipchat
     */
    public function setHipchat(HipChatClient $hipchat)
    {
        $this->hipchat = $hipchat;
    }
}