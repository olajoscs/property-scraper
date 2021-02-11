<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\ParsedProperty;
use App\Models\Property;
use App\Models\PropertyPair;
use App\Services\PropertyBuilder;
use PHPUnit\Framework\TestCase;

class PropertyBuilderTest extends TestCase
{
    public function test_setting_properties(): void
    {
        $parsedProperty = new ParsedProperty();

        $parsedProperty->foreign_id = 'site foreign id';
        $parsedProperty->name = 'foreign name';
        $parsedProperty->place = 'foreign place';
        $parsedProperty->link = 'foreign link';
        $parsedProperty->site = 'site';
        $parsedProperty->image = 'foreign image';
        $parsedProperty->price = 1000;
        $parsedProperty->area = 10;

        $expectedProperty = new Property(
            [
                'foreign_id' => 'site foreign id',
                'name' => 'foreign name',
                'place' => 'foreign place',
                'link' => 'foreign link',
                'site' => 'site',
                'image' => 'foreign image',
                'price' => 1000,
                'area' => 10,
            ]
        );

        $builder = new PropertyBuilder();

        $this->assertEquals($expectedProperty, $builder->build(new PropertyPair($parsedProperty, new Property())));
    }
}