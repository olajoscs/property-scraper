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
    private $filterProvider;


    public function __construct(SiteProvider $siteProvider, SiteScraper $siteParser, FilterProvider $filterProvider)
    {
        $this->siteProvider = $siteProvider;
        $this->siteParser = $siteParser;
        $this->filterProvider = $filterProvider;
    }


    /**
     * Parse the sites with the filters
     *
     * @return void
     */
    public function parse(): void
    {
        $filters = $this->filterProvider->getAll();

        foreach ($this->siteProvider->getAll() as $site) {
            $this->siteParser->parse($site, ...$filters);
        }
    }
}