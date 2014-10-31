<?php

namespace Matthias\SimpleBus\Event;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandBus;
use Matthias\SimpleBus\Command\RemembersNext as CommandBusRemembersNext;

class DispatchesEvents extends CommandBusRemembersNext implements CommandBus
{
    private $collector;
    private $eventHandler;

    public function __construct(CollectsEventProviders $collector, EventHandler $eventHandler)
    {
        $this->collector = $collector;
        $this->eventHandler = $eventHandler;
    }

    public function handle(Command $command)
    {
        $this->next($command);

        foreach ($this->collector->collectedEventProviders() as $eventProvider) {
            foreach ($eventProvider->releaseEvents() as $event) {
                $this->eventHandler->handle($event);
            }
        }
    }
}
