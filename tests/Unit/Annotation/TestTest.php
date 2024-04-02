<?php

namespace Tests\Unit\Annotation;

use App\Http\Controllers\ExampleController;
use PHPUnit\Framework\TestCase;

class TestTest extends TestCase
{
    /**
     * Test Sum method with valid input and return incorrect.
     * @test
     * @return void
     */
    public function sumMethodWithValidInputShouldReturnCorrect()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sum(1, 2);
        $expect = 3;

        $this->assertEquals($expect, $actual);
    }

    /**
     * Test Sub method with valid input and return incorrect.
     * @test
     * @return void
     */
    public function subMethodWithValidInputShouldReturnCorrect()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sub(2, 1);
        $expect = 1;

        $this->assertSame($expect, $actual);
    }
}
