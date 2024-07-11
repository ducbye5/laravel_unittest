<?php

namespace Tests\Unit\Mockery;

use App\Http\Services\ExampleService;
use Tests\TestCase;
use Mockery;
use App\Http\Controllers\MockExampleController;

class ProtectedPrivateMethodTest extends TestCase
{
    private $mockExampleService;
    private $mockExampleController;

    public function testIsNotExistEmailProtectedMethod()
    {
        $email = 'example1@gmail.com';

        $reflection = new \ReflectionClass(MockExampleController::class);

        $method = $reflection->getMethod('isNotExistEmail');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs(MockExampleController::class, [$email]);

        $this->assertFalse($actual);
    }

    public function testReplaceEmailDomainPrivateMethod()
    {
        $email = 'example1@gmail.com';

        $reflection = new \ReflectionClass('\App\Http\Controllers\MockExampleController');
        $method = $reflection->getMethod('replaceEmailDomain');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs(MockExampleController::class, [$email]);
        $expect = 'example1@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }
}
