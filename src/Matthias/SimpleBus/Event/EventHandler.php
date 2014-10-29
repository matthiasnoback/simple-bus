<?php

namespace Matthias\SimpleBus\Event;

interface EventHandler
{
    public function handle(Event $event);
}
