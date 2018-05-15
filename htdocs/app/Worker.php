<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeInEstablishment($query, $establishment) {
        return $query->whereHas('establishment', function ($query) use ($establishment) {
            $query->where('id', $establishment->id);
        });
    }
}
