<?php

namespace Matthias\SimpleBus\Event\Provider;

use Assert\Assertion;

class AggregatesMultipleEventProviders implements ProvidesEvents
{
    /** @var ProvidesEvents[] */
    private $eventProviders;

    public function __construct(array $eventProviders)
    {
        Assertion::allIsInstanceOf(
            $eventProviders,
            'Matthias\SimpleBus\Event\Provider\ProvidesEvents',
            'Expected an array of ProvidesEvents instances',
            null
        );

        $this->eventProviders = $eventProviders;
    }

    public function releaseEvents()
    {
        $events = array();

        foreach ($this->eventProviders as $eventProvider) {
            $events = array_merge($events, $eventProvider->releaseEvents());
        }

        return $events;
    }
}
