<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerQuestionAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'worker_id',
        'answer',
        'text',
        'submitted_at'
    ];

    public $metaToSave = [
        'UNIQUEWORKERID',
        'MAINJOBROLE'
    ];

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
            'submitted_at' => now()->toDateTimeString()
        ]);

        $text = $data['answer'];

        if ($question->field_type === 'select' or $question->field_type === 'radio-list') {
            $text = collect(config('lookups.' . strtolower($question->field)))
                ->where('value', $data['answer'])
                ->first()['text'];
        }

        $answer->text = $text;
        $answer->save();

        if(in_array($question->field, $this->metaToSave)) {
            $worker = app(Worker::class)->find($data['worker_id']);

            $meta = $worker->meta;

            $meta[$question->field] = $text;

            $worker->meta = $meta;

            $worker->save();
        }

        return $answer;
    }
}
