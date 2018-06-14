<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function sections()
    {
        return $this->hasMany(QuestionSection::class);
    }
}
