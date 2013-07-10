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

// import namespaces
use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;

//  create the handler
$handler = new NotifySendHandler();

// create the manager and assign the handler to it
$manager = new Manager();
$manager->addHandler($handler);

$notification = new NotifySendNotification("...whhatever message...");

//  trigger the notification
$manager->trigger($notification);
```

This code, ran on ubuntu, will fire the notification using the
`notify-send` utility:

![notify-send](http://odino.org/images/phpunit-notification-ko.png)

## The notification Manager

The manager is the entity that registers all the
handlers and fire the notification.

You can set and add handlers very easily:

``` php
<?php

$handler  = new MyHandler();
$handlers = array(
    new AnotherHandler(), new AnotherOneHandler(),
);

$manager = new Manager();

// add multiple handlers
$manager->setHandlers($handlers);

// add a single handler
$manager->addHandler($handler);

// reset the handlers
$manager->setHandlers(array());
```

## Creating a new notification

Creating new notifications is very easy, as they
are plain PHP classes.

They *might* extend the base Notification class but
that is not mandatory.
It is recommended, to be able to fire one notification
through multiple handlers, to extends the base Notification
class, and implement different interfaces that will be later
checked by the handlers.

``` php
<?php

use Namshi\Notificator\Notification;
use Namshi\Notificator\NotificationInterface;

interface EchoedNotificationInterface extends NotificationInterface
{
    public function getMessage();
}

interface EmailNotificationInterface extends NotificationInterface
{
    public function getAddress();
    public function getSubject();
    public function getBody();
}

class DoubleNotification extends Notification implements EchoedNotificationInterface, EmailNotificationInterface
{
    protected $address;
    protected $body;
    protected $subject;

    public function __construct($address, $subject, $body, array $parameters = array())
    {
        parent::__construct($parameters);

        $this->address  = $address;
        $this->body     = $body;
        $this->subject  = $subject;
        $this->message  = $body;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
```

As you probably got, the above notification class is meant
to be triggered via email **and** with the `echo` function
(pretty useless, but gives you an idea).

But the work wouldn't be over here, as you would need to
implement handlers for this notification...

## Creating a new handler

todo

## Inside Symfony2

todo

## Built-in handlers

todo

## Examples

You can have a look at the few examples provided so far,
under the `examples` directory:

* [creating a custom handler that sends an email](https://github.com/namshi/notificator/blob/master/examples/email-custom-handler.php)
* [using the notify-send handler](https://github.com/namshi/notificator/blob/master/examples/notify-send.php)
* [triggering a notification that is not handled by any handler](https://github.com/namshi/notificator/blob/master/examples/unhandled.php)