<?php

declare(strict_types=1);

namespace Tests\Unit\JofogasHu;

use App\Models\Filters\JofogasHu\JofogasHuLocationFilter;
use App\Models\Filters\LocationFilter;
use PHPUnit\Framework\TestCase;

class JofogasHuLocationFilterTest extends TestCase
{
    public function test_empty(): void
    {
        $locationFilter = new LocationFilter();
        $jofogasHuLocationFilter = new JofogasHuLocationFilter($locationFilter);
        $this->assertSame('', $jofogasHuLocationFilter->getAsParameterString());
    }


    public function test_list(): void
    {
        $locationFilter = new LocationFilter('Miskolc', 'Kistokaj');
        $jofogasHuLocationFilter = new JofogasHuLocationFilter($locationFilter);
        $this->assertSame('borsod-abauj-zemplen/miskolc+kistokaj', $jofogasHuLocationFilter->getAsParameterString());
    }


    public function test_transliterate(): void
    {
        $locationFilter = new LocationFilter('Szirmabesenyő', 'Felsőzsolca', 'ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP', 'árvíztűrő tükörfúrógép');
        $jofogasHuLocationFilter = new JofogasHuLocationFilter($locationFilter);
        $this->assertSame('borsod-abauj-zemplen/szirmabesenyo+felsozsolca+arvizturo-tukorfurogep+arvizturo-tukorfurogep', $jofogasHuLocationFilter->getAsParameterString());
    }
}