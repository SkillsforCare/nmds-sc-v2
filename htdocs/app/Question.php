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

    public function answer($person = null)
    {
        if(empty($person))
            $person = auth()->user()->person;

        return $this->hasOne(Answer::class)->orWhere('person_uuid', $person->uuid);
    }

    public function saveMany($questions, $user)
    {
        collect($questions)->each(function($question) {

        });
    }
}
