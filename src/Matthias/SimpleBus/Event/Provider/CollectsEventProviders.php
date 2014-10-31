<?php

namespace Matthias\SimpleBus\Event\Provider;

interface CollectsEventProviders
{
    /**
     * When asked to return instances of ProvidesEvents, the instance should afterwards immediately forget about them.
     *
     * @return ProvidesEvents[]
     */
    public function collectedEventProviders();
}
