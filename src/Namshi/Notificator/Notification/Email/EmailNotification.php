<?php

namespace Namshi\Notificator\Notification\Email;

use Namshi\Notificator\Notification;

/**
 * Class representing a notification that needs to be sent via email.
 */
class EmailNotification extends Notification implements EmailNotificationInterface
{
    protected $recipientAddress;
    
    /**
     * Constructor.
     * 
     * @param string $recipientAddress
     * @param array $parameters
     */
    public function __construct($recipientAddress, array $parameters = array())
    {
        $this->setRecipientAddress($recipientAddress);
        $this->setParameters($parameters);
    }

    /**
     * @inheritDoc
     */
    public function getRecipientAddress()
    {
        return $this->recipientAddress;
    }

    /**
     * @inheritDoc
     */
    public function setRecipientAddress($recipientAddress)
    {
        $this->recipientAddress = $recipientAddress;
    }
}
