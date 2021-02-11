<?php

declare(strict_types=1);

namespace App\Services\UrlGenerators;

use App\Services\FilterMappers\IngatlanComFilterMapper;

/**
 *
 */
class IngatlanComUrlGenerator
{
    private $filterMapper;


    public function __construct(IngatlanComFilterMapper $filterMapper)
    {
        $this->filterMapper = $filterMapper;
    }


    public function generate(array $filters): string
    {
        $mappedFilters = $this->filterMapper->map($filters);
    }
}