<?php

namespace Matthias\SimpleBus\Tests\Event;

use Matthias\SimpleBus\Event\CollectsEventProviders;

class EventProviderCollectorStub implements CollectsEventProviders
{
    private $eventProviders;

    public function __construct(array $eventProviders)
    {
        $this->eventProviders = $eventProviders;
    }

    public function collectedEventProviders()
    {
        return $this->eventProviders;
    }
}
