<?php

declare(strict_types=1);

namespace App\Services\FilterMappers;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuAreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuLocationFilter;
use App\Models\Filters\JofogasHu\JofogasHuPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;

/**
 * Map the filters into Ingatlan.jofogas.hu specific filters
 */
class JofogasHuFilterMapper extends CommonFilterMapper
{
    private const FILTER_MAP = [
        AreaFilter::class => JofogasHuAreaFilter::class,
        LocationFilter::class => JofogasHuLocationFilter::class,
        PriceFilter::class => JofogasHuPriceFilter::class,
    ];

    protected function getFilterMap(): array
    {
        return self::FILTER_MAP;
    }
}
