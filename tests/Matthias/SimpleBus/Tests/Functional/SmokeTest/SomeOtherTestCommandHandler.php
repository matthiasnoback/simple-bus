<?php

namespace Matthias\SimpleBus\Tests\Functional\SmokeTest;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandHandler;
use Matthias\SimpleBus\Event\EventBus;
use Matthias\SimpleBus\Event\EventHandler;

class SomeOtherTestCommandHandler implements CommandHandler
{
    public $commandHandled = false;
    private $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function handle(Command $command)
    {
        $this->commandHandled = true;

        // it's possible to directly call the event bus
        $this->eventBus->handle(new SomeOtherEvent());
    }
}
