<?php

namespace Matthias\SimpleBus\Event\Bus;

use Matthias\SimpleBus\Event\Event;

trait RemembersNext
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
