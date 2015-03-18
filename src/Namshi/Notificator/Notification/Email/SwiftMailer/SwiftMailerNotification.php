<?php

namespace Namshi\Notificator\Notification\Email\SwiftMailer;

use Namshi\Notificator\Notification;
use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Email\EmailNotification;

/**
 * Class SwiftMailerNotification represents a notification triggered through SwiftMailer.
 *
 * @package Namshi\Notificator\Notification\Email
 */
class SwiftMailerNotification extends EmailNotification implements NotificationInterface, SwiftMailerNotificationInterface
{
     protected $emailTemplate;

    /**
     * Constructor.
     *
     * @param string $emailTemplate
     * @param string $recipientAddress
     * @param array $parameters
     */
    public function __construct($emailTemplate, $recipientAddress, array $parameters = array())
    {
        $this->setEmailTemplate($emailTemplate);
        $this->setRecipientAddress($recipientAddress);
        $this->setParameters($parameters);
    }


    /**
     * Sets the email template that should be used for this notification.
     *
     * @param string $emailTemplate
     */
    public function setEmailTemplate($emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * @inheritDoc
     */
    public function getEmailTemplate()
    {
        return $this->emailTemplate;
    }
}