<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\ConfigureBuses;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterEventProviders;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterHandlers;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\EventBusExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MatthiasEventBusBundle extends Bundle
{
    use RequiresOtherBundles;

    protected function requires()
    {
        return array('MatthiasCommandBusBundle');
    }

    public function build(ContainerBuilder $container)
    {
        $this->checkRequirements(array('MatthiasCommandBusBundle'), $container);

        $container->addCompilerPass(
            new ConfigureBuses(
                'event_bus',
                'event_bus'
            )
        );

        $container->addCompilerPass(
            new RegisterEventProviders(
                'matthias_event_bus.aggregates_multiple_event_providers',
                'event_provider'
            )
        );

        $container->addCompilerPass(
            new RegisterHandlers(
                'matthias_event_bus.event_handlers_resolver',
                'event_handler',
                'handles',
                true
            )
        );
    }

    public function getContainerExtension()
    {
        return new EventBusExtension();
    }
}
