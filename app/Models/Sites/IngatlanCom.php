<?php

declare(strict_types=1);

namespace App\Models\Sites;

use App\Services\FilterMappers\FilterMapper;
use App\Services\FilterMappers\IngatlanComFilterMapper;
use App\Services\Parsers\IngatlanComListParser;
use App\Services\Parsers\ListParser;
use App\Services\UrlGenerators\IngatlanComUrlGenerator;
use App\Services\UrlGenerators\UrlGenerator;

/**
 *
 */
class IngatlanCom implements Site
{
    public static function getSite(): string
    {
        return 'ingatlan.com';
    }


    public function getFilterMapper(): FilterMapper
    {
        return new IngatlanComFilterMapper();
    }


    public function getUrlGenerator(): UrlGenerator
    {
        return new IngatlanComUrlGenerator();
    }


    public function getListParser(): ListParser
    {
        return new IngatlanComListParser();
    }


    public function getDomain(): string
    {
        return 'https://ingatlan.com';
    }
}
