<?php

namespace Matthias\SimpleBus\Event;

interface EventBus
{
    public function handle(Event $event);
}
