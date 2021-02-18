<?php

declare(strict_types=1);

namespace App\Services\UrlGenerators;

use App\Models\Filters\SiteFilter;
use App\Models\Sites\IngatlanCom;

/**
 * Generator of ingatlan.com specific url based on the filters
 */
class IngatlanComUrlGenerator implements UrlGenerator
{
    public function generate(int $pageNumber, SiteFilter ...$siteFilters): string
    {
        $strings = array_map(
            function (SiteFilter $siteFilter) {
                return $siteFilter->getAsParameterString();
            },
            $siteFilters
        );

        $strings[] = 'elado';
        $strings[] = 'haz';

        $pageNumberString = $this->generatePageNumberString($pageNumber);

        return sprintf(
            '%s/lista/%s%s',
            IngatlanCom::getDomain(),
            implode('+', $strings),
            $pageNumberString
        );
    }


    private function generatePageNumberString(int $pageNumber): string
    {
        if ($pageNumber < 2) {
            return '';
        }

        return sprintf('?page=%s', $pageNumber);
    }
}
