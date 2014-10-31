<?php

namespace Matthias\SimpleBus\SymfonyBundle\DependencyInjection;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\ConfigureBuses;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterEventProviderCollectors;
use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\Compiler\RegisterHandlers;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class DoctrineOrmBridgeExtension extends Extension
{
    public function getAlias()
    {
        return 'doctrine_orm_event_bus_bridge';
    }

    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('doctrine_orm.yml');
    }
}
