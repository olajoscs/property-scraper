<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\InvalidFIlterTypeException;
use App\Models\Filters\AreaFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\FilterFactory;
use PHPUnit\Framework\TestCase;

class FilterFactoryTest extends TestCase
{
    /**
     * @var FilterFactory
     */
    private $factory;


    public function test_empty(): void
    {
        $filters = [];
        $exptected = [];

        $this->assertSame($exptected, $this->factory->create($filters));
    }


    public function test_existing_but_empty(): void
    {
        $filters = [
            'area' => '',
            'price' => '',
            'location' => '',
        ];
        $exptected = [];

        $this->assertSame($exptected, $this->factory->create($filters));
    }


    public function test_full(): void
    {
        $filters = [
            'area' => '80-150',
            'price' => '1000000-3000000',
            'location' => 'Location1,Location2',
        ];
        $exptected = [
            new AreaFilter(80, 150),
            new PriceFilter(1000000, 3000000),
            new LocationFilter('Location1', 'Location2'),
        ];

        $this->assertEquals($exptected, $this->factory->create($filters));
    }


    public function test_invalid_filter_type(): void
    {
        $filters = [
            'invalid_filter_name' => '80-20',
        ];

        $this->expectException(InvalidFIlterTypeException::class);

        $this->factory->create($filters);
    }



    protected function setUp(): void
    {
        parent::setUp();
        $this->factory = new FilterFactory();
    }
}
