<?php

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// import namespaces
use GuzzleHttp\Client;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Handler\Kahuna as KahunaHandler;
use Namshi\Notificator\Notification\Client\Kahuna as KahunaClient;
use Namshi\Notificator\Notification\Kahuna\KahunaNotification;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

// create the manager constructor params
$logger =  new ConsoleLogger(
    new ConsoleOutput(ConsoleOutput::VERBOSITY_VERY_VERBOSE)
);

$handlers = [
    new KahunaHandler(
        new KahunaClient(
            new Client(),
            'username',
            'password',
            'p',
            $logger
        )
    )
];

// create the manager
$manager = new Manager($handlers, $logger);

// create the push notification
$notification = new KahunaNotification(
    '',
    [
        'push_array' => [
            [
                'target' => ['email' => 'hey@mail.com'],
                'notification' => ['alert' => 'Hey, like this!']
            ]
        ]
    ]
);

//  trigger the notification
$manager->trigger($notification);
