<?php

namespace Matthias\SimpleBus\DoctrineORM;

use Doctrine\ORM\EntityManager;
use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\RemembersNext;

class WrapsNextCommandInTransaction extends RemembersNext
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(Command $command)
    {
        $this->entityManager->transactional(
            function () use ($command) {
                $this->next($command);
            }
        );
    }
}
