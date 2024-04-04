<?php

namespace Tests\Unit\Mockery;

use App\Http\Controllers\MockExampleController;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;

class MockFacadeTest extends TestCase
{

    /**
     * @test
     */
    public function mockCache()
    {
        Cache::shouldReceive('get')
            ->with('key_test')
            ->andReturn('test');

        $mockExampleController = new MockExampleController();
        $actual = $mockExampleController->getEmailFromCacheByKey('key_test');
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

        $mockExampleController = new MockExampleController();
        $actual = $mockExampleController->getUserAddressById(1);
        $expect = 'Japan';

        $this->assertEquals($expect, $actual);
    }

    public function testCreateUserAndReturnUserData()
    {
        $userModel = Mockery::mock('overload:App\User');

        $userModel->shouldReceive('save')
            ->times(1)
            ->andReturn(
                (object)[
                    'id' => 1,
                    'name' => 'Merry',
                    'password' => '123456'
                ]
            );

        $mockExampleController = new MockExampleController();
        $actual = $mockExampleController->createUser();
        $expect = (object)[
            'id' => 1,
            'name' => 'Merry',
            'password' => '123456'
        ];

        $this->assertEquals($expect, $actual);
    }
}
