<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Matthias\SimpleBus\Command\CommandBus;
use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Event\EventHandler;

class TestEntityCreatedEventHandler implements EventHandler
{
    private $commandBus;
    public $eventHandled = false;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(Event $event)
    {
        $this->eventHandled = true;

        $this->commandBus->handle(new SomeOtherTestCommand());
    }
}
