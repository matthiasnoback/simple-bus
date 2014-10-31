<?php

namespace Matthias\SimpleBus\Event;

interface EventBus
{
    /**
     * @return void
     */
    public function handle(Event $event);
}
