<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;

/**
 * Parser of the sites with the filters
 */
class NewPropertyScraper
{
    private $siteProvider;
    private $siteParser;


    public function __construct(SiteProvider $siteProvider, SiteScraper $siteParser)
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
            new AreaFilter(80, 170),
            new PriceFilter(5000000, 35000000),
            new LocationFilter('Miskolc', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos', 'Kistokaj'),
        ];
    }
}