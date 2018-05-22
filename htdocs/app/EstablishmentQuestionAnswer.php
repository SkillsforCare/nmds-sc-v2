<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablishmentQuestionAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'worker_id',
        'answer',
        'text',
        'submitted_at'
    ];

    public $metaToSave = [];

    public function saveAnswer($question, $data)
    {
        if(empty($data['answer']))
            $data['answer'] = '';

        $answer = app(WorkerQuestionAnswer::class)
            ->where([ 'worker_id' => $data['worker_id'], 'question_id' => $question->id ])->first();

        if(empty($answer))
            $answer = app(WorkerQuestionAnswer::class);

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
