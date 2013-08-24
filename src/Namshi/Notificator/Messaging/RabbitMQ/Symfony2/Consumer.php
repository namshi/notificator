<?php

namespace Namshi\Notificator\Messaging\RabbitMQ\Symfony2;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use InvalidArgumentException;
use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\ManagerInterface;

/**
 * Base consumer class that receives AMQP messages containing notifications and
 * dispatches them to the notification manager.
 */
class Consumer implements ConsumerInterface
{
    const ERROR_INVALID_NOTIFICATION = "The body of the AMQP must be a serialized instance of Namshi\Notificator\NotificationInterface";
    
    protected  $notificationManager;
    
    /**
     * Constructor
     * 
     * @param ManagerInterface $notificationManager
     */
    public function __construct(ManagerInterface $notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }
    
    /**
     * Processes the $message, by first validating it and then dispatching it to
     * the notification manager.
     * 
     * @param AMQPMessage $message
     * @return bool
     */
    public function execute(AMQPMessage $message)
    {
        $notification = $this->validateNotification($message->body);
        
        return $this->notificationManager->trigger($notification);
    }
    
    /**
     * Validates a notification by unserializing it and checking it implements
     * the NotificationInterface.
     * 
     * @param string $notification
     * @return NotificationInterface
     * @throws InvalidArgumentException
     */
    protected function validateNotification($notification)
    {
        $notification = @unserialize($notification);
        
        if ($notification instanceOf NotificationInterface) {
            return $notification;
        }
        
        throw new InvalidArgumentException(self::ERROR_INVALID_NOTIFICATION);
    }
}