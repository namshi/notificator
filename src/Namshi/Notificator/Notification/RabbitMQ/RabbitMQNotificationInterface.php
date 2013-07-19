<?php

namespace Namshi\Notificator\Notification\RabbitMQ;

use Namshi\Notificator\NotificationInterface;

/**
 * Interface used to mark notifications that should be triggered through
 * RabbitMQ.
 */
interface RabbitMQNotificationInterface extends NotificationInterface
{
}