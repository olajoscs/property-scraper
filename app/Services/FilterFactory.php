<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidFIlterTypeException;
use App\Models\Filters\AreaFilter;
use App\Models\Filters\Filter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;

/**
 * Create filters from config array
 */
class FilterFactory
{
    /**
     * Create filters from config array
     *
     * @param array $filterConfigs Filters from config file
     *
     * @return Filter[]
     * @throws InvalidFIlterTypeException
     */
    public function create(array $filterConfigs): array
    {
        $filters = [];
        foreach ($filterConfigs as $type => $filterConfig) {
            $filter = $this->createFilter($type, $filterConfig);

            if ($filter !== null) {
                $filters[] = $filter;
            }
        }

        return $filters;
    }


    private function createFilter(string $type, string $filter): ?Filter
    {
        if (empty($filter)) {
            return null;
        }

        switch ($type) {
            case 'area':
                $parts = explode('-', $filter);
                return new AreaFilter((int)$parts[0], (int)$parts[1]);

            case 'price':
                $parts = explode('-', $filter);
                return new PriceFilter((int)$parts[0], (int)$parts[1]);

            case 'location':
                $parts = explode(',', $filter);
                return new LocationFilter(...$parts);

            default:
                throw new InvalidFilterTypeException('Invalid filter type: ' . $type);
        }
    }
}