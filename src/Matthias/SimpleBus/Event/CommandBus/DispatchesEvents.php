<?php

namespace Matthias\SimpleBus\Event\CommandBus;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandBus;
use Matthias\SimpleBus\Command\RemembersNext as CommandBusRemembersNext;
use Matthias\SimpleBus\Event\EventBus;
use Matthias\SimpleBus\Event\Provider\ProvidesEvents;

class DispatchesEvents extends CommandBusRemembersNext implements CommandBus
{
    private $eventProvider;
    private $eventBus;

    public function __construct(ProvidesEvents $eventProvider, EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
        $this->eventProvider = $eventProvider;
    }

    public function handle(Command $command)
    {
        $this->next($command);

        foreach ($this->eventProvider->releaseEvents() as $event) {
            $this->eventBus->handle($event);
        }
    }
}
