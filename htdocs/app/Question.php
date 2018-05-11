<?php

namespace App;

class Question extends BaseModel
{
    protected $casts = [
        'options' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_uuid');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function saveMany($questions, $user)
    {
        collect($questions)->each(function($question) {

        });
    }
}
