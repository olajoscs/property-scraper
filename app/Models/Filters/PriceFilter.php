<?php

declare(strict_types=1);

namespace App\Models\Filters;

class PriceFilter implements Filter
{
    /**
     * @var int
     */
    private $minPrice;

    /**
     * @var int
     */
    private $maxPrice;


    public function __construct(int $minPrice, int $maxPrice)
    {
        if ($minPrice > $maxPrice) {
            $this->minPrice = $maxPrice;
            $this->maxPrice = $minPrice;
        } else {
            $this->minPrice = $minPrice;
            $this->maxPrice = $maxPrice;
        }
    }


    public function getMinPrice(): int
    {
        return $this->minPrice;
    }


    public function getMaxPrice(): int
    {
        return $this->maxPrice;
    }
}
