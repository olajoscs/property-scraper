<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Filters\Filter;

/**
 * Provides all the filters from the config
 */
class FilterProvider
{
    private $filterFactory;


    public function __construct(FilterFactory $filterFactory)
    {
        $this->filterFactory = $filterFactory;
    }


    /**
     * Provide all the filters from the config
     *
     * @return Filter[]
     */
    public function getAll(): array
    {
        return $this->filterFactory->create(\Config::get('propertyscraper.filters'));
    }
}