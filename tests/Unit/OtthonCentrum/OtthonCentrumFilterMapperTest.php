<?php

declare(strict_types=1);

namespace Tests\Unit\OtthonCentrum;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumAreaFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumLocationFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\FilterMappers\OtthonCentrumFilterMapper;
use PHPUnit\Framework\TestCase;

class OtthonCentrumFilterMapperTest extends TestCase
{
    /**
     * @var OtthonCentrumFilterMapper()
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
            new OtthonCentrumPriceFilter($priceFilter),
            new OtthonCentrumAreaFilter($areaFilter),
            new OtthonCentrumLocationFilter($locationFilter),
        ];

        $mappedFilters = $this->mapper->map($priceFilter, $areaFilter, $locationFilter);

        $this->assertEquals($expected, $mappedFilters);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->mapper = new OtthonCentrumFilterMapper();
    }
}