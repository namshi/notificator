<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotificationInterface;
use Namshi\Emailvision\Client;

/**
 * This class handles notifications that should be sent via email.
 */
class Emailvision extends Email
{
    protected $emailClient;
    
    /**
     * Constructor
     * 
     * @param \Namshi\Emailvision\Client $emailClient
     */
    public function __construct(Client $emailClient)
    {
        $this->setEmailClient($emailClient);
    }
    
    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        $this->getEmailClient()->sendEmail(
            $notification->getEmailTemplate(),
            $notification->getRecipientAddress(),
            $notification->getParameters()
        );

        return true;
    }
    
    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceof EmailvisionNotificationInterface;
    }

    /**
     * Sets the email client associated with this handler.
     * 
     * @param \Namshi\Emailvision\Client $emailClient
     */
    public function setEmailClient(Client $emailClient)
    {
        $this->emailClient = $emailClient;
    }
    
    /**
     * Returns the email client used by this handler.
     * 
     * @return \Namshi\Emailvision\Client
     */
    public function getEmailClient()
    {
        return $this->emailClient;
    }
}