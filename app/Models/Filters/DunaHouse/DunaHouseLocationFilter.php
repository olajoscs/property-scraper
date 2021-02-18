<?php

declare(strict_types=1);

namespace App\Models\Filters\DunaHouse;

use App\Models\Filters\LocationFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines a DunaHouse specific location filter
 */
class DunaHouseLocationFilter implements SiteFilter
{
    /**
     * @var LocationFilter
     */
    private $locationFilter;


    public function __construct(LocationFilter $locationFilter)
    {
        $this->locationFilter = $locationFilter;
    }


    public function getAsParameterString(): string
    {
        return implode(
            '+',
            array_map(
                function (string $location) {
                    return $this->formatLocation($location);
                },
                $this->locationFilter->getLocations()
            )
        );
    }


    /**
     * Removes non-ascii characters and replaces spaces with -
     *
     * @param string $location
     *
     * @return string
     */
    public function formatLocation(string $location): string
    {
        $transliterator = \Transliterator::create('Any-Latin;Latin-ASCII;');

        return preg_replace('/\s/', '-', strtolower($transliterator->transliterate($location)));
    }
}