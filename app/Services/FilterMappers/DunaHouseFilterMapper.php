<?php

declare(strict_types=1);

namespace App\Services\FilterMappers;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseAreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseLocationFilter;
use App\Models\Filters\DunaHouse\DunaHousePriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;

/**
 *
 */
class DunaHouseFilterMapper extends CommonFilterMapper
{
    private const FILTER_MAP = [
        AreaFilter::class => DunaHouseAreaFilter::class,
        LocationFilter::class => DunaHouseLocationFilter::class,
        PriceFilter::class => DunaHousePriceFilter::class,
    ];


    protected function getFilterMap(): array
    {
        return self::FILTER_MAP;
    }
}