<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\ParsedProperty;
use PHPUnit\Framework\TestCase;

/**
 *
 */
trait SamePropertyModelAssert
{
    /**
     * Assert that the attributes of the models are same
     *
     * @param ParsedProperty[] $expected
     * @param ParsedProperty[] $actual
     *
     * @return void
     */
    protected function assertSameModels(array $expected, array $actual): void
    {
        TestCase::assertSame(
            array_map(
                function (ParsedProperty $property) {
                    return (array)$property;
                },
                $expected
            ),
            array_map(
                function (ParsedProperty $property) {
                    return (array)$property;
                },
                $actual
            )
        );
    }
}