<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Eloquent implmentation of the repository layer
 */
class PropertyRepositoryEloquent implements PropertyRepository
{
    public function getByForeignId(string $foreignId, string $site): Property
    {
        return Property::withTrashed()->whereForeignId($foreignId)->whereSite($site)->firstOrFail();
    }


    public function getOrNewByForeignId(string $foreignId, string $site): Property
    {
        try {
            return $this->getByForeignId($foreignId, $site);
        } catch (ModelNotFoundException $exception) {
            return $this->create($foreignId, $site);
        }
    }


    public function save(Property ...$properties): void
    {
        \DB::transaction(function() use ($properties) {
            foreach ($properties as $property) {
                if ($property->isDirty($property->getImportantAttributes())) {
                    $property->sendable = true;
                }

                $property->save();
                $property->restore();
            }
        });
    }


    private function create(string $foreignId, string $site): Property
    {
        return new Property([
            'foreignId' => $foreignId,
            'site' => $site
        ]);
    }


    public function findNewProperties(): Collection
    {
        return Property::where('sendable', '=', true)->get();
    }


    public function deleteNotExisting(array $propertyForeignIds, string $site): int
    {
        return Property::where('site', '=', $site)
            ->whereNotIn('foreign_id', $propertyForeignIds)
            ->delete();
    }
}