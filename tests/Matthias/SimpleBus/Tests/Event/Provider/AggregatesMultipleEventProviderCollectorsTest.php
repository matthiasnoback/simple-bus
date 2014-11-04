<?php

namespace Matthias\SimpleBus\Tests\Event\Provider;

use Matthias\SimpleBus\Event\Provider\AggregatesMultipleEventProviders;

class AggregatesMultipleEventProviderCollectorsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_collects_event_providers_from_several_other_collectors()
    {
        $event1 = $this->createDummyEvent();
        $event2 = $this->createDummyEvent();

        $aggregator = new AggregatesMultipleEventProviders(
            array(
                new EventProviderStub(array($event1)),
                new EventProviderStub(array($event2))
            )
        );

        $this->assertSame(
            array(
                $event1,
                $event2
            ),
            $aggregator->releaseEvents()
        );
    }

    private function createDummyEvent()
    {
        return $this->getMock('Matthias\SimpleBus\Event\Event');
    }
}
