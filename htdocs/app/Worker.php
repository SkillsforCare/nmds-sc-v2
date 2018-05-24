<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $casts = [
        'meta' => 'array',
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function answers()
    {
        return $this->hasMany(WorkerQuestionAnswer::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAttentionRequiredAttribute()
    {
        if(empty($this->finished_adding_at)) {
            return [ 'message' => 'Continue with this worker record', 'url' => route('records.workers.create') ];
        }

        return null;
    }

    public function getMetaDataAttribute()
    {
        return $this->meta;
    }

    public function scopeInEstablishment($query, $establishment) {
        return $query->whereHas('establishment', function ($query) use ($establishment) {
            $query->where('id', $establishment->id);
        });
    }
}
