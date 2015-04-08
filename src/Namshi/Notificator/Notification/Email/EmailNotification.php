<?php

namespace Namshi\Notificator\Notification\Email;

use Namshi\Notificator\Notification;

/**
 * Class representing a notification that needs to be sent via email.
 */
class EmailNotification extends Notification implements EmailNotificationInterface
{
    /**
     * Email Template
     *
     * @var string
     */
    protected $emailTemplate;

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
    public function __construct($emailTemplate, $recipientAddresses, array $parameters = array())
    {
        $this->recipientAddresses = is_array($recipientAddresses) ? $recipientAddresses : [$recipientAddresses];
        $this->parameters         = $parameters;
        $this->emailTemplate      = $emailTemplate;
    }

    /**
     * @inheritDoc
     */
    public function getRecipientAddresses()
    {
        return $this->recipientAddresses;
    }

    /**
     * @inheritDoc
     */
    public function getEmailTemplate()
    {
        return $this->emailTemplate;
    }
}
