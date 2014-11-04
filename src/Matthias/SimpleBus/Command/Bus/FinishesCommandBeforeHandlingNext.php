<?php

namespace Matthias\SimpleBus\Command\Bus;

use Matthias\SimpleBus\Command\Command;

class FinishesCommandBeforeHandlingNext implements CommandBus
{
    use RemembersNext;

    private $queue = array();
    private $isHandling = false;

    public function handle(Command $command)
    {
        $this->queue[] = $command;

        if (!$this->isHandling) {
            $this->isHandling = true;

            while ($command = array_shift($this->queue)) {
                $this->next($command);
            }

            $this->isHandling = false;
        }
    }
}
