<?php

declare(strict_types=1);

namespace App\Models;

/**
 * A parsed property and stored property pair
 */
class PropertyPair
{
    private $parsedProperty;
    private $property;


    public function __construct(ParsedProperty $parsedProperty, Property $property)
    {
        $this->parsedProperty = $parsedProperty;
        $this->property = $property;
    }


    public function getParsedProperty(): ParsedProperty
    {
        return $this->parsedProperty;
    }


    public function getProperty(): Property
    {
        return $this->property;
    }
}