<?php

declare(strict_types=1);

namespace App\Models\Sites;

use App\Services\FilterMappers\FilterMapper;
use App\Services\FilterMappers\OtthonCentrumFilterMapper;
use App\Services\Parsers\ListParser;
use App\Services\Parsers\OtthonCentrumListParser;
use App\Services\UrlGenerators\OtthonCentrumUrlGenerator;
use App\Services\UrlGenerators\UrlGenerator;

class OtthonCentrum implements Site
{
    public static function getSite(): string
    {
        return 'OtthonCentrum';
    }


    public function getFilterMapper(): FilterMapper
    {
        return new OtthonCentrumFilterMapper();
    }


    public function getUrlGenerator(): UrlGenerator
    {
        return new OtthonCentrumUrlGenerator();
    }


    public function getListParser(): ListParser
    {
        return new OtthonCentrumListParser();
    }


    public static function getDomain(): string
    {
        return 'https://oc.hu';
    }

}