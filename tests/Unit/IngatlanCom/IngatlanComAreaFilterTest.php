<?php

declare(strict_types=1);

namespace Tests\Unit\IngatlanCom;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\IngatlanCom\IngatlanComAreaFilter;
use PHPUnit\Framework\TestCase;

class IngatlanComAreaFilterTest extends TestCase
{
    public function test_normal(): void
    {
        $areaFilter = new AreaFilter(10, 150);

        $ingatlanComAreaFilter = new IngatlanComAreaFilter($areaFilter);

        $this->assertSame('10-150-m2', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_reversed(): void
    {
        $areaFilter = new AreaFilter(120, 50);

        $ingatlanComAreaFilter = new IngatlanComAreaFilter($areaFilter);

        $this->assertSame('50-120-m2', $ingatlanComAreaFilter->getAsParameterString());
    }
}