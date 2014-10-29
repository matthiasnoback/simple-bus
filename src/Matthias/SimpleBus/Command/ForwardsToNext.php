<?php

namespace Matthias\SimpleBus\Command;

class ForwardsToNext extends RemembersNext
{
    public function handle(Command $command)
    {
        $this->next($command);
    }
}
