<?php

declare(strict_types=1);

namespace App\Services\UrlGenerators;

use App\Models\Filters\JofogasHu\JofogasHuLocationFilter;
use App\Models\Filters\SiteFilter;
use App\Models\Sites\JofogasHu;

/**
 * Generator of ingatlan.jofogas.hu specific url based on the filters
 */
class JofogasHuUrlGenerator implements UrlGenerator
{
    public function generate(int $pageNumber, SiteFilter ...$siteFilters): string
    {
        $notLocationFilterStrings = $this->generateNotLocationFilterStrings($siteFilters);
        $locationFilterStrings = $this->generateLocationFilterStrings($siteFilters);

        if ($pageNumber > 1) {
            $notLocationFilterStrings[] = 'o=' . $pageNumber;
        }

        $locationString = implode('+', $locationFilterStrings);
        $notLocationString = implode('&', $notLocationFilterStrings);

        if ($locationString) {
            $locationString .= '/';
        }

        if ($notLocationString) {
            $notLocationString = '?' . $notLocationString;
        }

        return sprintf(
            '%s/%shaz%s',
            JofogasHu::getDomain(),
            $locationString,
            $notLocationString
        );
    }


    private function generateNotLocationFilterStrings(array $siteFilters): array
    {
        return array_map(
            function (SiteFilter $siteFilter) {
                return $siteFilter->getAsParameterString();
            },
            array_filter(
                $siteFilters,
                function (SiteFilter $siteFilter) {
                    return !$siteFilter instanceof JofogasHuLocationFilter;
                }
            )
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
                    return $siteFilter instanceof JofogasHuLocationFilter;
                }
            )
        );
    }
}
