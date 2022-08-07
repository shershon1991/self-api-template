<?php

namespace Self\Test\Cases;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTestCase.
 */
abstract class AbstractTestCase extends TestCase
{
    public function test()
    {
        echo '111';
    }
}
