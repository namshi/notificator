# NAMSHI | Notificator

*Notificator* is a very simple and
lightweight library to handle
notifications the smart way.

It took inspiration from other
libraries and patterns (Monolog and event dispatching)
in order to provide a domain-driven
lean notification library.

Concepts are very simple: you have a
notification **Manager** which has a
few handlers registered with it (maybe an
**Email** handler, a **Skype** handler, etc.);
you only have to create a notification
class, define which handlers should
handle it and trigger it through the manager.

It is way simpler in code than in words, check
the documentation below!

## Installation

Installation can be done via composer, as the
library is already on packagist (todo link).

The library uses semantic versioning for their API,
so it is recommended to use a stable minor version
(1.0, 1.1, etc.) and stick to it when declaring dependencies
through composer:

```
"namshi/notificator": "1.0.*",
```

## Usage

Using this library is very easy thanks to the simple concept
- borrowed from others - behind it: you basically have a
notification manager with some handlers and then you fire
(`trigger()`) the notification with the manager. At that point,
all the handlers that need to fire that notification will take
care of firing it in their context (might be an email, a skype message, etc)
and tell the manager that they're done, so that the mmanager
can forward the notification to the next handler.

``` php
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
```

This code, ran on ubuntu, will fire the notification using the
`notify-send` utility:

![notify-send](http://odino.org/images/phpunit-notification-ko.png)

## The notification Manager

todo

## Creating a new notification

todo

## Creating a new handler

todo

## Inside Symfony2

todo

## Built-in handlers

todo

## Examples