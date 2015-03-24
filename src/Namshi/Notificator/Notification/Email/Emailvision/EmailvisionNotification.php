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