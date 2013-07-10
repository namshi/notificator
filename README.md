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

todo

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