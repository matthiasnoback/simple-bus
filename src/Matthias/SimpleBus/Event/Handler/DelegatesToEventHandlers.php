<?php

namespace Matthias\SimpleBus\Event\Handler;

use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Event\Bus\EventBus;
use Matthias\SimpleBus\Event\Bus\RemembersNext;

class DelegatesToEventHandlers extends RemembersNext implements EventBus
{
    private $eventHandlersResolver;

    public function __construct(EventHandlersResolver $eventHandlersResolver)
    {
        $this->eventHandlersResolver = $eventHandlersResolver;
    }

    public function handle(Event $event)
    {
        $eventHandlers = $this->eventHandlersResolver->resolve($event);

        array_walk(
            $eventHandlers,
            function (EventHandler $eventHandler) use ($event) {
                $eventHandler->handle($event);
            }
        );
    }
}
