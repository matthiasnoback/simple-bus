<?php

namespace Matthias\SimpleBus\Event;

class FinishesEventBeforeHandlingNext extends RemembersNext implements EventBus
{
    private $queue = array();
    private $isHandling = false;

    public function handle(Event $event)
    {
        $this->queue[] = $event;

        if (!$this->isHandling) {
            $this->isHandling = true;

            while ($event = array_shift($this->queue)) {
                $this->next($event);
            }

            $this->isHandling = false;
        }
    }
}
