<?php

declare(strict_types=1);

namespace App\Services\FilterMappers;

use App\Models\Filters\Filter;
use App\Models\Filters\SiteFilter;

/**
 * Map filters into site specific filters
 */
interface FilterMapper
{
    /**
     * Map the filters into specific filters, which can be used on the site
     *
     * @param Filter[] $filters
     *
     * @return SiteFilter[]
     */
    public function map(Filter ...$filters): array;
}