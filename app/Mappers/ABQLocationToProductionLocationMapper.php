<?php

namespace App\Mappers;

use App\ProductionLocation;
use kepka42\LaravelMapper\Mapper\AbstractMapper;

class ABQLocationToProductionLocationMapper extends AbstractMapper
{
    protected $sourceType = "ABQApiResource";

    protected $hintType = "ProductionLocation";

    /**
     * Realisation of mapper
     *
     * @param $object
     * @param array $params
     * @return mixed
     */
    public function map($object, $params = [])
    {
        $attributes = $object->attributes;
        $geometry = $object->geometry;
        return new ProductionLocation([
            'title' => trim($attributes->Title),
            'type' => trim($attributes->Type),
            'imdb_link' => trim($attributes->IMDbLink),
            'address' => trim($attributes->Address),
            'site' => trim($attributes->Site),
            'shoot_date' => \Carbon\Carbon::createFromTimestampMs($attributes->ShootDate),
            'latitude' => $geometry->y,
            'longitude' => $geometry->x
        ]);
    }
}
