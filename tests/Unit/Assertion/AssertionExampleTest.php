<?php

namespace Tests\Unit\Assertion;

use Tests\TestCase;
use App\Http\Controllers\ExampleController;

class AssertionExampleTest extends TestCase
{
    public function testAssertTrueExample()
    {
        $this->assertTrue(true);
        self::assertTrue(true);
    }

    public function testAssertFalseExample()
    {
        $this->assertFalse(false);
    }

    public function testAssertArrayHasKeyExample()
    {
        $key = 'key_1';
        $arr = [
            'key_1' => 'value 1',
            'key_2' => 'value 2',
            'key_3' => 'value 3',
        ];

        $this->assertArrayHasKey($key, $arr);
    }

    public function testAssertIsIntExample()
    {
        $this->assertIsInt(5);
    }

    public function testAssertIsFloatExample()
    {
        $this->assertIsfloat(5.2);
    }

    public function testAssertStringStartsWithExample()
    {
        $string = 'Chuỗi dùng để test';
        $prefix = 'Chuỗi';

        $this->assertStringStartsWith($prefix, $string);
    }

    public function testAssertStringEndsWithExample()
    {
        $string = 'Chuỗi dùng để test';
        $prefix = 'test';

        $this->assertStringEndsWith($prefix, $string);
    }

    public function testSumMethodWithValidInputShouldReturnCorrect()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sum(1, 2);
        $expect = 3;
        // sử dụng toán tử equals , so sánh giá trị
        $this->assertEquals($expect, $actual);
    }

    public function testSubMethodWithValidInputShouldReturnCorrect()
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sub(2, 1);
        $expect = 1;
        // sử dụng toán tử == để so sánh địa chỉ bộ nhớ của 2 đối tượng
        $this->assertSame($expect, $actual);
    }

    /**
     * @group sub
     *
     */
    public function testSubMethodWithValidInputShouldReturnException()
    {
//        $this->expectExceptionMessage("A non-numeric value encountered");
        $exampleController = new ExampleController();
        $actual = $exampleController->sub('ab', 'cd');
        $expect = new \Exception('abc');
        // sử dụng toán tử == để so sánh địa chỉ bộ nhớ của 2 đối tượng
        $this->assertInstanceOf(\Exception::class, $actual);
        $this->assertEquals('abc', $actual->getMessage());
    }

    /**
     * @group sub
     */
    public function testSubMethodWithValidInputShouldReturnException1()
    {
//        $this->expectExceptionMessage("A non-numeric value encountered");
        $exampleController = new ExampleController();
        $actual = $exampleController->sub('a', 'b');

        $expect = new \Exception('abc');
        // sử dụng toán tử == để so sánh địa chỉ bộ nhớ của 2 đối tượng
        $this->assertInstanceOf(\Exception::class, $actual);
    }
}
