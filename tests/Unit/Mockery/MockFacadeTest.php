<?php

namespace Tests\Unit\Mockery;

use App\Http\Controllers\MockExampleController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Mockery;
use App\User;

class MockFacadeTest extends TestCase
{
    private $mockExampleService;
    private $mockExampleController;

    public function setUp(): void
    {
        $this->mockExampleService = Mockery::mock('\App\Http\Services\ExampleService')->makePartial();
        $this->mockExampleController = new MockExampleController(
            $this->mockExampleService
        );
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function mockCache()
    {
        Cache::shouldReceive('get')
            ->with('key_test')
            ->andReturn('test');

        $actual = $this->mockExampleController->getEmailFromCacheByKey('key_test');
        $expect = 'test';

        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    public function mockDB()
    {
        DB::shouldReceive('table->where->first')
            ->times(1)
            ->andReturn(
                (object)[
                    'id' => 1,
                    'name' => 'John',
                    'address' => 'Japan'
                ]
            );

        $actual = $this->mockExampleController->getUserAddressById(1);
        $expect = 'Japan';

        $this->assertEquals($expect, $actual);
    }

    public function testCreateUserAndReturnUserData()
    {
        $userModel = Mockery::mock('overload:App\User');
        $this->mockExampleController->setModel($userModel);
//        $this->app->instance(User::class, $userModel);

        $userModel->shouldReceive('save')
            ->times(1)
            ->andReturn(
                new User([
                    'id' => 1,
                    'name' => 'Merry',
                    'password' => '123456'
                ])
            );
//        $this->app->instance(User::class, $userModel);

        $actual = $this->mockExampleController->createUser();
        $expect = (object)[
            'id' => 1,
            'name' => 'Merry',
            'password' => '123456'
        ];

        $this->assertEquals($expect, $actual);
    }
}
