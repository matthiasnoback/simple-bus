<?php

namespace Matthias\SimpleBus\Event;

interface Event
{
    /**
     * @return string
     */
    public function name();
}
