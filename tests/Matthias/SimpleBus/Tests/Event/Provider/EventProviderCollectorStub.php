<?php

namespace Matthias\SimpleBus\Tests\Event\Provider;

use Matthias\SimpleBus\Event\Provider\CollectsEventProviders;

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
