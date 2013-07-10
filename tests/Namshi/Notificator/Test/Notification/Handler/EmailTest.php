<?php

namespace Namshi\Notificator\Test\Notification\Handler;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Notification\Handler\Email as EmailHandler;

class EmailTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->handler = new StubEmailHandler();
    }
    
    public function testTheHandlerDoesntHandleAnyNotificationByDefault()
    {
        $this->assertFalse($this->handler->shouldHandle(new StubNotification2()));
    }
    
    public function testTheHandlerHandlesANotification()
    {
        $this->assertTrue($this->handler->shouldHandle(new StubEmailNotification('a@a.com')));
        $this->assertEquals(34, $this->handler->handle(new StubEmailNotification('a@a.com')));
    }
}

class StubEmailHandler extends EmailHandler
{
    public function handle(\Namshi\Notificator\NotificationInterface $notification)
    {
        return $this->getEmailClient();
    }
    
    public function getEmailClient()
    {
        return 34;
    }
}

class StubNotification2 implements \Namshi\Notificator\NotificationInterface
{   
    public function getParameters()
    {
        return array();
    }
    
    public function setParameters(array $parameters)
    {
        
    }
}

class StubEmailNotification extends \Namshi\Notificator\Notification\Email\EmailNotification
{
}