<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Email\SwiftMailer\SwiftMailerNotificationInterface;
use Namshi\Notificator\Notification\Email\SwiftMailerNotification;
use Namshi\Notificator\NotificationInterface;

/**
 * This class handles notifications that should be sent via SwiftMailer.
 */
class SwiftMailer extends Email
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * Constructor
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->setMailer($mailer);
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        $this->getMailer()->send($notification->getMessage());

        return true;
    }

    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceof SwiftMailerNotificationInterface;
    }

    /**
     * @param \Swift_Mailer $mailer
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }
}