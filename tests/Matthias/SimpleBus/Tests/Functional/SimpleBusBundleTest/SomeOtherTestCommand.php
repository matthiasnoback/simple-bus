<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Matthias\SimpleBus\Command\Command;

class SomeOtherTestCommand implements Command
{
    public function name()
    {
        return 'some_other_test_command';
    }
}
