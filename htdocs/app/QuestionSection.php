<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSection extends Model
{
    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id');
    }

    public function groups()
    {
        return $this->hasMany(QuestionGroup::class);
    }
}
