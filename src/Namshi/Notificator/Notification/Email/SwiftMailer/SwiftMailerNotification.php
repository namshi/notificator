<?php

namespace Namshi\Notificator\Notification\Email\SwiftMailer;

use Namshi\Notificator\Notification;
use Namshi\Notificator\NotificationInterface;

/**
 * Class SwiftMailerNotification represents a notification triggered through SwiftMailer.
 *
 * @package Namshi\Notificator\Notification\Email
 */
class SwiftMailerNotification extends Notification implements NotificationInterface, SwiftMailerNotificationInterface
{
    /**
     * Constructor.
     *
     * @param \Swift_Message $message
     * @param array $parameters
     */
    public function __construct(\Swift_Message $message, array $parameters = array())
    {
        parent::__construct($message, $parameters);
    }

    /**
     * Returns the message to be sent.
     *
     * @return \Swift_Message
     */
    public function getMessage()
    {
        return parent::getMessage();
    }
} 