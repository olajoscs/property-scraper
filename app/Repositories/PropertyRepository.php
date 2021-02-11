<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Repository layer of the properties
 */
interface PropertyRepository
{
    /**
     * Get a product by its foreign id and site
     *
     * @param string $foreignId
     * @param string $site
     *
     * @return Property
     * @throws ModelNotFoundException
     */
    public function getByForeignId(string $foreignId, string $site): Property;


    /**
     * Get a product by its foreign id and site. If it does not exist, a new one is returned
     *
     * @param string $foreignId
     * @param string $site
     *
     * @return Property
     */
    public function getOrNewByForeignId(string $foreignId, string $site): Property;


    /**
     * Save the properties
     *
     * @param Property ...$properties
     *
     * @return void
     */
    public function save(Property ...$properties): void;
}