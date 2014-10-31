<?php

namespace Matthias\SimpleBus\Tests\Functional\SmokeTest;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Matthias\SimpleBus\SymfonyBundle\MatthiasCommandBusBundle;
use Matthias\SimpleBus\SymfonyBundle\MatthiasDoctrineOrmEventBusBridgeBundle;
use Matthias\SimpleBus\SymfonyBundle\MatthiasEventBusBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    private $tempDir;

    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);

        $this->tempDir = sys_get_temp_dir() . '/' . uniqid();
        mkdir($this->tempDir, 0777, true);
    }

    public function registerBundles()
    {
        return array(
            new DoctrineBundle(),
            new MatthiasCommandBusBundle(),
            new MatthiasEventBusBundle(),
            new MatthiasDoctrineOrmEventBusBridgeBundle()
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config.yml');
    }

    public function getCacheDir()
    {
        return $this->tempDir . '/cache';
    }

    public function getLogDir()
    {
        return $this->tempDir . '/logs';
    }
}
