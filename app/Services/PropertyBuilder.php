<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyPair;

/**
 * Builder of the Propety object based on the ParsedProperty
 */
class PropertyBuilder
{
    /**
     * Build the Propety object based on the ParsedProperty
     *
     * @param PropertyPair $propertyPair
     *
     * @return Property
     */
    public function build(PropertyPair $propertyPair): Property
    {
        $property = $propertyPair->getProperty();
        $parsedProperty = $propertyPair->getParsedProperty();

        $property->name = $parsedProperty->name;
        $property->place = $parsedProperty->place;
        $property->link = $parsedProperty->link;
        $property->site = $parsedProperty->site;
        $property->image = $parsedProperty->image;
        $property->price = $parsedProperty->price;
        $property->area = $parsedProperty->area;
        $property->foreign_id = $parsedProperty->foreign_id;

        return $property;
    }
}
