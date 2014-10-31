<?php

namespace Matthias\SimpleBus\DoctrineORM;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Matthias\SimpleBus\Event\Provider\CollectsEventProviders;
use Matthias\SimpleBus\Event\Provider\ProvidesEvents;

class CollectsEventProvidingEntities implements EventSubscriber, CollectsEventProviders
{
    private $collectedEventProviders = array();

    public function getSubscribedEvents()
    {
        return array(
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        );
    }

    public function postPersist(LifecycleEventArgs $event)
    {
        $this->collectEntity($event);
    }

    public function postUpdate(LifecycleEventArgs $event)
    {
        $this->collectEntity($event);
    }

    public function postRemove(LifecycleEventArgs $event)
    {
        $this->collectEntity($event);
    }

    public function collectedEventProviders()
    {
        $collectedEventProviders = $this->collectedEventProviders;

        $this->clear();

        return $collectedEventProviders;
    }

    private function collectEntity(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if ($entity instanceof ProvidesEvents) {
            $this->collectedEventProviders[] = $entity;
        }
    }

    private function clear()
    {
        $this->collectedEventProviders = array();
    }
}
