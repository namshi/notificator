<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces

use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotificationInterface;

//  create the handler
$handler = new NotifySendHandler();

// create the manager and assign the handler to it
$manager = new Manager();
$manager->addHandler($handler);

// create the notification

class NSNotification extends Notification implements NotifySendNotificationInterface
{
    public function getMessage()
    {
        $date = new \DateTime();
        
        return sprintf("Yo, it's %s", $date->format('H:i'));
    }
}

$notification = new NSNotification();

//  trigger the notification
$manager->trigger($notification);