<?php

declare(strict_types=1);

namespace Tests\Unit\OtthonCentrum;

use App\Models\Filters\OtthonCentrum\OtthonCentrumPriceFilter;
use App\Models\Filters\PriceFilter;
use PHPUnit\Framework\TestCase;

class OtthonCentrumPriceFilterTest extends TestCase
{
    public function test_normal(): void
    {
        $priceFilter = new PriceFilter(10000000, 150000000);
        $ingatlanComAreaFilter = new OtthonCentrumPriceFilter($priceFilter);
        $this->assertSame('ar:10~150', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_reversed(): void
    {
        $priceFilter = new PriceFilter(120000000, 50000000);
        $ingatlanComAreaFilter = new OtthonCentrumPriceFilter($priceFilter);
        $this->assertSame('ar:50~120', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_not_decimal(): void
    {
        $priceFilter = new PriceFilter(10500000, 11000000);
        $ingatlanComAreaFilter = new OtthonCentrumPriceFilter($priceFilter);
        $this->assertSame('ar:10.5~11', $ingatlanComAreaFilter->getAsParameterString());
    }
}