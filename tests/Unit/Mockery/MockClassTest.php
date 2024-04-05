<?php

namespace Tests\Unit\Mockery;

use App\Http\Services\ExampleService;
use Tests\TestCase;
use Mockery;
use App\Http\Controllers\MockExampleController;

class MockClassTest extends TestCase
{
    private $mockExampleService;
    private $mockExampleController;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockExampleService = Mockery::mock('\App\Http\Services\ExampleService')->makePartial();
//        $this->mockExampleService = Mockery::mock(ExampleService::class)->makePartial();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testGetUserMethodWithValidIdAndReturnCorrectData()
    {
        $userId = 1;

        $this->mockExampleService
    	    ->shouldReceive('getEmailByUserId')
    	    ->times(1)
    	    ->andReturn(
                'example@gmail.com'
            );

        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $actual = $this->mockExampleController->getEmailByUserId($userId);
        $expect = 'example@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }

    public function testCheckExistEmailProtectedMethod()
    {
        $email = 'example1@gmail.com';

        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $reflection = new \ReflectionClass('\App\Http\Controllers\MockExampleController');
        $method = $reflection->getMethod('checkExistEmail');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs($this->mockExampleController, [$email]);

        $this->assertFalse($actual);
    }

    public function testReplaceEmailDomainPrivateMethod()
    {
        $email = 'example1@gmail.com';

        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $reflection = new \ReflectionClass('\App\Http\Controllers\MockExampleController');
        $method = $reflection->getMethod('replaceEmailDomain');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs($this->mockExampleController, [$email]);
        $expect = 'example1@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }
}
