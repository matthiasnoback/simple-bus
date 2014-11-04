<?php

namespace Matthias\SimpleBus\Command\Handler;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandBus;
use Matthias\SimpleBus\Command\RemembersNext;

class DelegatesToCommandHandlers extends RemembersNext implements CommandBus
{
    private $commandHandlerResolver;

    public function __construct(CommandHandlerResolver $commandHandlerResolver)
    {
        $this->commandHandlerResolver = $commandHandlerResolver;
    }

    public function handle(Command $command)
    {
        $this->commandHandlerResolver->resolve($command)->handle($command);

        $this->next($command);
    }
}
