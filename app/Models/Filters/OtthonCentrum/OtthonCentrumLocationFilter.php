<?php

declare(strict_types=1);

namespace App\Models\Filters\OtthonCentrum;

use App\Models\Filters\LocationFilter;
use App\Models\Filters\SiteFilter;

/**
 * Defines an OtthonCentrum specific location filter
 */
class OtthonCentrumLocationFilter implements SiteFilter
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
        $locations = implode(
            ',',
            array_map(
                function (string $location) {
                    return $this->formatLocation($location);
                },
                $this->locationFilter->getLocations()
            )
        );

        if (!$locations) {
            return '';
        }

        return sprintf(
            'hely-ertek:%s/hely-id:%s',
            $locations,
            $locations
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