<?php

namespace Matthias\SimpleBus\Event\Handler;

use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Event\Handler\EventHandler;

interface EventHandlersResolver
{
    /**
     * @param Event $event
     * @return EventHandler[]
     * @throws \InvalidArgumentException
     */
    public function resolve(Event $event);
}
