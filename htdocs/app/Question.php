<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $casts = [
        'options' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id');
    }

    public function section()
    {
        return $this->belongsTo(QuestionSection::class, 'question_section_id');
    }


    public function scopeInCategory($query, $category) {

    }

    public function scopeWithWorkerAnswers($worker) {

    }
}
