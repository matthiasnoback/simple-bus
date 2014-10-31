<?php

namespace Matthias\SimpleBus\Event;

interface EventHandler
{
    /**
     * @return void
     */
    public function handle(Event $event);
}
