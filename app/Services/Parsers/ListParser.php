<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\ParsedProperty;

/**
 * Parser of the html of a site then create ParsedProperty objects
 */
interface ListParser
{
    /**
     * Parse the html of an Ingatlan.com site then create ParsedProperty objects
     *
     * @param string $html
     *
     * @return ParsedProperty[]
     */
    public function parse(string $html): array;
}