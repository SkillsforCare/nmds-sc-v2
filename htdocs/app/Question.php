<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $appends = [
        'options',
    ];

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id');
    }

    public function section()
    {
        return $this->belongsTo(QuestionSection::class, 'question_section_id');
    }

    public function getOptionsAttribute()
    {
        return config('lookups.' . strtolower($this->field), null);
    }


    public function scopeInCategory($query, $category)
    {
        return $query->whereHas('category', function ($query) use($category) {
            $query->where('slug', $category);
        });
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
            ->transform(function($question) use($answers, $type) {
                $question->worker_id = $type->id;

                $workerAnswer = $answers->where('question_id', $question->id)->first();

                $question->answer = app(WorkerQuestionAnswer::class);

                if($workerAnswer)
                    $question->answer = $workerAnswer;

                return $question;
            })
            ->groupBy(function ($item, $key) {
                return $item->section->name;
            });

        return $questions;
    }
}
