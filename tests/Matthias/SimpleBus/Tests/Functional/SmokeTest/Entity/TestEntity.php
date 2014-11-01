<?php

namespace Matthias\SimpleBus\Tests\Functional\SmokeTest\Entity;

use Doctrine\ORM\Mapping as ORM;
use Matthias\SimpleBus\Event\Provider\EventProviderCapabilities;
use Matthias\SimpleBus\Event\Provider\ProvidesEvents;
use Matthias\SimpleBus\Tests\Functional\SmokeTest\TestEntityCreated;

/**
 * @ORM\Entity
 */
class TestEntity implements ProvidesEvents
{
    use EventProviderCapabilities;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    public function __construct()
    {
        $this->raise(new TestEntityCreated($this));
    }
}
