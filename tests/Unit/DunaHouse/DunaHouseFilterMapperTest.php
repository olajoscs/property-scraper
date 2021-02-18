<?php

declare(strict_types=1);

namespace Tests\Unit\DunaHouse;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseAreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseLocationFilter;
use App\Models\Filters\DunaHouse\DunaHousePriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\FilterMappers\DunaHouseFilterMapper;
use PHPUnit\Framework\TestCase;

class DunaHouseFilterMapperTest extends TestCase
{
    /**
     * @var DunaHouseFilterMapper
     */
    private $mapper;


    public function test_empty(): void
    {
        $mappedFilters = $this->mapper->map();

        $this->assertSame([], $mappedFilters);
    }


    public function test_full(): void
    {
        $priceFilter = new PriceFilter(80000000, 100000000);
        $areaFilter = new AreaFilter(80, 150);
        $locationFilter = new LocationFilter('Miskolc', 'Szirmabesenyő');

        $expected = [
            new DunaHousePriceFilter($priceFilter),
            new DunaHouseAreaFilter($areaFilter),
            new DunaHouseLocationFilter($locationFilter),
        ];

        $mappedFilters = $this->mapper->map($priceFilter, $areaFilter, $locationFilter);

        $this->assertEquals($expected, $mappedFilters);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->mapper = new DunaHouseFilterMapper();
    }
}