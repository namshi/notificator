<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\RabbitMQ\RabbitMQNotificationInterface;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * Handler to dispatch a raw notification through RabbitMQ.
 */
class RabbitMQ implements HandlerInterface
{
    protected $publisher;
    
    /**
     * Constructor.
     *
     */
    public function  __construct(AMQPChannel $publisher)
    {
        $this->setPublisher($publisher);
    }

    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf RabbitMQNotificationInterface;
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        $this->getPublisher()->basic_publish($notification->getMessage());
    }
    
    /**
     * 
     * @return AMQPChannel
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    public function setPublisher(AMQPChannel $publisher)
    {
        $this->publisher = $publisher;
    }
}