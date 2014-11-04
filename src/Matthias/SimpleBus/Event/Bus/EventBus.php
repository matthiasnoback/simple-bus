<?php

namespace Matthias\SimpleBus\Event\Bus;

use Matthias\SimpleBus\Event\Event;

interface EventBus
{
    /**
     * @return void
     */
    public function handle(Event $event);
}
