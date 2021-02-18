<?php

declare(strict_types=1);

namespace App\Services\UrlGenerators;

use App\Models\Filters\DunaHouse\DunaHouseAreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseLocationFilter;
use App\Models\Filters\DunaHouse\DunaHousePriceFilter;
use App\Models\Filters\SiteFilter;
use App\Models\Sites\DunaHouse;

/**
 * Generator of DunaHouse specific url based on the filters
 */
class DunaHouseUrlGenerator implements UrlGenerator
{
    public function generate(int $pageNumber, SiteFilter ...$siteFilters): string
    {
        $locationFilterStrings = $this->generateLocationFilterStrings($siteFilters);
        $priceFilterStrings = $this->generatePriceFilterStrings($siteFilters);
        $areaFilterStrings = $this->generateAreaFilterStrings($siteFilters);

        $pageString = $this->generatePageString($pageNumber);

        return sprintf(
            '%s/elado-ingatlan/haz/%s/-/%s/%s%s',
            DunaHouse::getDomain(),
            reset($locationFilterStrings) ?: '-',
            reset($priceFilterStrings) ?: '-',
            reset($areaFilterStrings) ?: '-',
            $pageString
        );
    }


    private function generateLocationFilterStrings(array $siteFilters): array
    {
        return array_map(
            function (SiteFilter $siteFilter) {
                return $siteFilter->getAsParameterString();
            },
            array_filter(
                $siteFilters,
                function (SiteFilter $siteFilter) {
                    return $siteFilter instanceof DunaHouseLocationFilter;
                }
            )
        );
    }


    private function generatePriceFilterStrings(array $siteFilters): array
    {
        return array_map(
            function (SiteFilter $siteFilter) {
                return $siteFilter->getAsParameterString();
            },
            array_filter(
                $siteFilters,
                function (SiteFilter $siteFilter) {
                    return $siteFilter instanceof DunaHousePriceFilter;
                }
            )
        );
    }


    private function generateAreaFilterStrings(array $siteFilters): array
    {
        return array_map(
            function (SiteFilter $siteFilter) {
                return $siteFilter->getAsParameterString();
            },
            array_filter(
                $siteFilters,
                function (SiteFilter $siteFilter) {
                    return $siteFilter instanceof DunaHouseAreaFilter;
                }
            )
        );

    }


    private function generatePageString(int $pageNumber): string
    {
        if ($pageNumber < 2) {
            return '';
        }

        return '/oldal-' . $pageNumber;
    }
}
