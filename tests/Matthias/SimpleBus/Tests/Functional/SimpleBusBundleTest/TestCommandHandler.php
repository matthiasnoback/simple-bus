<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Doctrine\ORM\EntityManager;
use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandHandler;
use Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest\Entity\TestEntity;

class TestCommandHandler implements CommandHandler
{
    public $commandHandled = false;

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(Command $command)
    {
        $this->commandHandled = true;

        $entity = new TestEntity();

        $this->entityManager->persist($entity);

        // flush should be called inside the TransactionalCommandBus
    }
}
