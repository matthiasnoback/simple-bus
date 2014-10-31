<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\DoctrineOrmEventBusBridgeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MatthiasDoctrineOrmEventBusBridgeBundle extends Bundle
{
    use RequiresOtherBundles;

    public function getContainerExtension()
    {
        return new DoctrineOrmEventBusBridgeExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $this->checkRequirements(array('MatthiasCommandBusBundle', 'MatthiasEventBusBundle'), $container);
    }
}
