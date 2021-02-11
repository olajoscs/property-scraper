<?php

declare(strict_types=1);

namespace Tests\Unit\IngatlanCom;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\IngatlanCom\IngatlanComAreaFilter;
use App\Models\Filters\IngatlanCom\IngatlanComLocationFilter;
use App\Models\Filters\IngatlanCom\IngatlanComPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\FilterMappers\IngatlanComFilterMapper;
use PHPUnit\Framework\TestCase;

class IngatlanComFilterMapperTest extends TestCase
{
    /**
     * @var IngatlanComFilterMapper
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
            new IngatlanComPriceFilter($priceFilter),
            new IngatlanComAreaFilter($areaFilter),
            new IngatlanComLocationFilter($locationFilter),
        ];

        $mappedFilters = $this->mapper->map($priceFilter, $areaFilter, $locationFilter);

        $this->assertEquals($expected, $mappedFilters);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->mapper = new IngatlanComFilterMapper();
    }
}