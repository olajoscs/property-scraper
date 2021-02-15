<?php

declare(strict_types=1);

namespace Tests\Unit\JofogasHu;

use App\Models\Filters\JofogasHu\JofogasHuPriceFilter;
use App\Models\Filters\PriceFilter;
use PHPUnit\Framework\TestCase;

class JofogasHuPriceFilterTest extends TestCase
{
    public function test_normal(): void
    {
        $priceFilter = new PriceFilter(10000000, 150000000);
        $ingatlanComAreaFilter = new JofogasHuPriceFilter($priceFilter);
        $this->assertSame('min_price=10000000&max_price=150000000', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_reversed(): void
    {
        $priceFilter = new PriceFilter(120000000, 50000000);
        $ingatlanComAreaFilter = new JofogasHuPriceFilter($priceFilter);
        $this->assertSame('min_price=50000000&max_price=120000000', $ingatlanComAreaFilter->getAsParameterString());
    }


    public function test_not_decimal(): void
    {
        $priceFilter = new PriceFilter(10500000, 11000000);
        $ingatlanComAreaFilter = new JofogasHuPriceFilter($priceFilter);
        $this->assertSame('min_price=10500000&max_price=11000000', $ingatlanComAreaFilter->getAsParameterString());
    }
}