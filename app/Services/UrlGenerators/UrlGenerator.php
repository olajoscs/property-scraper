<?php

declare(strict_types=1);

namespace App\Services\UrlGenerators;

use App\Models\Filters\SiteFilter;

/**
 * Generate site specific url based on the filters
 */
interface UrlGenerator
{
    /**
     * Generate site specific url based on the filters
     *
     * @param SiteFilter[] $siteFilters
     *
     * @return string
     */
    public function generate(SiteFilter ...$siteFilters): string;
}