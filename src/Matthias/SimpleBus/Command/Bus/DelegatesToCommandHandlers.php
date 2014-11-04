<?php

namespace Matthias\SimpleBus\Command\Bus;

use Matthias\SimpleBus\Command\Bus;
use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\Handler\CommandHandlerResolver;

class DelegatesToCommandHandlers implements CommandBus
{
    use RemembersNext;

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
