<?php

namespace Matthias\SimpleBus\DoctrineORM\CommandBus;

use Doctrine\ORM\EntityManager;
use Matthias\SimpleBus\Command\Bus\CommandBus;
use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\Bus\RemembersNext;

class WrapsNextCommandInTransaction implements CommandBus
{
    use RemembersNext;

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(Command $command)
    {
        $commandBus = $this;

        $this->entityManager->transactional(
            function () use ($commandBus, $command) {
                $commandBus->next($command);
            }
        );
    }
}
