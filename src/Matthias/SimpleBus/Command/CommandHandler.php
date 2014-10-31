<?php

namespace Matthias\SimpleBus\Command;

interface CommandHandler
{
    /**
     * @return void
     */
    public function handle(Command $command);
}
