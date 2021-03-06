<?php

declare(strict_types=1);

namespace App\Models\Filters\JofogasHu;

use App\Models\Filters\LocationFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines an ingatlan.com specific location filter
 */
class JofogasHuLocationFilter implements SiteFilter
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
        $imploded = implode(
            '+',
            array_map(
                function (string $location) {
                    return $this->formatLocation($location);
                },
                $this->locationFilter->getLocations()
            )
        );

        if (empty($imploded)) {
            return '';
        }

        return 'borsod-abauj-zemplen/' . $imploded;
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