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
     * @param string        $emailTemplate
     * @param array|string  $recipientAddresses
     * @param array         $parameters
     */
    public function __construct($emailTemplate, $recipientAddresses, array $parameters = array())
    {
        parent::__construct($recipientAddresses, $parameters);

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