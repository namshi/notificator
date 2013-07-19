<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Handler\HipChat as HipChatHandler;
use HipChat\HipChat;
use Namshi\Notificator\Notification\HipChat\HipChatNotification;

// create the manager
$manager = new Manager(array(new HipChatHandler(new HipChat(
        'YOUR_API_TOKEN_HERE'
))));

// lets have some fun
$messages = array(
    'Yo @all',
    'I am coming',
    'to announce',
    'that this notifications',
    'are coming',
    'from an ugly bot',
    'and come from PHP',
    'Can you imagine that now you can send messages to',
    'HipChat directly from a script?',
    'And you know what?',
    'Python SUCKS. BIG TIME.'
);

// trigger multiple notifications!
foreach ($messages as $message) {
    // create the notification
    $notification = new HipChatNotification($message, 'NotificatorBot', 'Spam', array(
        'hipchat_notify'            => true,
        'hipchat_color'             => HipChat::COLOR_GREEN,
        'hipchat_message_format'    => HipChat::FORMAT_TEXT,
    ));

    //  trigger the notification
    $manager->trigger($notification);
}