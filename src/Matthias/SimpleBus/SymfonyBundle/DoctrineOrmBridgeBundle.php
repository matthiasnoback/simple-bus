<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\DoctrineOrmBridgeExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DoctrineOrmBridgeBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new DoctrineOrmBridgeExtension();
    }
}
