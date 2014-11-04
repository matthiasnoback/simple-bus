<?php

namespace Matthias\SimpleBus\Event\CommandBus;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\Bus\CommandBus;
use Matthias\SimpleBus\Command\Bus\RemembersNext;
use Matthias\SimpleBus\Event\Bus\EventBus;
use Matthias\SimpleBus\Event\Provider\ProvidesEvents;

class DispatchesEvents extends RemembersNext implements CommandBus
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
