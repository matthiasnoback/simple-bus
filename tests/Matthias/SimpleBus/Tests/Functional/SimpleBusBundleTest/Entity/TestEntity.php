<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest\Entity;

use Doctrine\ORM\Mapping as ORM;
use Matthias\SimpleBus\Event\ProvidesEvents;
use Matthias\SimpleBus\Event\EventProviderCapabilities;
use Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest\TestEntityCreated;

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
