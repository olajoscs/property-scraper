<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;

/**
 * Parser of the sites with the filters
 */
class NewPropertyParser
{
    private $siteParser;


    public function __construct(SiteParser $siteParser)
    {
        $this->siteParser = $siteParser;
    }


    /**
     * Parse the sites with the filters
     *
     * @param array $siteClasses
     *
     * @return void
     */
    public function parse(array $siteClasses): void
    {
        $filters = $this->createFilters();

        foreach ($siteClasses as $siteClass) {
            $site = new $siteClass();

            $this->siteParser->parse($site, ...$filters);
        }
    }


    private function createFilters(): array
    {
        return [
            new AreaFilter(80, 150),
            new PriceFilter(5000000, 35000000),
            new LocationFilter('Miskolc', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos', 'Kistokaj'),
        ];
    }
}