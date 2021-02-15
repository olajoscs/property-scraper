<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\ParsedPropertyList;

/**
 * Parser of the html of a site then create ParsedProperty objects
 */
interface ListParser
{
    /**
     * Parse the html of a site then create ParsedProperty objects
     *
     * @param string $html
     *
     * @return ParsedPropertyList
     */
    public function parse(string $html): ParsedPropertyList;
}