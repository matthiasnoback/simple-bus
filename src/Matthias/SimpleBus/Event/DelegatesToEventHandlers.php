<?php

namespace Matthias\SimpleBus\Event;

use Assert\Assertion;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DelegatesToEventHandlers extends RemembersNext implements EventBus
{
    private $container;
    private $handlersByEventName;

    public function __construct(ContainerInterface $container, array $handlersByEventName = array())
    {
        $this->handlersByEventName = $handlersByEventName;
        $this->container = $container;
    }

    public function handle(Event $event)
    {
        if (!isset($this->handlersByEventName[$event->name()])) {
            return;
        }

        foreach ($this->handlersByEventName[$event->name()] as $eventHandlerId) {
            $eventHandler = $this->container->get($eventHandlerId);
            Assertion::isInstanceOf($eventHandler, EventHandler::class);

            /** @var EventHandler $eventHandler */
            $eventHandler->handle($event);
        }
    }
}
