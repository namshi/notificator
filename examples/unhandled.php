<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces
use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification;

//  create the handler
$handler = new NotifySendHandler();

// create the manager and assign the handler to it
$manager = new Manager();
$manager->addHandler($handler);

// create the notification
$notification = new Notification();

//  trigger the notification, nothing happens
$manager->trigger($notification);