<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * Assert that the attributes of the models are equals
     *
     * @param Model[] $expected
     * @param Model[] $actual
     *
     * @return void
     */
    protected function assertModels(array $expected, array $actual): void
    {
        $this->assertEquals(
            array_map(
                function (Model $property) {
                    return $property->getAttributes();
                },
                $expected
            ),
            array_map(
                function (Model $property) {
                    return $property->getAttributes();
                },
                $actual
            )
        );
    }


    /**
     * Assert that the attributes of the models are same
     *
     * @param Model[] $expected
     * @param Model[] $actual
     *
     * @return void
     */
    protected function assertSameModels(array $expected, array $actual): void
    {
        $this->assertSame(
            array_map(
                function (Model $property) {
                    return $property->getAttributes();
                },
                $expected
            ),
            array_map(
                function (Model $property) {
                    return $property->getAttributes();
                },
                $actual
            )
        );
    }
}
