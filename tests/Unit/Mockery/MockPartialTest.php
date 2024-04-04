<?php

namespace Tests\Unit\Mockery;

use App\Http\Services\ExampleService;
use PHPUnit\Framework\TestCase;
use Mockery;
use App\Http\Controllers\MockExampleController;

class MockPartialTest extends TestCase
{
    private $mockExampleService;
    private $mockExampleController;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockExampleService = Mockery::mock(ExampleService::class);
        // $this->mockExampleService = Mockery::mock(ExampleService::class)->makePartial();
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
}
