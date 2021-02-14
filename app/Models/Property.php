<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Property
 *
 * @property int $id
 * @property string $name
 * @property string $place
 * @property string $link
 * @property string foreign_id
 * @property string $site
 * @property string $image
 * @property int $sendable
 * @property int $price
 * @property int $area
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereSendable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereForeignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereArea($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
    protected $fillable = [
        'name',
        'place',
        'link',
        'site',
        'image',
        'price',
        'area',
        'foreign_id',
    ];


    public function getImportantAttributes(): array
    {
        return [
            'name',
            'place',
            'link',
            'site',
            'image',
            'price',
            'area',
        ];
    }
}