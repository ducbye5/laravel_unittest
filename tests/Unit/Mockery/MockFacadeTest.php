<?php

namespace Tests\Unit\Mockery;

use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;

class MockFacadeTest extends TestCase
{

    public function testCache()
    {
        Cache::shouldReceive('get')
            ->with('key_test')
            ->andReturn('test');

        $exampleController = new ExampleController();
        $actual = $exampleController->getEmailFromCacheByKey('key_test');
        $expect = 'test';

        $this->assertEquals($expect, $actual);
    }
}
