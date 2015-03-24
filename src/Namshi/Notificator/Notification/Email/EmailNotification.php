<?php

namespace Namshi\Notificator\Notification\Email;

use Namshi\Notificator\Notification;

/**
 * Class representing a notification that needs to be sent via email.
 */
class EmailNotification extends Notification implements EmailNotificationInterface
{
    /**
     * Recipient Email Addresses.
     *
     * @var array
     */
    protected $recipientAddresses = [];

    /**
     * Constructor.
     * 
     * @param array|string $recipientAddress
     * @param array $parameters
     */
    public function __construct($recipientAddresses, array $parameters = array())
    {
        $this->recipientAddresses = is_array($recipientAddresses) ? $recipientAddresses : [$recipientAddresses];
        $this->parameters         = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function getRecipientAddresses()
    {
        return $this->recipientAddresses;
    }
}
