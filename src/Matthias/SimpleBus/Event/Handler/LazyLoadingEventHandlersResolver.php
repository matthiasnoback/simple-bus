<?php

namespace Matthias\SimpleBus\Event\Handler;

use Assert\Assertion;
use Matthias\SimpleBus\Event\Event;

class LazyLoadingEventHandlersResolver implements EventHandlersResolver
{
    private $serviceLocator;
    private $handlerServiceIdsByEventName;

    public function __construct(callable $serviceLocator, array $handlerServiceIdsByEventName)
    {
        $this->serviceLocator = $serviceLocator;
        $this->handlerServiceIdsByEventName = $handlerServiceIdsByEventName;
    }

    public function resolve(Event $event)
    {
        return array_map(
            array($this, 'loadEventHandler'),
            $this->handlerIdsByEventName($event->name())
        );
    }

    public function loadEventHandler($serviceId)
    {
        $eventHandler = call_user_func($this->serviceLocator, $serviceId);

        Assertion::isInstanceOf(
            $eventHandler,
            'Matthias\SimpleBus\Event\Handler\EventHandler'
        );

        return $eventHandler;
    }

    private function handlerIdsByEventName($name)
    {
        return isset($this->handlerServiceIdsByEventName[$name]) ? $this->handlerServiceIdsByEventName[$name] : array();
    }
}
