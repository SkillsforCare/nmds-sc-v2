<?php

namespace App;

class Question extends BaseModel
{
    protected $casts = [
        'options' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function personAnswers($question_type, $person)
    {
       // dd($person);

       return $this->where('question_type_id', $question_type->id)
            ->get()
            ->transform(function($question) use($person) {
                $question->answer = $question->answer()->where('person_id', $person->id)->first();
                return $question;
            });
    }
}
