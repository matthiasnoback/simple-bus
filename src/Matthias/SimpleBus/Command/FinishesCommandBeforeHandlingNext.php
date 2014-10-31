<?php

namespace Matthias\SimpleBus\Command;

class FinishesCommandBeforeHandlingNext extends RemembersNext
{
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
