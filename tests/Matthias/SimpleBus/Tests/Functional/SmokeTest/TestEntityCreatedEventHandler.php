<?php

namespace Matthias\SimpleBus\Tests\Functional\SmokeTest;

use Matthias\SimpleBus\Command\Bus\CommandBus;
use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Event\Handler\EventHandler;

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
