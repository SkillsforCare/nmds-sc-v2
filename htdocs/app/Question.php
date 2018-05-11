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

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scopePersonAnswer($query, $person)
    {
        return $query->answers()->where('person_id', $person->id);
    }
}
