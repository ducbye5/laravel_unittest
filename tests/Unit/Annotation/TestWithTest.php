<?php

namespace Tests\Unit\Annotation;

use App\Http\Controllers\ExampleController;
use Tests\TestCase;

class TestWithTest extends TestCase
{
    /**
     * @testWith
     *      [1, 1, 2]
     *      [1, 2, 3]
     *      [1, 3, 4]
     *      [1, 4, 5]
     */
    public function testSumMethodWithValidInputShouldReturnCorrect($a, $b, $expected)
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sum($a, $b);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @testWith [{"key_1": "value_1", "key_2": "value_2"}, "key_2", true]
     */
    public function testExistArrayKeyMethodWithValidInputShouldReturnCorrect($arr, $key, $expected)
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->existArrayKey($arr, $key);

        $this->assertEquals($expected, $actual);
    }
}
