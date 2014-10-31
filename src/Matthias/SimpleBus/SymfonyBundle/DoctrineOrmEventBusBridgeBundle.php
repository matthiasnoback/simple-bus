<?php

namespace Matthias\SimpleBus\SymfonyBundle;

use Matthias\SimpleBus\SymfonyBundle\DependencyInjection\DoctrineOrmEventBusBridgeExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DoctrineOrmEventBusBridgeBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new DoctrineOrmEventBusBridgeExtension();
    }
}
