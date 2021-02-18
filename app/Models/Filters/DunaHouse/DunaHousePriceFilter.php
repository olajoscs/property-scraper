<?php

declare(strict_types=1);

namespace App\Models\Filters\DunaHouse;

use App\Models\Filters\PriceFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines a DunaHouse specific price filter
 */
class DunaHousePriceFilter implements SiteFilter
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
            '%s-%s-mFt',
            $this->formatPrice($this->priceFilter->getMinPrice()),
            $this->formatPrice($this->priceFilter->getMaxPrice())
        );
    }


    /**
     * Format the price: if it can be divided by 1M then return it, otherwise round to 1 decimal
     *
     * @param int $price
     *
     * @return string
     */
    private function formatPrice(int $price): string
    {
        if ($price % 1000000 === 0) {
            return (string)(int)($price / 1000000);
        }

        return number_format($price / 1000000, 1, '.', '');
    }
}