<?php

namespace App;

class Answer extends BaseModel
{
    protected $fillable = [
        'question_id',
        'person_id',
        'answer',
        'text',
        'submitted_at'
    ];
}
