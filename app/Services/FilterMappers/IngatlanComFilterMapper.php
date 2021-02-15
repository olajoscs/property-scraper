<?php

declare(strict_types=1);

namespace App\Services\FilterMappers;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\Filter;
use App\Models\Filters\IngatlanCom\IngatlanComAreaFilter;
use App\Models\Filters\IngatlanCom\IngatlanComLocationFilter;
use App\Models\Filters\IngatlanCom\IngatlanComPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Models\Filters\SiteFilter;

/**
 * Map the filters into Ingatlan.com specific filters
 */
class IngatlanComFilterMapper extends CommonFilterMapper
{
    private const FILTER_MAP = [
        AreaFilter::class => IngatlanComAreaFilter::class,
        LocationFilter::class => IngatlanComLocationFilter::class,
        PriceFilter::class => IngatlanComPriceFilter::class,
    ];


    protected function getFilterMap(): array
    {
        return self::FILTER_MAP;
    }
}
