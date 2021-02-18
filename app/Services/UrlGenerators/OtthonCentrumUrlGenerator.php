<?php

declare(strict_types=1);

namespace App\Services\UrlGenerators;

use App\Models\Filters\SiteFilter;
use App\Models\Sites\OtthonCentrum;

/**
 * Generator of OtthonCentrum specific url based on the filters
 */
class OtthonCentrumUrlGenerator implements UrlGenerator
{
    public function generate(int $pageNumber, SiteFilter ...$siteFilters): string
    {
        $filterStrings = $this->generateFilterStrings($siteFilters);

        $filterString = implode('/', $filterStrings);

        $pageString = $this->generatePageString($pageNumber);

        return sprintf(
            '%s/ingatlanok/lista/felhasznalas:elado/tipus:house/%s%s',
            OtthonCentrum::getDomain(),
            $filterString,
            $pageString
        );
    }


    private function generateFilterStrings(array $siteFilters): array
    {
        return array_map(
            function (SiteFilter $filter) {
                return $filter->getAsParameterString();
            },
            $siteFilters
        );
    }


    private function generatePageString(int $pageNumber): string
    {
        if ($pageNumber < 2) {
            return '';
        }

        return '?page=' . $pageNumber;
    }

}