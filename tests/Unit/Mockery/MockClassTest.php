<?php

namespace Tests\Unit\Mockery;

use App\Http\Services\ExampleService;
use PHPUnit\Framework\TestCase;
use Mockery;
use App\Http\Controllers\ExampleController;

class MockClassTest extends TestCase
{
    private $mockExampleService;
    private $exampleController;

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

        $this->exampleController = new ExampleController(
            $this->mockExampleService
        );

        $actual = $this->exampleController->getEmailByUserId($userId);
        $expect = 'example@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }

    public function testCheckExistEmailProtectedMethod()
    {
        $email = 'example1@gmail.com';

        $this->exampleController = new ExampleController(
            $this->mockExampleService
        );

        $reflection = new \ReflectionClass('\App\Http\Controllers\ExampleController');
        $method = $reflection->getMethod('checkExistEmail');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs($this->exampleController, [$email]);

        $this->assertFalse($actual);
    }

    public function testReplaceEmailDomainPrivateMethod()
    {
        $email = 'example1@gmail.com';

        $this->exampleController = new ExampleController(
            $this->mockExampleService
        );

        $reflection = new \ReflectionClass('\App\Http\Controllers\ExampleController');
        $method = $reflection->getMethod('replaceEmailDomain');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs($this->exampleController, [$email]);
        $expect = 'example1@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }
}
