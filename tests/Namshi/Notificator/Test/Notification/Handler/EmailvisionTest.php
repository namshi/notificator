<?php

namespace Namshi\Notificator\Test\Notification\Handler;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Notification\Handler\Emailvision as EmailvisionHandler;
use Namshi\Emailvision\Client as StubEmailClient;

class EmailvisionTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $emailvisionClient = new StubEmailClient();
        $this->handler = new EmailvisionHandler($emailvisionClient);
    }
    
    public function testTheHandlerDoesntHandleAnyNotificationByDefault()
    {
        $this->assertFalse($this->handler->shouldHandle(new \Namshi\Notificator\Notification('hello')));
    }
    
    public function testTheHandlerHandlesANotification()
    {
        $this->assertTrue($this->handler->shouldHandle(new StubEmailvisionNotification('test_email', 'a@a.com')));
        $this->assertTrue($this->handler->handle(new StubEmailvisionNotification('test_email', 'a@a.com')));
    }
    
//    // This method can be uncommented if you want to try sending a real email  
//    public function testSendingARealEmail()
//    {
//        $manager        = new \Namshi\Notificator\Manager();
//        $emailClient    = new \Namshi\Emailvision\Client(array(
//            'random'    => 'RANDOM',
//            'encrypt'   => 'ENCRYPT',
//            'senddate'  => new \DateTime('2012-01-01 12:00:00'),
//            'uidkey'    => 'email',
//            'stype'     => 'nothing',
//        ));
//        $handler        = new \Namshi\Notification\Notification\Handler\Emailvision($emailClient);
//        $manager->addHandler($handler);
//        $notification   = new \Namshi\Notificator\Notification\Email\EmailvisionNotification('test_email ', 'your.email@gmail.com', array(
//            'name' => 'test'
//        ));
//        
//        $manager->trigger($notification);
//    }
}

class StubEmailvisionNotification extends \Namshi\Notificator\Notification\Email\Emailvision\EmailvisionNotification
{
    public function getRecipientAddress()
    {
        return 'a@a.com';
    }
    
    public function setRecipientAddress($a)
    {
        
    }
}

namespace Namshi\Emailvision;

class Client
{
    public function __construct()
    {
        
    }
    
    public function sendEmail($emailTemplate, $recipient, array $dyn = array())
    {
        return true;
    }
}