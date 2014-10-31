<?php

namespace Matthias\SimpleBus\Event;

use Assert\Assertion;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DelegatesToEventHandlers extends RemembersNext implements EventBus
{
    private $container;
    private $handlerIdsByEventName;

    public function __construct(ContainerInterface $container, array $handlerIdsByEventName = array())
    {
        $this->container = $container;
        $this->handlerIdsByEventName = $handlerIdsByEventName;
    }

    public function handle(Event $event)
    {
        $eventHandlers = $this->resolveEventHandlers($event);

        array_walk(
            $eventHandlers,
            function (EventHandler $eventHandler) use ($event) {
                $eventHandler->handle($event);
            }
        );
    }

    private function resolveEventHandlers(Event $event)
    {
        return array_map(
            function ($eventHandlerId) {
                $eventHandler = $this->container->get($eventHandlerId);

                Assertion::isInstanceOf($eventHandler, EventHandler::class);

                return $eventHandler;
            },
            $this->handlerIdsByEventName($event->name())
        );
    }

    private function handlerIdsByEventName($name)
    {
        return isset($this->handlerIdsByEventName[$name]) ? $this->handlerIdsByEventName[$name] : array();
    }
}
