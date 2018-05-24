<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    protected $appends = [
        'selected'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getSelectedAttribute()
    {
        return false;
    }
}
