# SimpleBus

By Matthias Noback

**Warning: this is just for educational purposes, I don't expect it to be reliable in a production environment**

## Installation

Using Composer:

    composer require matthiasnoback/simple-bus

## Usage

This library is created with Symfony and Doctrine ORM in mind, but you can use it in any kind of project. You just have
to configure the services manually.

In case you do use Symfony, just enable the Symfony bundle in your Symfony project (`Matthias\Simplebus\SymfonyBundle\SimpleBusBundle`).

### Using the command bus

First create a command:

```php
<?php

namespace Matthias\App;

use Matthias\SimpleBus\Command\Command;

class TestCommand implements Command
{
    public function name()
    {
        return 'test_command';
    }
}
```

Then create a command handler:

```php
<?php

namespace Matthias\App;

use Matthias\SimpleBus\Command\Command;
use Matthias\SimpleBus\Command\CommandHandler;

class TestCommandHandler implements TestCommandHandler
{
    public function handle(Command $comment)
    {
        // do something here
    }
}
```

Register the handler as a service:

```yaml
services:
    test_command_handler:
        class: Matthias\App\TestCommandHandler
        tags:
            - { name: command_handler, handles: test_command }
```

Make sure the value in the `handles` attribute of the `command_handler` tag matches the value returned by
`Command::name()`.

Now in your controller, the command handler will be called whenever you do something like this:

```php
<?php

namespace Matthias\App;

class SomeController extends Controller
{
    public function someAction()
    {
        $command = new TestCommand();

        $this->get('command_bus')->handle($command);
    }
}
```

### Doctrine ORM and domain events

Whenever you do something with entities in your command handler, the changes will be automatically persisted afterwards.
Entities that were involved in the transaction will be asked to release their events:

```php
<?php

namespace Matthias\App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Matthias\SimpleBus\Event\ProvidesEvents;
use Matthias\SimpleBus\Event\EventProviderCapabilities;
use Matthias\App\Event\TestEntityCreated;

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
        // this will store the event for now
        $this->raise(new TestEntityCreated($this));
    }
}
```

The `TestEntityCreated` event looks like this:

```php
<?php

namespace Matthias\App\Event;

use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest\Entity\TestEntity;

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
```

When the `flush` operation was successful, the events stored by the entity will be released. Each of the events will
be handled by event handlers.

To create an event handler, first create the class:

```php
<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Matthias\SimpleBus\Event\Event;
use Matthias\SimpleBus\Event\EventHandler;

class TestEntityCreatedEventHandler implements EventHandler
{
    public function handle(Event $event)
    {
        // do anything you like
    }
}
```

Register the event handler using a service tag:

```yaml
    test_event_handler:
        class: Matthias\App\TestEntityCreatedEventHandler
        tags:
            - { name: event_handler, handles: test_entity_created }
```

Make sure the value of the `handles`  attribute is the same as the value returned by `Event::name()`.
