<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\SiteProvider;

/**
 * Parser of the sites with the filters
 */
class NewPropertyParser
{
    private $siteProvider;
    private $siteParser;


    public function __construct(SiteProvider $siteProvider, SiteParser $siteParser)
    {
        $this->siteProvider = $siteProvider;
        $this->siteParser = $siteParser;
    }


    /**
     * Parse the sites with the filters
     *
     * @return void
     */
    public function parse(): void
    {
        $filters = $this->createFilters();

        foreach ($this->siteProvider->getAll() as $site) {
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