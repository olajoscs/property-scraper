<?php

declare(strict_types=1);

namespace App\Models\Filters\JofogasHu;

use App\Models\Filters\PriceFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines an ingatlan.com specific price filter
 */
class JofogasHuPriceFilter implements SiteFilter
{
    /**
     * @var PriceFilter
     */
    private $priceFilter;


    public function __construct(PriceFilter $priceFilter)
    {
        $this->priceFilter = $priceFilter;
    }


    public function getAsParameterString(): string
    {
        return sprintf(
            'min_price=%s&max_price=%s',
            $this->priceFilter->getMinPrice(),
            $this->priceFilter->getMaxPrice()
        );
    }
}
