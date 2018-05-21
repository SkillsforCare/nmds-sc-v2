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

    public function scopeWithWorkerAnswers($query, $worker)
    {

    }
}
