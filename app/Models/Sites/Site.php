<?php

declare(strict_types=1);

namespace App\Models\Sites;

use App\Services\FilterMappers\FilterMapper;
use App\Services\Parsers\ListParser;
use App\Services\UrlGenerators\UrlGenerator;

/**
 * Define site specific strategies
 */
interface Site
{
    /**
     * Return the site name
     *
     * @return string
     */
    public static function getSite(): string;


    /**
     * Return the filter mapper, which converts the filters to site specific filters
     *
     * @return FilterMapper
     */
    public function getFilterMapper(): FilterMapper;


    /**
     * Return the search url generator
     *
     * @return UrlGenerator
     */
    public function getUrlGenerator(): UrlGenerator;


    /**
     * Return the html list page parser
     *
     * @return ListParser
     */
    public function getListParser(): ListParser;
}