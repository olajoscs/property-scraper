<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\Filters\Filter;
use App\Models\Sites\Site;
use App\Services\PropertyMapper;

/**
 * Parser of one site
 */
class SiteParser
{
    private $propertyMapper;


    public function __construct(PropertyMapper $propertyMapper)
    {
        $this->propertyMapper = $propertyMapper;
    }


    public function parse(Site $site, Filter ...$filters): void
    {
        $siteFilters = $site->getFilterMapper()->map(...$filters);
        $url = $site->getUrlGenerator()->generate(...$siteFilters);

        $content = file_get_contents($url);

        $parsedProperties = $site->getListParser()->parse($content);
        $this->propertyMapper->map(...$parsedProperties);
    }
}