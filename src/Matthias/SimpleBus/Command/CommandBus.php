<?php

namespace Matthias\SimpleBus\Command;

interface CommandBus
{
    public function handle(Command $command);

    public function setNext(CommandBus $commandBus);
}
