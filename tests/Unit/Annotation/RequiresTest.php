<?php

namespace Tests\Unit\Annotation;

use Tests\TestCase;

class RequiresTest extends TestCase
{
    /**
     * @requires PHP >= 8.0
     * @requires PHPUnit < 8
     * @requires extension redis >= 2.2.0
     * @requires class ExampleClass
     * @requires method ExampleClass::exampleMethod
     * @requires constant MY_CONSTANT
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
