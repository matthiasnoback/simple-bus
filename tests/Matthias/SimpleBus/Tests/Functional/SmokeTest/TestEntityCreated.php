<?php

namespace Matthias\SimpleBus\Tests\Functional\SmokeTest;

use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Tests\Functional\SmokeTest\Entity\TestEntity;

class TestEntityCreated implements Event
{
    private $testEntity;

    public function __construct(TestEntity $testEntity)
    {
        $this->testEntity = $testEntity;
    }

    public function getTestEntity()
    {
        return $this->testEntity;
    }

    public function name()
    {
        return 'test_entity_created';
    }
}
