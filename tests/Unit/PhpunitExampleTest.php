<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PhpunitExampleTest extends TestCase
{
    /**
     * Test constant được define ở phpunit.xml
     */
    public function test_FOO_constant()
    {
        $expect = 'bar';
        $this->assertEquals($expect, FOO);
    }

    public function testSum() {
        // Arrange: chuẩn bị dữ liệu đầu vào, các đối tượng cần thiết
        $expected = 5;
        $a = 2;
        $b = 3;

        // Action: Gọi function cần test với dữ liệu đã chuẩn bị
        $actual = $a + $b;

        // Assert: Xác nhận kết quả trả về
        $this->assertEquals($expected, $actual);
    }
}
