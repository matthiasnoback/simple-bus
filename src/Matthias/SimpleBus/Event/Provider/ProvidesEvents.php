<?php

namespace Matthias\SimpleBus\Event\Provider;

use Matthias\SimpleBus\Event\Event;

interface ProvidesEvents
{
    /**
     * @return Event[]
     */
    public function releaseEvents();
}
