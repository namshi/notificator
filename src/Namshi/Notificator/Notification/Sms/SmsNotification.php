<?php

namespace Namshi\Notificator\Notification\Sms;

use Namshi\Notificator\Notification;

/**
 * Class representing a notification that needs to be sent via sms.
 */
class SmsNotification extends Notification implements SmsNotificationInterface
{
    protected $recipientAddress;
    
    /**
     * Constructor.
     *
     * @param $recipientNumber
     * @param string $message
     * @param array $parameters
     */
    public function __construct($recipientNumber, $message, array $parameters = array())
    {
        $this->setRecipientNumber($recipientNumber);
        $this->setParameters($parameters);
        $this->setMessage($message);
    }

    /**
     * @inheritDoc
     */
    public function getRecipientNumber()
    {
        return $this->recipientAddress;
    }

    /**
     * @inheritDoc
     */
    public function setRecipientNumber($recipientNumber)
    {
        $this->recipientAddress = $recipientNumber;
    }
}
