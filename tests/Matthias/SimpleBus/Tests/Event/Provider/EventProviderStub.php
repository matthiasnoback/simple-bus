<?php

namespace Matthias\SimpleBus\Tests\Event\Provider;

use Matthias\SimpleBus\Event\Provider\ProvidesEvents;

class EventProviderStub implements ProvidesEvents
{
    private $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function releaseEvents()
    {
        return $this->events;
    }
}
