<?php

namespace Tests\Unit\Assertion;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\ExampleController;

class AssertionExampleTest extends TestCase
{
    public function testAssertExample()
    {
        // assertTrue
        $this->assertTrue(true);
        self::assertTrue(true);
        // assertFalse
        $this->assertFalse(false);
        // assertArrayHasKey
        $key = 'key_1';
        $arr = [
            'key_1' => 'value 1',
            'key_2' => 'value 2',
            'key_3' => 'value 3',
        ];

        $this->assertArrayHasKey($key, $arr);
        // assertIsInt
        $this->assertIsInt(5);
        // assertStringStartsWith
        $string = 'Chuỗi dùng để test';
        $prefix = 'Chuỗi';

        $this->assertStringStartsWith($prefix, $string);
        // assertSame
        $actual = 1;
        $expect = 1;

        $this->assertSame($expect, $actual);
    }

    public function testSumMethodWithValidInputShouldReturnCorrect()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sum(1, 2);
        $expect = 3;

        $this->assertEquals($expect, $actual);
    }

    public function testSubMethodWithValidInputShouldReturnCorrect()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sub(2, 1);
        $expect = 1;

        $this->assertSame($expect, $actual);
    }
}
