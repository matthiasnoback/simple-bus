<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\CommandBusExtension;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\ConfigureBuses;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterHandlers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MatthiasCommandBusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new ConfigureBuses(
                'command_bus',
                'command_bus'
            )
        );

        $container->addCompilerPass(
            new RegisterHandlers(
                'matthias_command_bus.command_handler_resolver',
                'command_handler',
                'handles',
                false
            )
        );
    }

    public function getContainerExtension()
    {
        return new CommandBusExtension();
    }
}
