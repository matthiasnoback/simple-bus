<?php

namespace Matthias\SimpleBus\Event;

class ForwardsToNext extends RemembersNext implements EventBus
{
    public function handle(Event $event)
    {
        $this->next($event);
    }
}
