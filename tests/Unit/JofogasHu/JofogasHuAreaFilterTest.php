<?php

declare(strict_types=1);

namespace Tests\Unit\JofogasHu;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuAreaFilter;
use PHPUnit\Framework\TestCase;

class JofogasHuAreaFilterTest extends TestCase
{
    public function test_normal(): void
    {
        $areaFilter = new AreaFilter(10, 150);
        $ingatlanComAreaFilter = new JofogasHuAreaFilter($areaFilter);
        $this->assertSame('min_size=10&max_size=150', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_reversed(): void
    {
        $areaFilter = new AreaFilter(120, 50);
        $ingatlanComAreaFilter = new JofogasHuAreaFilter($areaFilter);
        $this->assertSame('min_size=50&max_size=120', $ingatlanComAreaFilter->getAsParameterString());
    }
}