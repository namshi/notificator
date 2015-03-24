<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Handler\SwiftMailer AS SwiftMailerHandler;
use Namshi\Notificator\Notification\Email\SwiftMailer\SwiftMailerNotification;

// create transport
$transport = Swift_SmtpTransport::newInstance('EMAIL_PROVIDER_HOST', 'EMAIL_PROVIDER_PORT');

// set the username and password
$transport->setUsername('USERNAME');
$transport->setPassword('PASSWORD');

// create mailer
$mailer = Swift_Mailer::newInstance($transport);

// create message
$message = new Swift_Message();

$message->setTo('TO_EMAIL@gmail.com');
$message->setFrom('FROM_EMAIL@gmail.com');
$message->setSubject('TEST EMAIL');
$message->setBody('Hello!');

$notification = new SwiftMailerNotification('test_template', array('TO_EMAILS@gmail.com'), array());
$notification->setMessage($message);

// create the handler
$handler = new SwiftMailerHandler($mailer);

// create a manager
$manager = new Manager();
$manager->addHandler($handler);

// trigger the notification
$manager->trigger($notification);
