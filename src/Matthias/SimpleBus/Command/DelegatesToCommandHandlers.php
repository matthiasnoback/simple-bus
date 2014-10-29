<?php

namespace Matthias\SimpleBus\Command;

use Assert\Assertion;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Matthias\SimpleBus\Command\CommandHandler;

class DelegatesToCommandHandlers extends RemembersNext implements CommandBus
{
    private $container;
    private $commandHandlers;

    public function __construct(ContainerInterface $container, array $commandHandlers = array())
    {
        $this->container = $container;
        $this->commandHandlers = $commandHandlers;
    }

    public function handle(Command $command)
    {
        if (!isset($this->commandHandlers[$command->name()])) {
            throw new \InvalidArgumentException(
                sprintf(
                    'No valid handler found for command "%s"',
                    $command->name()
                )
            );
        }

        $commandHandler = $this->container->get($this->commandHandlers[$command->name()]);
        Assertion::isInstanceOf($commandHandler, CommandHandler::class);

        $commandHandler->handle($command);

        $this->next($command);
    }
}
