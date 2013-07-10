<?php

namespace Namshi\Notificator\Test\Notification\Handler;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;
use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;

class NotifySendTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->handler = new NotifySendHandler();
    }
    
    public function testTheHandlerDoesntHandleAnyNotificationByDefault()
    {
        $this->assertFalse($this->handler->shouldHandle(new StubNotification3()));
    }
    
    public function testTheHandlerHandlesANotification()
    {
        $this->assertTrue($this->handler->shouldHandle(new NotifySendNotification('my message')));
        $this->assertNull($this->handler->handle(new NotifySendNotification('my message')));
    }
}

class StubNotification3 implements \Namshi\Notificator\NotificationInterface
{   
    public function getParameters()
    {
        return array();
    }
    
    public function setParameters(array $parameters)
    {
        
    }
}