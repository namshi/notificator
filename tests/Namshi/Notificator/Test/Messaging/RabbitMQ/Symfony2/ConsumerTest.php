<?php

namespace Namshi\KarlBundle\Test\Messaging\RabbitMQ\Symfony2;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Messaging\RabbitMQ\Symfony2\Consumer;
use PhpAmqpLib\Message\AMQPMessage;
use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\ManagerInterface;

class ConsumerTest extends PHPUnit_Framework_TestCase
{
    public function testTheMessagingCanProcessASimpleMessageImplementingTheMessageInterface()
    {
        $notificationManager    = new StubManager();
        $consumer               = new Consumer($notificationManager);
        $message                = new \Namshi\Notificator\Notification('hello');
        $amqpMessage            = new AMQPMessage(serialize($message));
        $result                 = $consumer->execute($amqpMessage);
        
        $this->assertEquals('AAA', $result);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testTheMessagingThrowAnExceptionIfTheMessageDoesntProvideAValidObject()
    {
        $notificationManager    = new StubManager();
        $consumer               = new Consumer($notificationManager);
        $amqpMessage    = new AMQPMessage('hello');
        $result         = $consumer->execute($amqpMessage);
        
        $this->assertTrue($result);
    }
}

class StubManager implements ManagerInterface
{
    public function trigger(NotificationInterface $notification)
    {
        return 'AAA';
    }
}