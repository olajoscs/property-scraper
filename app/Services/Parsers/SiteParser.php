<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\Filters\Filter;
use App\Models\Sites\Site;
use App\Services\Client;
use App\Services\PropertyMapper;

/**
 * Parser of one site
 */
class SiteParser
{
    private $propertyMapper;
    private $client;


    public function __construct(PropertyMapper $propertyMapper, Client $client)
    {
        $this->propertyMapper = $propertyMapper;
        $this->client = $client;
    }


    public function parse(Site $site, Filter ...$filters): void
    {
        $siteFilters = $site->getFilterMapper()->map(...$filters);

        $parsedProperties = $this->parseProeprtiesFromSite($site, $siteFilters);

        $this->propertyMapper->map(...$parsedProperties);
    }


    private function parseProeprtiesFromSite(Site $site, array $siteFilters): array
    {
        $pageNumber = 1;
        $parsedProperties = [];
        while (true) {
            $url = $site->getUrlGenerator()->generate($pageNumber, ...$siteFilters);
            $content = $this->client->get($url);
            $result = $site->getListParser()->parse($content);

            $parsedProperties[] = $result->parsedProperties;

            if (!$result->hasNextPage) {
                break;
            }

            $pageNumber++;
        }

        return array_merge(...$parsedProperties);
    }
}