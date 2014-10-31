<?php

namespace Matthias\SimpleBus\Event\Provider;

use Assert\Assertion;

class AggregatesMultipleEventProviderCollectors implements CollectsEventProviders
{
    /** @var CollectsEventProviders[] */
    private $eventProviderCollectors;

    public function __construct(array $eventProviderCollectors)
    {
        Assertion::allIsInstanceOf(
            $eventProviderCollectors,
            CollectsEventProviders::class,
            'Expected an array of CollectsEventProviders instances',
            null
        );

        $this->eventProviderCollectors = $eventProviderCollectors;
    }

    public function collectedEventProviders()
    {
        $collectedEventProviders = array();

        foreach ($this->eventProviderCollectors as $collector) {
            $collectedEventProviders = array_merge($collectedEventProviders, $collector->collectedEventProviders());
        }

        return $collectedEventProviders;
    }
}
