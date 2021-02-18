<?php

declare(strict_types=1);

namespace App\Models\Filters\OtthonCentrum;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines an OtthonCentrum specific area filter
 */
class OtthonCentrumAreaFilter implements SiteFilter
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
            'netto-alapterulet:%s~%s',
            $this->areaFilter->getMinArea(),
            $this->areaFilter->getMaxArea()
        );
    }
}