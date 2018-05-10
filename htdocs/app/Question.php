<?php

namespace App;

class Question extends BaseModel
{
    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_uuid');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
}
