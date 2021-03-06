<?php

namespace Matthias\SimpleBus\Event\Provider;

use Matthias\SimpleBus\Event\Event;

trait EventProviderCapabilities
{
    private $events = array();

    public function releaseEvents()
    {
        $events = $this->events;

        $this->events = array();

        return $events;
    }

    public function raise(Event $event)
    {
        $this->events[] = $event;
    }
}
