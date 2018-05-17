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

    protected $metaToSave = [
        'UNIQUEWORKERID',
        'MAINJOBROLE'
    ];

    public function saveAnswer($question, $data)
    {
        $answer = app(QuestionAnswer::class)
            ->where([ 'worker_id' => $data['worker_id'], 'question_id' => $question->id ])->first();

        if(empty($answer))
            $answer = app(QuestionAnswer::class);

        $answer->fill([
            'question_id' => $question->id,
            'worker_id' => $data['worker_id'],
            'answer' => $data['answer'],
            'text' => $data['text'],
            'submitted_at' => now()->toDateTimeString()
        ])->save();

        if(in_array($question->field, $this->metaToSave)) {
            $worker = app(Worker::class)->find($data['worker_id']);

            $meta = $worker->meta;
            $meta[strtolower($question->field)] = $answer->text;
            $worker->meta = $meta;

            $worker->save();
        }

        return $answer;
    }
}
