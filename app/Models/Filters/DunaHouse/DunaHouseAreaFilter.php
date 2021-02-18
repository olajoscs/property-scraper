<?php

declare(strict_types=1);

namespace App\Models\Filters\DunaHouse;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines a DunaHouse specific area filter
 */
class DunaHouseAreaFilter implements SiteFilter
{
    /**
     * @var AreaFilter
     */
    private $areaFilter;


    public function __construct(AreaFilter $areaFilter)
    {
        $this->areaFilter = $areaFilter;
    }


    public function getAsParameterString(): string
    {
        return sprintf(
            '%s-%s-m2',
            $this->areaFilter->getMinArea(),
            $this->areaFilter->getMaxArea()
        );
    }
}