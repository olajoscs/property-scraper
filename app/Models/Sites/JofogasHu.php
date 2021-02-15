<?php

declare(strict_types=1);

namespace App\Models\Sites;

use App\Services\FilterMappers\FilterMapper;
use App\Services\FilterMappers\JofogasHuFilterMapper;
use App\Services\Parsers\JofogasHuListPageParser;
use App\Services\Parsers\ListParser;
use App\Services\UrlGenerators\JofogasHuUrlGenerator;
use App\Services\UrlGenerators\UrlGenerator;

class JofogasHu implements Site
{
    public static function getSite(): string
    {
        return 'ingatlan.jofogas.hu';
    }


    public function getFilterMapper(): FilterMapper
    {
        return new JofogasHuFilterMapper();
    }


    public function getUrlGenerator(): UrlGenerator
    {
        return new JofogasHuUrlGenerator();
    }


    public function getListParser(): ListParser
    {
        return new JofogasHuListPageParser();
    }


    public function getDomain(): string
    {
        return 'https://ingatlan.jofogas.hu';
    }
}
