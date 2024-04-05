<?php

namespace Tests\Unit\Annotation;

use App\Http\Controllers\ExampleController;
use Tests\TestCase;

class DataProviderTest extends TestCase
{

    /**
     * @dataProvider sumMethodDataProvider
     */
    public function testSumMethodWithValidInputShouldReturnCorrect($a, $b, $expected)
    {
        $exampleController = new ExampleController();
        $actual = $exampleController->sum($a, $b);

        $this->assertEquals($expected, $actual);
    }

    public function sumMethodDataProvider(): array
    {
        return [
            [1, 1, 2],
            [1, 2, 3],
            [1, 3, 4],
            [1, 4, 5],
        ];
    }
}
