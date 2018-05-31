<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $appends = [
        'options'
    ];

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id');
    }

    public function section()
    {
        return $this->belongsTo(QuestionSection::class);
    }

    public function group()
    {
        return $this->belongsTo(QuestionGroup::class, 'question_group_id');
    }

    public function getOptionsAttribute()
    {
        if($this->field_type === 'select')
            return array_merge([[ 'text' => 'Please select', 'value' => null ]], config('lookups.' . strtolower($this->field), null));

        return config('lookups.' . strtolower($this->field));
    }

    public function scopeInCategory($query, $category)
    {
        return $query->whereHas('category', function ($query) use($category) {
            $query->where('slug', $category);
        });
    }

    public function scopeMandatory($query)
    {
        return $query->whereNotNull('mandatory_at');
    }

    public function getQuestions($category, $type)
    {
        $answers = $type->answers;

        $questions = Question::inCategory($category)
            ->join(\DB::raw('question_sections qs'), 'question_section_id', '=', 'qs.id')
            ->whereNull('hidden_at')
            ->select('questions.*')
            ->orderBy('qs.order')
            ->orderBy('order')
            ->get()
            ->transform(function($question) use($answers, $type, $category) {
                $question->entity_id = $type->id;
                $question->entity_type = $category;

                $answer = $answers->where('question_id', $question->id)->first();

                $question->answer = app(EstablishmentQuestionAnswer::class);
                if($category == 'worker')
                    $question->answer = app(WorkerQuestionAnswer::class);

                if($answer)
                    $question->answer = $answer;

                return $question;
            })
            ->groupBy(function ($item, $key) {
                return $item->section->name;
            });

        return $questions;
    }
}
