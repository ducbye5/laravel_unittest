<?php

namespace Tests\Unit\Annotation;

use App\Http\Controllers\ExampleController;
use PHPUnit\Framework\TestCase;

class LargeMediumSmallTest extends TestCase
{
    /**
     * @large
     */
    public function testLargeTimeoutMethod()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->largeTimeout();
        $this->assertTrue($actual);
    }

    /**
     * @medium
     */
    public function testMediumTimeoutMethod()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->mediumTimeout();
        $this->assertTrue($actual);
    }

    /**
     * @small
     */
    public function testSmallTimeoutMethod()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->smallTimeout();
        $this->assertTrue($actual);
    }
}
