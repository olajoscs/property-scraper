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
 * Map the filters into specific Ingatlan.com filters, which can be used on that site
 */
class IngatlanComFilterMapper
{
    private const FILTER_MAP = [
        AreaFilter::class => IngatlanComAreaFilter::class,
        LocationFilter::class => IngatlanComLocationFilter::class,
        PriceFilter::class => IngatlanComPriceFilter::class,
    ];


    /**
     * Map the filters into specific filters, which can be used on the site
     *
     * @param Filter[] $filters
     *
     * @return SiteFilter[]
     */
    public function map(Filter ...$filters): array
    {
        $mappedFilters = [];
        foreach ($filters as $filter) {
            $mappedFilter = self::FILTER_MAP[get_class($filter)];

            $mappedFilters[] = new $mappedFilter($filter);
        }

        return $mappedFilters;
    }
}
