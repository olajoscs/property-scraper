<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Parsed result page. Includes all necessary information.
 */
class ParsedPropertyList
{
    /**
     * @var ParsedProperty[]
     */
    public $parsedProperties;

    /**
     * @var bool
     */
    public $hasNextPage;


    public function __construct(array $parsedProperties, bool $hasNextPage)
    {
        $this->parsedProperties = $parsedProperties;
        $this->hasNextPage = $hasNextPage;
    }
}
