<?php

namespace Matthias\SimpleBus\Command;

interface Command
{
    /**
     * @return string
     */
    public function name();
}
