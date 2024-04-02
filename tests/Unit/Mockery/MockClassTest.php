<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Http\Controllers\ExampleController;
use use App\Http\Services\ExampleService;

class MockClassTest extends TestCase
{
    private $mockExampleService;
    private $exampleController;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockExampleService = Mockery::mock('ExampleService');
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
                (object)['email' => 'example@gmail.com']
            );

        $this->exampleController = new ExampleController(
            $this->mockExampleService
        );

        $actual = $this->exampleController->getEmailByUserId($userId);
        $expect = 'example@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }

    public function testReplaceEmailDomainPrivateMethod()
    {
        $email = 'example1@gmail.com';

        $this->exampleController = new ExampleController(
            $this->mockExampleService
        );

        $reflection = new \ReflectionClass('ExampleController');
        $method = $reflection->getMethod('replaceEmailDomain');
        $method->setAccessible(TRUE);

        $actual = $method->invokeArgs($this->exampleController, $email);
        $expect = 'example1@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }
}
