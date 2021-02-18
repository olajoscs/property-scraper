<?php

declare(strict_types=1);

namespace Tests\Unit\OtthonCentrum;

use App\Models\Filters\OtthonCentrum\OtthonCentrumLocationFilter;
use App\Models\Filters\LocationFilter;
use PHPUnit\Framework\TestCase;

class OtthonCentrumLocationFilterTest extends TestCase
{
    public function test_empty(): void
    {
        $locationFilter = new LocationFilter();
        $ingatlanComLocationFilter = new OtthonCentrumLocationFilter($locationFilter);
        $this->assertSame('', $ingatlanComLocationFilter->getAsParameterString());
    }


    public function test_list(): void
    {
        $locationFilter = new LocationFilter('Miskolc', 'Kistokaj');
        $ingatlanComLocationFilter = new OtthonCentrumLocationFilter($locationFilter);
        $this->assertSame('hely-ertek:miskolc,kistokaj/hely-id:miskolc,kistokaj', $ingatlanComLocationFilter->getAsParameterString());
    }


    public function test_transliterate(): void
    {
        $locationFilter = new LocationFilter('Szirmabesenyő', 'Felsőzsolca', 'ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP', 'árvíztűrő tükörfúrógép');
        $ingatlanComLocationFilter = new OtthonCentrumLocationFilter($locationFilter);
        $this->assertSame('hely-ertek:szirmabesenyo,felsozsolca,arvizturo-tukorfurogep,arvizturo-tukorfurogep/hely-id:szirmabesenyo,felsozsolca,arvizturo-tukorfurogep,arvizturo-tukorfurogep', $ingatlanComLocationFilter->getAsParameterString());
    }
}