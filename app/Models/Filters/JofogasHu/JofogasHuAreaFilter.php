<?php

declare(strict_types=1);

namespace App\Models\Filters\JofogasHu;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines an ingatlan.com specific area filter
 */
class JofogasHuAreaFilter implements SiteFilter
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
            'min_size=%s&max_size=%s',
            $this->areaFilter->getMinArea(),
            $this->areaFilter->getMaxArea()
        );
    }
}