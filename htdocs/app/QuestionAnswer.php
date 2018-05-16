<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'worker_id',
        'answer',
        'text',
        'submitted_at'
    ];
}
