<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Parsed product from a site html
 */
class ParsedProperty
{
    /**
     * @var string
     */
    public $foreign_id;

    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string
     */
    public $place;

    /**
     * @var string
     */
    public $link;

    /**
     * @var string
     */
    public $site;

    /**
     * @var string|null
     */
    public $image;

    /**
     * @var int
     */
    public $price;

    /**
     * @var int
     */
    public $area;


    public static function make(array $arguments): self
    {
        $property = new self();

        foreach ($arguments as $name => $value) {
            $property->$name = $value;
        }

        return $property;
    }
}
