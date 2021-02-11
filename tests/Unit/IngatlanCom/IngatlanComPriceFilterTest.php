<?php

declare(strict_types=1);

namespace Tests\Unit\IngatlanCom;

use App\Models\Filters\IngatlanCom\IngatlanComPriceFilter;
use App\Models\Filters\PriceFilter;
use PHPUnit\Framework\TestCase;

class IngatlanComPriceFilterTest extends TestCase
{
    public function test_normal(): void
    {
        $priceFilter = new PriceFilter(10000000, 150000000);
        $ingatlanComAreaFilter = new IngatlanComPriceFilter($priceFilter);
        $this->assertSame('10-150-mFt', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_reversed(): void
    {
        $priceFilter = new PriceFilter(120000000, 50000000);
        $ingatlanComAreaFilter = new IngatlanComPriceFilter($priceFilter);
        $this->assertSame('50-120-mFt', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_not_decimal(): void
    {
        $priceFilter = new PriceFilter(10500000, 11000000);
        $ingatlanComAreaFilter = new IngatlanComPriceFilter($priceFilter);
        $this->assertSame('10.5-11-mFt', $ingatlanComAreaFilter->getAsParameterString());
    }
}