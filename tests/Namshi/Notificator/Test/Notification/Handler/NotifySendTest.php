<?php

namespace Namshi\Notificator\Test\Notification\Handler;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;
use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ExecutableFinder;

class NotifySendTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->handler = new NotifySendHandler(new ExecutableFinder);
    }
    
    public function testTheHandlerDoesntHandleAnyNotificationByDefault()
    {
        $this->assertFalse($this->handler->shouldHandle(new \Namshi\Notificator\Notification('hello')));
    }
    
    public function testTheHandlerHandlesANotification()
    {
        if (defined('PHP_WINDOWS_VERSION_BUILD') || false === $this->handler->isExecutableAvailable()) {
            $this->setExpectedException('Namshi\Notificator\Exception\ExecutableNotFoundException');
            $this->assertFalse($this->handler->shouldHandle(new NotifySendNotification('my message')));
            $this->assertNull($this->handler->handle(new NotifySendNotification('my message')));
            $this->handler->handle(new NotifySendNotification('my message'));
        } else {
            $this->assertTrue($this->handler->shouldHandle(new NotifySendNotification('my message')));
            $this->assertEmpty($this->handler->handle(new NotifySendNotification('my message')));
        }
    }
}