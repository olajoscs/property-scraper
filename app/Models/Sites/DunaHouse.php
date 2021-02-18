<?php

declare(strict_types=1);

namespace App\Models\Sites;

use App\Services\FilterMappers\DunaHouseFilterMapper;
use App\Services\FilterMappers\FilterMapper;
use App\Services\Parsers\DunaHouseListParser;
use App\Services\Parsers\ListParser;
use App\Services\UrlGenerators\DunaHouseUrlGenerator;
use App\Services\UrlGenerators\UrlGenerator;

class DunaHouse implements Site
{
    public static function getSite(): string
    {
        return 'DunaHouse';
    }


    public function getFilterMapper(): FilterMapper
    {
        return new DunaHouseFilterMapper();
    }


    public function getUrlGenerator(): UrlGenerator
    {
        return new DunaHouseUrlGenerator();
    }


    public function getListParser(): ListParser
    {
        return new DunaHouseListParser();
    }


    public static function getDomain(): string
    {
        return 'https://dh.hu';
    }
}
