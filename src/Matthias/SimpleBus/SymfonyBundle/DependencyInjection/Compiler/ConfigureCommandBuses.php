<?php

namespace Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConfigureCommandBuses implements CompilerPassInterface
{
    private $mainCommandBusId;
    private $commandBusTag;

    public function __construct($mainCommandBusId, $commandBusTag)
    {
        $this->mainCommandBusId = $mainCommandBusId;
        $this->commandBusTag = $commandBusTag;
    }

    public function process(ContainerBuilder $container)
    {
        $queue = new \SplPriorityQueue();

        foreach ($container->findTaggedServiceIds($this->commandBusTag) as $commandBusId => $tags) {
            foreach ($tags as $tagAttributes) {
                $priority = isset($tagAttributes['priority']) ? $tagAttributes['priority'] : 0;
                $queue->insert($commandBusId, $priority);
            }
        }

        $previousCommandBusId = $this->mainCommandBusId;
        foreach ($queue as $currentCommandBusId) {
            $definition = $container->findDefinition($previousCommandBusId);
            $definition->addMethodCall('setNext', array(new Reference($currentCommandBusId)));
            $previousCommandBusId = $currentCommandBusId;
        }
    }
}
