<?php

namespace Matthias\SimpleBus\Command;

abstract class RemembersNext implements CommandBus
{
    private $next;

    public function setNext(CommandBus $commandBus)
    {
        $this->next = $commandBus;
    }

    public function next(Command $command)
    {
        if ($this->next instanceof CommandBus) {
            $this->next->handle($command);
        }
    }
}
