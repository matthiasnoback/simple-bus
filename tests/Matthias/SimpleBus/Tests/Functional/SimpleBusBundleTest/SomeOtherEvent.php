<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Matthias\SimpleBus\Event\Event;

class SomeOtherEvent implements Event
{
    public function name()
    {
        return 'some_other_event';
    }
}
