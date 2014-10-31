<?php

namespace Matthias\SimpleBus\Tests\Functional\SmokeTest;

use Matthias\SimpleBus\Event\Event;

class SomeOtherEvent implements Event
{
    public function name()
    {
        return 'some_other_event';
    }
}
