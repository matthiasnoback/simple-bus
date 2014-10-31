<?php

namespace Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConfigureBuses implements CompilerPassInterface
{
    private $mainBusId;
    private $busTag;

    public function __construct($mainBusId, $busTag)
    {
        $this->mainBusId = $mainBusId;
        $this->busTag = $busTag;
    }

    public function process(ContainerBuilder $container)
    {
        $orderedBusIds = new \SplPriorityQueue();

        foreach ($container->findTaggedServiceIds($this->busTag) as $specializedBusId => $tags) {
            foreach ($tags as $tagAttributes) {
                $priority = isset($tagAttributes['priority']) ? $tagAttributes['priority'] : 0;
                $orderedBusIds->insert($specializedBusId, $priority);
            }
        }

        $previousBusId = $this->mainBusId;
        foreach ($orderedBusIds as $specializedBusId) {
            $definition = $container->findDefinition($previousBusId);
            $definition->addMethodCall('setNext', array(new Reference($specializedBusId)));
            $previousBusId = $specializedBusId;
        }
    }
}
