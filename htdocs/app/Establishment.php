<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $casts = [
        'meta' => 'array',
    ];

    public function answers()
    {
        return $this->hasMany(EstablishmentQuestionAnswer::class);
    }

    public function getMetaDataAttribute()
    {
        return $this->meta;
    }
}
