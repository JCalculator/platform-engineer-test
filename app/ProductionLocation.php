<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionLocation extends Model
{
    protected $dates = ['shoot_date'];

    protected $fillable = [
        'title',
        'titleHash',
        'type',
        'imdb_link',
        'address',
        'site',
        'shoot_date',
        'latitude',
        'longitude'
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->titleHash = md5(str_replace(' ', '', strtolower(trim($this->title))));
    }
}
