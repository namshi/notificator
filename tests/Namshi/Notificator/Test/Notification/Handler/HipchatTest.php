<?php

namespace Namshi\Notificator\Test\Notification\Handler;

use PHPUnit_Framework_TestCase;
use Namshi\Notificator\Notification\HipChat\HipChatNotification;
use Namshi\Notificator\Notification\Handler\HipChat as HipChatHandler;
use HipChat\HipChat;

class HipChatTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->handler = new HipChatHandler(new StubHipChat('1234'));
    }
    
    public function testTheHandlerDoesntHandleAnyNotificationByDefault()
    {
        $this->assertFalse($this->handler->shouldHandle(new \Namshi\Notificator\Notification('hello')));
    }
    
    public function testTheHandlerHandlesANotification()
    {
        $this->assertTrue($this->handler->shouldHandle(new HipChatNotification('my message', 'myId', 'room1')));
        $this->assertEmpty($this->handler->handle(new HipChatNotification('my message', 'myId', 'room1', array(
            'notify' => true,
        ))));
    }
}

class StubHipChat extends HipChat
{
    public function message_room($room_id, $from, $message, $notify = false, $color = self::COLOR_YELLOW, $message_format = self::FORMAT_HTML)
    {
        return null;
    }
}