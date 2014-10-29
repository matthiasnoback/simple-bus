<?php

namespace Matthias\SimpleBus\Event;

interface ProvidesEvents
{
    /**
     * @return Event[]
     */
    public function releaseEvents();
}
