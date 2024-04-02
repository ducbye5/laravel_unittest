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
}
