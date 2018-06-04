<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    protected $appends = [
        'selected'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function section()
    {
        return $this->belongsTo(QuestionSection::class, 'question_section_id');
    }

    public function prev_group()
    {
        return $this->hasOne(QuestionGroup::class, 'group_next_id');
    }

    public function next_group()
    {
        return $this->hasOne(QuestionGroup::class, 'group_previous_id');
    }

    public function scopeDefault($query)
    {
        return $query->whereNotNull('default_at');
    }

    public function getSelectedAttribute()
    {
        return false;
    }
}
