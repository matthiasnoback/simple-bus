<?php

namespace Matthias\SimpleBus\Command;

use Assert\Assertion;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
        $this->resolveCommandHandler($command)->handle($command);

        $this->next($command);
    }

    private function resolveCommandHandler(Command $command)
    {
        Assertion::string(
            $command->name(),
            sprintf(
                '%s::name() should return a string',
                get_class($command)
            )
        );

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

        return $commandHandler;
    }
}
