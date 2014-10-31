<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\ConfigureBuses;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterEventProviderCollectors;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterHandlers;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\EventBusExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventBusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        // TODO check if CommandBusBundle is enabled

        $container->addCompilerPass(
            new ConfigureBuses(
                'event_bus',
                'event_bus'
            )
        );

        $container->addCompilerPass(
            new RegisterEventProviderCollectors(
                'matthias_event_bus.aggregates_multiple_event_provider_collectors',
                'event_provider_collector'
            )
        );

        $container->addCompilerPass(
            new RegisterHandlers(
                'matthias_event_bus.delegates_to_event_handlers',
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
