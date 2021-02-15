<?php

declare(strict_types=1);

namespace App\Services\FilterMappers;

use App\Models\Filters\Filter;

/**
 * Common filter mapper, which uses site specific array source
 */
abstract class CommonFilterMapper implements FilterMapper
{
    public function map(Filter ...$filters): array
    {
        $mappedFilters = [];
        foreach ($filters as $filter) {
            $mappedFilter = $this->getFilterMap()[get_class($filter)];

            $mappedFilters[] = new $mappedFilter($filter);
        }

        return $mappedFilters;
    }


    abstract protected function getFilterMap(): array;
}