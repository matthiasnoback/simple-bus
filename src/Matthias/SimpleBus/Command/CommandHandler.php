<?php

namespace Matthias\SimpleBus\Command;

interface CommandHandler
{
    public function handle(Command $command);
}
