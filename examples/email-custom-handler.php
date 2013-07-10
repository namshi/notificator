<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces
use Namshi\Notificator\Notification\Handler\Email as EmailHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification;
use Namshi\Notificator\Notification\Email\EmailNotificationInterface;
use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\NotificationInterface;

//  create the handler
class SimpleEmailHandler extends EmailHandler
{    
    public function handle(NotificationInterface $notification)
    {
        mail($notification->getRecipientAddress(), $notification->subject, $notification->body);
    }
}

$handler = new SimpleEmailHandler();

// create the manager and assign the handler to it
$manager = new Manager();
$manager->addHandler($handler);

// create the notification
class SimpleEmailNotification extends EmailNotification implements EmailNotificationInterface
{
    public $subject;
    public $body;
    
    public function __construct($recipientAddress, $subject, $body, array $parameters = array())
    {
        parent::__construct($recipientAddress, $parameters);
        
        $this->subject  = $subject;
        $this->body     = $body;
    }
}

$notification = new SimpleEmailNotification('YOUR_EMAIL@gmail.com', 'Test email', 'Hello!');

//  trigger the notification
$manager->trigger($notification);