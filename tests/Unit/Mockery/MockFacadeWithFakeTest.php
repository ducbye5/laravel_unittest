<?php

namespace Tests\Unit\Mockery;

use App\Http\Controllers\MockExampleController;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use App\Http\Jobs\DeleteUserJob;
use Mockery;
use Tests\TestCase;

class MockFacadeWithFakeTest extends TestCase
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
    public function testQueue()
    {
        Queue::fake();

        Queue::assertNothingPushed();

        $this->mockExampleController->deleteUserByIds([1,2,3]);
        Queue::assertPushed(DeleteUserJob::class, 1);

        DeleteUserJob::dispatch([1,2,3])->onQueue('test');
        Queue::assertPushedOn('test', DeleteUserJob::class);
    }

    public function testStorage()
    {
        Storage::fake('local');
        Storage::persistentFake('local');

        Storage::disk('local')->assertMissing('test.txt');

        Storage::disk('local')->put('test.txt', 'abc');
        Storage::disk('local')->assertExists('test.txt');
    }
}
