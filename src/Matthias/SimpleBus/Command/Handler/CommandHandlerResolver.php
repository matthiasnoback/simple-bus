<?php

namespace Matthias\SimpleBus\Command\Handler;

use Matthias\SimpleBus\Command\Command;

interface CommandHandlerResolver
{
    /**
     * @param Command $command
     * @return CommandHandler
     * @throws \InvalidArgumentException
     */
    public function resolve(Command $command);
}
