<?php

namespace Matthias\SimpleBus\Command\Handler;

use Matthias\SimpleBus\Command\Command;

interface CommandHandler
{
    /**
     * @return void
     */
    public function handle(Command $command);
}
