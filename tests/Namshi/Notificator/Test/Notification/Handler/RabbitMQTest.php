<?php

namespace Namshi\Notificator\Test\Notification\Handler;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Notification\RabbitMQ\RabbitMQNotification;
use Namshi\Notificator\Notification\Handler\RabbitMQ as RabbitMQHandler;
use PhpAmqpLib\Channel\AMQPChannel;

class RabbitMQTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->handler = new RabbitMQHandler(new StubChannel());
    }
    
    public function testTheHandlerDoesntHandleAnyNotificationByDefault()
    {
        $this->assertFalse($this->handler->shouldHandle(new \Namshi\Notificator\Notification('hello')));
    }
    
    public function testTheHandlerHandlesANotification()
    {
        $this->assertTrue($this->handler->shouldHandle(new RabbitMQNotification('my message')));
        $this->assertEmpty($this->handler->handle(new RabbitMQNotification('my message')));
    }
}

class StubChannel extends AMQPChannel
{
    public function __construct()
    {
        
    }
    
    public function basic_publish($msg, $exchange="", $routing_key="",
                                  $mandatory=false, $immediate=false,
                                  $ticket=null)
    {
        return 122;
    }
}