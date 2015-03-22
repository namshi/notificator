<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\Emailvision\ClientInterface;
use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotificationInterface;

/**
 * This class handles notifications that should be sent via email.
 */
class Emailvision extends Email
{
    protected $emailClient;

    /**
     * Constructor
     *
     * @param \Namshi\Notificator\Notification\Email\Emailvision\ClientInterface $emailClient
     */
    public function __construct(ClientInterface $emailClient)
    {
        $this->emailClient = $emailClient;
    }
    
    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        foreach ($notification->getRecipientAddresses() as $recipientAddress) {
            $this->getEmailClient()->sendEmail(
                $notification->getEmailTemplate(),
                $recipientAddress,
                $notification->getParameters()
            );
        }

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
     * Returns the email client used by this handler.
     * 
     * @return \Namshi\Notificator\Notification\Email\Emailvision\ClientInterface
     */
    public function getEmailClient()
    {
        return $this->emailClient;
    }
}