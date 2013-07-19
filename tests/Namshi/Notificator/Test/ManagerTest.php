<?php

namespace Namshi\Notificator\Test;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Namshi\Notificator\NotificationInterface;


class ManagerTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->manager = new Manager();
    }
    
    public function testTheManagerDoesntHaveHandlersByDefault()
    {
        $this->assertCount(0, $this->manager->getHandlers());
    }
    
    public function testTheManagerCanHaveMultipleHandlers()
    {
        $this->manager->addHandler(new StubHandler());
        $this->manager->addHandler(new StubHandler());
        
        $this->assertCount(2, $this->manager->getHandlers());
    }
    
    public function testTheManagerCanTriggerNotificationsToAllHandlers()
    {
        $this->manager->addHandler(new StubHandler());
        $this->manager->addHandler(new StubHandler());
        $notification = new StubNotification();
        $this->manager->trigger($notification);

        $this->assertEquals(2, $notification->count);
    }
    
    public function testTheManagerCanStopPropagationOfNotifications()
    {
        $this->manager->addHandler(new StubHandler(true));
        $this->manager->addHandler(new StubHandler());
        $this->manager->addHandler(new StubHandler());
        $this->manager->addHandler(new StubHandler());
        $this->manager->addHandler(new StubHandler());
        $this->manager->addHandler(new StubHandler());
        $notification = new StubNotification();
        $this->manager->trigger($notification);

        $this->assertCount(6, $this->manager->getHandlers());
        $this->assertEquals(1, $notification->count);
    }
}

class StubHandler implements HandlerInterface
{
    public function __construct($stopPropagation = false)
    {
        $this->stopPropagation = $stopPropagation;
    }
    
    public function shouldHandle(NotificationInterface $notification)
    {
        return true;
    }
    
    public function handle(NotificationInterface $notification)
    {
        $notification->count++;
        
        if ($this->stopPropagation) {
            return false;
        }
    }
}

class StubNotification implements NotificationInterface
{
    public $count = 0;
    
    public function getParameters()
    {
        
    }
    
    public function setParameters(array $parameters)
    {
        
    }
    
    public function getMessage()
    {
        return 111;
    }
}