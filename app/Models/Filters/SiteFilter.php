<?php

declare(strict_types=1);

namespace App\Models\Filters;

/**
 * Definition of an applied site filter
 */
interface SiteFilter
{
    /**
     * Return the filter value(s) as a string into the url
     *
     * @return string
     */
    public function getAsParameterString(): string;
}