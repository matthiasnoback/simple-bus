<?php

namespace Matthias\SimpleBus\Event\Bus;

use Matthias\SimpleBus\Event\Event;

abstract class RemembersNext implements EventBus
{
    private $next;

    public function setNext(EventBus $eventBus)
    {
        $this->next = $eventBus;
    }

    protected function next(Event $event)
    {
        if ($this->next instanceof EventBus) {
            $this->next->handle($event);
        }
    }
}
