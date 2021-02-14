<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Sites\Site;

/**
 * Provides the list of the sites
 */
class SiteProvider
{
    private $sites;


    /**
     * Return the list of the sites
     *
     * @return Site[]
     */
    public function getAll(): array
    {
        if ($this->sites === null) {
            $this->populatInnerCache();
        }

        return $this->sites;
    }


    private function populatInnerCache(): void
    {
        $siteClasses = \Config::get('propertyscraper.sites');

        $sites = [];
        foreach ($siteClasses as $siteClass) {
            /** @var Site $site */
            $site = new $siteClass();
            $sites[$site::getSite()] = $site;
        }

        $this->sites = $sites;
    }
}