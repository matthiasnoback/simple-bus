<?php

namespace Matthias\SimpleBus\Event\CommandBus;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandBus;
use Matthias\SimpleBus\Command\RemembersNext as CommandBusRemembersNext;
use Matthias\SimpleBus\Event\EventBus;
use Matthias\SimpleBus\Event\Provider\CollectsEventProviders;

class DispatchesEvents extends CommandBusRemembersNext implements CommandBus
{
    private $collector;
    private $eventBus;

    public function __construct(CollectsEventProviders $eventProviderCollector, EventBus $eventBus)
    {
        $this->collector = $eventProviderCollector;
        $this->eventBus = $eventBus;
    }

    public function handle(Command $command)
    {
        $this->next($command);

        foreach ($this->collector->collectedEventProviders() as $eventProvider) {
            foreach ($eventProvider->releaseEvents() as $event) {
                $this->eventBus->handle($event);
            }
        }
    }
}
