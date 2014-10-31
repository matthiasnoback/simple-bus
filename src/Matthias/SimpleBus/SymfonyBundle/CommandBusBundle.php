<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\ConfigureBuses;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterHandlers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CommandBusBundle extends Bundle
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
                'matthias_simple_bus.delegating_command_bus',
                'command_handler',
                'handles',
                false
            )
        );
    }
}
