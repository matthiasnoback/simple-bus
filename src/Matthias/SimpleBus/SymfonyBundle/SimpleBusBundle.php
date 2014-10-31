<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\ConfigureBuses;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\SimpleBusExtension;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterHandlers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SimpleBusBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SimpleBusExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new RegisterHandlers(
                'matthias_simple_bus.delegating_command_bus',
                'command_handler',
                'handles',
                false
            )
        );

        $container->addCompilerPass(
            new RegisterHandlers(
                'matthias_simple_bus.delegating_event_handler',
                'event_handler',
                'handles',
                true
            )
        );

        $container->addCompilerPass(
            new ConfigureBuses(
                'command_bus',
                'command_bus'
            )
        );

        $container->addCompilerPass(
            new ConfigureBuses(
                'event_bus',
                'event_bus'
            )
        );
    }
}
