<?php

namespace Matthias\SimpleBus\Tests\Functional\SimpleBusBundleTest;

use Matthias\SimpleBus\Command\Command;

class TestCommand implements Command
{
    public function name()
    {
        return 'test_command';
    }
}
