<?php

declare(strict_types=1);

namespace Tests\Unit\DunaHouse;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseAreaFilter;
use PHPUnit\Framework\TestCase;

class DunaHouseAreaFilterTest extends TestCase
{
    public function test_normal(): void
    {
        $areaFilter = new AreaFilter(10, 150);
        $ingatlanComAreaFilter = new DunaHouseAreaFilter($areaFilter);
        $this->assertSame('10-150-m2', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_reversed(): void
    {
        $areaFilter = new AreaFilter(120, 50);
        $ingatlanComAreaFilter = new DunaHouseAreaFilter($areaFilter);
        $this->assertSame('50-120-m2', $ingatlanComAreaFilter->getAsParameterString());
    }
}