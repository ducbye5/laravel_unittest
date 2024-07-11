<?php

namespace Tests\Unit\Mockery;

use App\Http\Services\ExampleService;
use Tests\TestCase;
use Mockery;
use App\Http\Controllers\MockExampleController;
use App\User;

class MockClassTest extends TestCase
{
    private $mockExampleService;
    private $mockExampleController;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockExampleService = Mockery::mock('\App\Http\Services\ExampleService');
        // $this->mockExampleService = Mockery::mock(ExampleService::class)->makePartial();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testInitializationMock()
    {
        $this->mockExampleService = $this->instance(ExampleService::class, Mockery::mock(ExampleService::class, function ($mock) {
            $mock->shouldReceive('getEmailByUserId')
                ->once()
                ->andReturn(
                    'example@gmail.com'
                );
        }));

        // $this->mockExampleService = $this->mock(ExampleService::class, function ($mock) {
        //     $mock->shouldReceive('getEmailByUserId')
        //         ->once()
        //         ->andReturn(
        //             'example@gmail.com'
        //         );
        // });

        // $this->mockExampleService = $this->partialMock(ExampleService::class, function ($mock) {
        //     $mock->shouldReceive('getEmailByUserId')
        //         ->once()
        //         ->andReturn(
        //             'example@gmail.com'
        //         );
        // });

        // $this->mockExampleService
        //     ->shouldReceive('getEmailByUserId')
        //     ->times(1)
        //     ->andReturn(
        //         'example@gmail.com'
        //     );

        $userId = 1;
        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $actual = $this->mockExampleController->getEmailByUserId($userId);
        $expect = 'example@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }

    // trường hợp mock function trong cùng class
    public function testMockFunction()
    {
        $this->mockExampleController = Mockery::mock(MockExampleController::class)->makePartial();
        $this->mockExampleController
            ->shouldReceive('roundNumber')
            ->times(1)
            ->andReturn(5.99);
        
        $actual = $this->mockExampleController->formatNumber(2.99);
        $expect = 5;

        $this->assertEquals($expect, $actual);
    }

    public function testMakePartial()
    {
        $userId = 1;

        $this->mockExampleService
            ->shouldReceive('getEmailByUserId')
            ->times(1)
            ->andReturn(
                'example@gmail.com'
            );
        //    ->andReturnNull();

        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $actual = $this->mockExampleController->getEmailByUserId($userId);
        $expect = 'example@vti.com.vn';

        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    // instance mock class
    public function instanceMockClass()
    {
        $userModel = Mockery::mock('overload:\App\User');
        $userModel->shouldReceive('save')
            ->times(1)
            ->andReturn((object) ['email' => 'a@gmail']);

        $this->app->instance(User::class, $userModel);
        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $actual = $this->mockExampleController->createUser();
        $expect = (object) ['email' => 'a@gmail'];

        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    // alias mock class
    public function aliasMockClass()
    {
        // $userModel = Mockery::mock('overload:\App\User');
        $userModel = Mockery::mock('alias:\App\User');
        $userModel->shouldReceive('find')
            ->times(1)
            ->andReturn((object) ['email' => 'a@gmail']);

        $this->app->instance(User::class, $userModel);
        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );

        $actual = $this->mockExampleController->findUser();
        $expect = (object) ['email' => 'a@gmail'];

        $this->assertEquals($expect, $actual);
    }
}
