<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSection extends Model
{
    public function groups()
    {
        return $this->hasMany(QuestionGroup::class);
    }
}
