<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\Notification\Kahuna\KahunaNotificationInterface;
use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Client\Kahuna as KahunaClient;

class Kahuna implements HandlerInterface
{
    /**
     * @var KahunaClient
     */
    protected $client;

    public function __construct(KahunaClient $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf KahunaNotificationInterface;
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        return $this->client->sendPush(
            $notification->getPushArray(),
            $notification->getDefaultParams(),
            $notification->getDefaultConfig()
        );
    }
}
