<?php

namespace Matthias\SimpleBus\Tests\Command;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandBus;
use Matthias\SimpleBus\Command\FinishesCommandBeforeHandlingNext;

class FinishesCommandBeforeHandlingNextTest extends \PHPUnit_Framework_TestCase
{
    /** @var FinishesCommandBeforeHandlingNext */
    private $commandBus;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $next;

    protected function setUp()
    {
        $this->commandBus = new FinishesCommandBeforeHandlingNext();
        $this->next = $this->mockCommandBus();
        $this->commandBus->setNext($this->next);
    }

    /**
     * @test
     */
    public function it_forwards_the_handle_call_to_the_next_command_bus()
    {
        $command = $this->dummyCommand();

        $this->next
            ->expects($this->once())
            ->method('handle')
            ->with($this->identicalTo($command));

        $this->commandBus->handle($command);
    }

    /**
     * @test
     */
    public function it_handles_commands_in_the_original_order_if_extra_commands_are_added_while_handling_the_first()
    {
        $originalCommand = $this->dummyCommand();
        $commandTriggeredByOriginalCommand = $this->dummyCommand();

        $orderOfEvents = array();

        $this->next
            ->expects($this->any())
            ->method('handle')
            ->will(
                $this->returnCallback(
                    function ($command) use ($commandTriggeredByOriginalCommand, &$orderOfEvents) {
                        $orderOfEvents[] = $command;
                        if ($command !== $commandTriggeredByOriginalCommand) {
                            $this->commandBus->handle($commandTriggeredByOriginalCommand);
                            $orderOfEvents[] = 'finished handling original command';
                        }
                    }
                )
            );

        $this->commandBus->handle($originalCommand);

        $this->assertSame(
            array(
                $originalCommand,
                'finished handling original command',
                $commandTriggeredByOriginalCommand
            ),
            $orderOfEvents
        );
    }

    private function mockCommandBus()
    {
        return $this->getMock(CommandBus::class);
    }

    private function dummyCommand()
    {
        return $this->getMock(Command::class);
    }
}
