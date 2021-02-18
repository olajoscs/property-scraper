<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ParsedProperty;
use App\Models\Property;
use App\Models\PropertyPair;
use App\Models\Sites\Site;
use App\Repositories\PropertyRepository;

/**
 * Saves of the Property objects based on the ParedProperty objects
 * TODO: TEST
 */
class PropertyMapper
{
    private $propertyRepository;
    private $propertyBuilder;


    public function __construct(PropertyRepository $propertyRepository, PropertyBuilder $propertyBuilder)
    {
        $this->propertyRepository = $propertyRepository;
        $this->propertyBuilder = $propertyBuilder;
    }


    /**
     * Save the Property objects based on the ParedProperty objects
     *
     * @param ParsedProperty ...$parsedProperties
     *
     * @return Property[]
     */
    public function map(ParsedProperty ...$parsedProperties): array
    {
        $propertyPairs = $this->generatePropertyPairs($parsedProperties);

        $builtProperties = array_map(
            fn(PropertyPair $propertyPair) => $this->propertyBuilder->build($propertyPair),
            $propertyPairs
        );

        $this->propertyRepository->save(...$builtProperties);

        return $builtProperties;
    }


    /**
     * Delete properties, which ID is not in the array
     *
     * @param Site       $site
     * @param Property[] $properties
     *
     * @return int Number of deleted rows
     */
    public function deleteNotExistingProperties(Site $site, Property ...$properties): int
    {
        $propertyForeignIds = array_map(
            fn(Property $property) => $property->foreign_id,
            $properties
        );

        return $this->propertyRepository->deleteNotExisting($propertyForeignIds, $site::getSite());
    }


    /**
     * Create PropertyPair objects, which contains the ParsedProperty and the found/new Property objects
     *
     * @param array $parsedProperties
     *
     * @return PropertyPair[]
     */
    private function generatePropertyPairs(array $parsedProperties): array
    {
        return array_map(
            function (ParsedProperty $parsedProperty) {
                return new PropertyPair(
                    $parsedProperty,
                    $this->propertyRepository->getOrNewByForeignId($parsedProperty->foreign_id, $parsedProperty->site)
                );
            },
            $parsedProperties
        );
    }
}