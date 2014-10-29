<?php

namespace Matthias\SimpleBus\Event;

class HasNoEventProviders implements CollectsEventProviders
{
    public function collectedEventProviders()
    {
        return array();
    }
}
