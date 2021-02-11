<?php

declare(strict_types=1);

namespace App\Models\Filters\IngatlanCom;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines an ingatlan.com specific area filter
 */
class IngatlanComAreaFilter implements SiteFilter
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