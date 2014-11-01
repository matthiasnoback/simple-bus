<?php

namespace Matthias\SimpleBus\Tests\Event;

use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Event\EventBus;
use Matthias\SimpleBus\Event\FinishesEventBeforeHandlingNext;

class FinishesEventBeforeHandlingNextTest extends \PHPUnit_Framework_TestCase
{
    /** @var FinishesEventBeforeHandlingNext */
    private $eventBus;

    /** @var \PHPUnit_Framework_MockObject_MockObject|EventBus */
    private $next;

    protected function setUp()
    {
        $this->eventBus = new FinishesEventBeforeHandlingNext();
        $this->next = $this->mockEventBus();
        $this->eventBus->setNext($this->next);
    }

    /**
     * @test
     */
    public function it_forwards_the_handle_call_to_the_next_event_bus()
    {
        $event = $this->dummyEvent();

        $this->next
            ->expects($this->once())
            ->method('handle')
            ->with($this->identicalTo($event));

        $this->eventBus->handle($event);
    }

    /**
     * @test
     */
    public function it_handles_events_in_the_original_order_if_extra_events_are_added_while_handling_the_first()
    {
        $originalEvent = $this->dummyEvent();
        $eventTriggeredByOriginalEvent = $this->dummyEvent();

        $orderOfEvents = array();

        $this->next
            ->expects($this->any())
            ->method('handle')
            ->will(
                $this->returnCallback(
                    function ($event) use ($eventTriggeredByOriginalEvent, &$orderOfEvents) {
                        $orderOfEvents[] = $event;
                        if ($event !== $eventTriggeredByOriginalEvent) {
                            $this->eventBus->handle($eventTriggeredByOriginalEvent);
                            $orderOfEvents[] = 'finished handling original event';
                        }
                    }
                )
            );

        $this->eventBus->handle($originalEvent);

        $this->assertSame(
            array(
                $originalEvent,
                'finished handling original event',
                $eventTriggeredByOriginalEvent
            ),
            $orderOfEvents
        );
    }

    private function mockEventBus()
    {
        return $this->getMock('Matthias\SimpleBus\Event\EventBus');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Event
     */
    private function dummyEvent()
    {
        return $this->getMock('Matthias\SimpleBus\Event\Event');
    }
}
