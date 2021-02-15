<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Filters\Filter;
use App\Models\Sites\Site;
use Psr\Log\LoggerInterface;

/**
 * Scraper of one site
 */
class SiteScraper
{
    private $propertyMapper;
    private $client;
    private $logger;


    public function __construct(PropertyMapper $propertyMapper, Client $client, LoggerInterface $logger)
    {
        $this->propertyMapper = $propertyMapper;
        $this->client = $client;
        $this->logger = $logger;
    }


    public function parse(Site $site, Filter ...$filters): void
    {
        $this->logger->info('Getting properties from ' . $site::getSite());
        $siteFilters = $site->getFilterMapper()->map(...$filters);

        $parsedProperties = $this->parseProeprtiesFromSite($site, $siteFilters);

        $this->logger->info(count($parsedProperties) . ' properties found');
        $this->propertyMapper->map(...$parsedProperties);

        $this->logger->info('Scraping the ' . $site::getSite() . ' is done');
    }


    private function parseProeprtiesFromSite(Site $site, array $siteFilters): array
    {
        $pageNumber = 1;
        $parsedProperties = [];
        while (true) {
            $this->logger->info('Getting page #' . $pageNumber . '...');
            $url = $site->getUrlGenerator()->generate($pageNumber, ...$siteFilters);
            $content = $this->client->get($url);
            $result = $site->getListParser()->parse($content);
            $this->logger->info(count($result->parsedProperties) . ' properties found');

            $parsedProperties[] = $result->parsedProperties;

            if (!$result->hasNextPage) {
                break;
            }

            $pageNumber++;
        }

        return array_merge(...$parsedProperties);
    }
}