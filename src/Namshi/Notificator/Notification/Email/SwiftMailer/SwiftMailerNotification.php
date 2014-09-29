<?php

namespace Namshi\Notificator\Notification\Email\SwiftMailer;

use Namshi\Notificator\Notification;
use Namshi\Notificator\NotificationInterface;

/**
 * Class SwiftMailerNotification represents a notification triggered through SwiftMailer.
 *
 * @package Namshi\Notificator\Notification\Email
 */
class SwiftMailerNotification extends Notification implements NotificationInterface, SwiftMailerNotificationInterface
{}