<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandHandler;
use Matthias\SimpleBus\Event\EventHandler;

class SomeOtherTestCommandHandler implements CommandHandler
{
    public $commandHandled = false;
    private $eventHandler;

    public function __construct(EventHandler $eventHandler)
    {
        $this->eventHandler = $eventHandler;
    }

    public function handle(Command $command)
    {
        $this->commandHandled = true;

        // it's possible to directly call the event handler
        $this->eventHandler->handle(new SomeOtherEvent());
    }
}
