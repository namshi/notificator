<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces
use HipChat\HipChat;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Chained\ChainedNotification;
use Namshi\Notificator\Notification\Handler\SwiftMailer AS SwiftMailerHandler;
use Namshi\Notificator\Notification\Handler\HipChat as HipChatHandler;
use Namshi\Notificator\Notification\Email\SwiftMailer\SwiftMailerNotification;
use Namshi\Notificator\Notification\HipChat\HipChatNotification;

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

$swiftNotification = new SwiftMailerNotification('test_template', array('TO_EMAILS@gmail.com'), array());
$swiftNotification->setMessage($message);

// create the handler
$swiftMailerHandler = new SwiftMailerHandler($mailer);


$hipChatNotification = new HipChatNotification("Yo Dawg", 'NotificatorBot', 'Spam', array(
    'hipchat_notify'            => true,
    'hipchat_color'             => HipChat::COLOR_GREEN,
    'hipchat_message_format'    => HipChat::FORMAT_TEXT,
));

$hipchatHandler = new HipChatHandler(new HipChat('YOUR_API_TOKEN_HERE'));



$chainedNotification = new ChainedNotification(array(
    $swiftNotification,
    $hipChatNotification
));

// create a manager
$manager = new Manager();
$manager->addHandler($swiftMailerHandler);
$manager->addHandler($hipchatHandler);

// trigger the notification
$manager->trigger($notification);
