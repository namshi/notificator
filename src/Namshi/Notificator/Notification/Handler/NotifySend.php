<?php

namespace Namshi\Notificator\Notification\Handler;

use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotificationInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use Namshi\Notificator\Exception\ExecutableNotFoundException;

/**
 * Handler to dispatch notification with the notify-send utility available
 * under linux (same thing can be done under MacOSX with growl).
 */
class NotifySend implements HandlerInterface
{
    const NOTIFY_SEND_COMMAND = 'notify-send';

    protected $executableFinder;

    /**
     * Constructor.
     *
     * @param ExecutableFinder $executableFinder
     */
    public function  __construct(ExecutableFinder $executableFinder)
    {
        $this->executableFinder = $executableFinder;
    }

    /**
     * @inheritDoc
     */
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf NotifySendNotificationInterface && $this->isExecutableAvailable();
    }

    /**
     * @inheritDoc
     */
    public function handle(NotificationInterface $notification)
    {
        if (!$this->isExecutableAvailable()) {
            throw new ExecutableNotFoundException(sprintf('%s command not found', self::NOTIFY_SEND_COMMAND));
        }

        $process = new Process($this->getCommand($notification));
        $process->run();

        if (!$process->isSuccessful()) {
           throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    /**
     * Returns the command to be executed via CLI.
     *
     * @param NotifySendNotificationInterface $notification
     * @return string
     */
    protected function getCommand(NotifySendNotificationInterface $notification)
    {
        return sprintf(self::NOTIFY_SEND_COMMAND.' %s', $notification->getMessage());
    }

    /**
     * Returns if the command to be executed exists.
     *
     * @return boolean
     */
    public function isExecutableAvailable()
    {
        return null !== $this->executableFinder->find(self::NOTIFY_SEND_COMMAND);
    }
}