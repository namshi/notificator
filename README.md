# NAMSHI | Notificator

[![Build Status](https://travis-ci.org/namshi/notificator.png?branch=master)](https://travis-ci.org/namshi/notificator)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b373d6fe-b6a0-4ad2-a12e-fc2e788a79c2/mini.png)](https://insight.sensiolabs.com/projects/b373d6fe-b6a0-4ad2-a12e-fc2e788a79c2)

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
library is already on [packagist](https://packagist.org/packages/namshi/notificator).

The library uses semantic versioning for its API,
so it is recommended to use a stable minor version
(1.0, 1.1, etc.) and stick to it when declaring dependencies
through composer:

```
"namshi/notificator": "1.0.*",
```

## Usage

Using this library is very easy thanks to the simple
concept - borrowed from others - behind it: you basically have a
notification manager with some handlers and then you fire
(`trigger()`) the notification with the manager. At that point,
all the handlers that need to fire that notification will take
care of firing it in their context (might be an email, a skype message, etc)
and tell the manager that they're done, so that the manager
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

$notification = new NotifySendNotification("...whatever message...");

//  trigger the notification
$manager->trigger($notification);
```

This code, ran on ubuntu, will fire the notification using the
`notify-send` utility:

![notify-send](http://odino.org/images/phpunit-notification-ko.png)

## The notification Manager

The manager is the entity that registers all the
handlers and fires the notification.

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
through multiple handlers, to extend the base Notification
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

Let's say that we want to create the handlers that would
handle the notification above, by echoing it and sending it
via email: it is a matter of implementing 2 classes with
a couple methods, `shouldHandle` and `handle`.

Let's see how the `EchoedNotificationHandler` should look like:

``` php
use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Namshi\Notificator\NotificationInterface;

class EchoedNotificationHandler implements HandlerInterface
{
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf EchoedNotificationInterface;
    }

    public function handle(NotificationInterface $notification)
    {
        echo $notification->getMessage();
    }
}
```

Pretty easy, right?

First, we need to check if this handler is handling the given notification,
and that check is done by seeing if the notification implements
a known interface; second, we actually trigger the notification.

The same thing needs to be done for the `EmailNotificationHandler`:

``` php
use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Namshi\Notificator\NotificationInterface;

class EmailNotificationHandler implements HandlerInterface
{
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf EmailNotificationInterface;
    }

    public function handle(NotificationInterface $notification)
    {
        mail($notification->getAddress(), $notification->getSubject(), $notification->getBody());
    }
}
```

If you want to stop notification propagation after an handler has triggered
the notification, you just need to return `false` in the `handle` method of the
handler:

``` php
public function handle(NotificationInterface $notification)
{
    // do whatever you want with the notification
    // ...

    return false;
}
```

This will tell the manager to stop propagating the notification to other
handlers.

## Inside Symfony2

[Namshi](http://en-ae.namshi.com) is currently using this library inside
their Symfony2 applications.

This is an example configuration that can be declared for the container:

```
namshi.notification.manager:
    class: Namshi\Notificator\Manager
    calls:
      - [addhandler, [@namshi.notification.handler.email] ]
namshi.notification.handler.email:
    class: Namshi\Notificator\Notification\Handler\Emailvision
    arguments:
      client: @namshi.email_client.emailvision      
namshi.email_client.emailvision:
    class: Namshi\Emailvision\Client
    arguments:
      config:
        test_email:
          random:   AAA
          encrypt:  BBB
          uidkey:   email
          stype:    NOTHING
```

This configuration makes available a Manager with the Emailvision handler.

## RabbitMQ

If you use Symfony2 and the [RabbitMQBundle](https://github.com/videlalvaro/rabbitmqbundle)
you can trigger notifications with this library via RabbitMQ, by using the
[provided consumer](https://github.com/namshi/notificator/blob/master/src/Namshi/Notificator/Messaging/RabbitMQ/Symfony2/Consumer.php).

Declare the consumer as a service:

```
namshi.notification.consumer:
    class: Namshi\Notificator\Messaging\RabbitMQ\Symfony2\Consumer
    arguments: [@namshi.notification.manager]
```

Then configure it within the RabbitMQ bundle:

```
old_sound_rabbit_mq:
    consumers:
        notification:
            connection: default
            exchange_options: {name: 'notifications', type: direct}
            queue_options:    {name: 'notifications'}
            callback:         namshi.notification.consumer
```

And at that point you can run the consumer with:

```
php app/console rabbitmq:consumer -w notification
```

To send notifications, the idea is that you serialize them inside the
RabbitMQ messages:

``` php
$publisher = $container->get('old_sound_rabbit_mq.notifications_producer');

$notification = new MyWhateverNotification("man, this comes from RabbitMQ and Symfony2!");

$publisher->publish(serialize($notification));
```

That's it!

## Built-in handlers

We, at [Namshi](https://github.com/namshi) have developed some very simple,
built-in, handlers according to our needs. Keep in mind that the main
reason behind building this kind of library is the ability of triggering
notification from each component of our SOA, mostly via RabbitMQ.

You can take advantage of the following handlers:

* `HipChat`, which posts messages in an [HipChat](https://www.hipchat.com) room
* `Emailvision`, which sends emails through the [Emailvision API](http://www.emailvision.com/)
* `NotifySend`, which triggers notifications on Ubuntu
* `RabbitMQ`, which triggers notifications through [RabbitMQ](http://www.rabbitmq.com/)

If you have an idea for a new handler, don't hesitate with a pull request:
sure, they can be implemented within your own code, but why not sharing them
with the OSS ecosystem?

## Examples

You can have a look at the few examples provided so far,
under the `examples` directory:

* [sending messages on HipChat](https://github.com/namshi/notificator/blob/master/examples/hipchat.php)
* [creating a custom handler that sends an email](https://github.com/namshi/notificator/blob/master/examples/email-custom-handler.php)
* [using the notify-send handler](https://github.com/namshi/notificator/blob/master/examples/notify-send.php)
* [triggering a notification that is not handled by any handler](https://github.com/namshi/notificator/blob/master/examples/unhandled.php)

## Running specs

In order to run the spec suite after running `composer install` do the following:

``` cli
php vendor/bin/phpspec run --format=dot
```
