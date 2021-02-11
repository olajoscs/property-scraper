<?php

declare(strict_types=1);

namespace App\Models\Filters;

class LocationFilter implements Filter
{
    /**
     * @var string[]
     */
    private $locations;


    public function __construct(string ...$locations)
    {
        $this->locations = $locations;
    }


    /**
     * @return string[]
     */
    public function getLocations(): array
    {
        return $this->locations;
    }
}