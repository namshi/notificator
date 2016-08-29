<?php

namespace Namshi\Notificator\Notification\Kahuna;

use Namshi\Notificator\Notification;

class KahunaNotification extends Notification implements KahunaNotificationInterface
{

    /**
     * KahunaNotification constructor.
     *
     * @param       $message
     * @param array $parameters
     *
     * example parameters
     *  [
     *      'push_array' =>
     *      [
     *          [
     *              'target' => ['email' => 'hey@mail.com'],
     *              'notification' => ['alert' => 'Hey, like this!']
     *          ]
     *      ]
     *  ]
     */
    public function __construct($message, array $parameters)
    {
        if (!array_key_exists('push_array', $parameters)) {
            throw new \InvalidArgumentException('push_array is required for kahuna notification in params');
        }

        if (!is_array($parameters['push_array'])) {
            throw new \InvalidArgumentException('push_array must be an array');
        }

        if (array_key_exists('default_params', $parameters) && !is_array($parameters['default_params'])) {
            throw new \InvalidArgumentException('default_params if provided must be an array');
        }

        if (array_key_exists('default_config', $parameters) && !is_array($parameters['default_config'])) {
            throw new \InvalidArgumentException('default_config if provided must be an array');
        }

        parent::__construct($message, $parameters);
    }

    public function getPushArray()
    {
        return $this->getParameter('push_array');
    }

    public function getDefaultParams()
    {
        return $this->getParameter('default_params') ? : [];
    }

    public function getDefaultConfig()
    {
        return $this->getParameter('default_config') ? : [];
    }
}
