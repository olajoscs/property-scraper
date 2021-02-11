<?php

declare(strict_types=1);

namespace Tests\Unit\IngatlanCom;

use App\Models\Filters\IngatlanCom\IngatlanComLocationFilter;
use App\Models\Filters\LocationFilter;
use PHPUnit\Framework\TestCase;

class IngatlanComLocationFilterTest extends TestCase
{
    public function test_empty(): void
    {
        $locationFilter = new LocationFilter();
        $ingatlanComLocationFilter = new IngatlanComLocationFilter($locationFilter);
        $this->assertSame('', $ingatlanComLocationFilter->getAsParameterString());
    }


    public function test_list(): void
    {
        $locationFilter = new LocationFilter('Miskolc', 'Kistokaj');
        $ingatlanComLocationFilter = new IngatlanComLocationFilter($locationFilter);
        $this->assertSame('miskolc+kistokaj', $ingatlanComLocationFilter->getAsParameterString());
    }


    public function test_transliterate(): void
    {
        $locationFilter = new LocationFilter('Szirmabesenyő', 'Felsőzsolca', 'ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP', 'árvíztűrő tükörfúrógép');
        $ingatlanComLocationFilter = new IngatlanComLocationFilter($locationFilter);
        $this->assertSame('szirmabesenyo+felsozsolca+arvizturo-tukorfurogep+arvizturo-tukorfurogep', $ingatlanComLocationFilter->getAsParameterString());
    }
}