<?php

declare(strict_types=1);

namespace Tests\Unit\JofogasHu;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuAreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuLocationFilter;
use App\Models\Filters\JofogasHu\JofogasHuPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\FilterMappers\JofogasHuFilterMapper;
use PHPUnit\Framework\TestCase;

class JofogasHuFilterMapperTest extends TestCase
{
    /**
     * @var JofogasHuFilterMapper()
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
            new JofogasHuPriceFilter($priceFilter),
            new JofogasHuAreaFilter($areaFilter),
            new JofogasHuLocationFilter($locationFilter),
        ];

        $mappedFilters = $this->mapper->map($priceFilter, $areaFilter, $locationFilter);

        $this->assertEquals($expected, $mappedFilters);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->mapper = new JofogasHuFilterMapper();
    }
}