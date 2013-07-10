<?php

namespace Namshi\Notificator\Notification\Email\Emailvision;

use Namshi\Notificator\Notification\Email\EmailNotification;

/**
 * Class that represents a notification that should be triggered on emailvision.
 */
class EmailvisionNotification extends EmailNotification implements EmailvisionNotificationInterface
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
     * @inheritDoc
     */
    public function getEmailTemplate()
    {
        return $this->emailTemplate;
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
}