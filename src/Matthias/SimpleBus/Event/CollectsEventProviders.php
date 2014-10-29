<?php

namespace Matthias\SimpleBus\Event;

interface CollectsEventProviders
{
    /**
     * @return ProvidesEvents[]
     */
    public function collectedEventProviders();
}
