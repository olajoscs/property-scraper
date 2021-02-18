<?php

declare(strict_types=1);

namespace App\Services\FilterMappers;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumAreaFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumLocationFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumPriceFilter;
use App\Models\Filters\PriceFilter;

/**
 * Map the filters into OtthonCentrum specific filters
 */
class OtthonCentrumFilterMapper extends CommonFilterMapper
{
    private const FILTER_MAP = [
        AreaFilter::class => OtthonCentrumAreaFilter::class,
        LocationFilter::class => OtthonCentrumLocationFilter::class,
        PriceFilter::class => OtthonCentrumPriceFilter::class,
    ];

    protected function getFilterMap(): array
    {
        return self::FILTER_MAP;
    }
}