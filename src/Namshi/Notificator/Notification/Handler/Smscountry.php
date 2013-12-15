<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\Sms\SmsNotification;
use Namshi\SMSCountry\Client;

class SMSCountry implements HandlerInterface
{
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceof SmsNotification;
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        $this->getClient()->sendSms($notification->getRecipientNumber(), $notification->getMessage());

        return true;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}