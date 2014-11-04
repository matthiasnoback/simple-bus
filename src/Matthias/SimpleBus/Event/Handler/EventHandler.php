<?php

namespace Matthias\SimpleBus\Event\Handler;

use Matthias\SimpleBus\Event\Event;

interface EventHandler
{
    /**
     * @return void
     */
    public function handle(Event $event);
}
