<?php

namespace App;


class QuestionAnswer
{

    public function saveAnswer($question, $data)
    {
        if(empty($data['answer']))
            $data['answer'] = '';


        if($data['entity_type'] === 'worker')
        {
            $answer = app(WorkerQuestionAnswer::class)
                ->where([ 'worker_id' => $data['entity_id'], 'question_id' => $question->id ])->first();

            if(empty($answer))
                $answer = app(WorkerQuestionAnswer::class);

            $answer->worker_id = $data['entity_id'];
        }

        if($data['entity_type'] === 'establishment')
        {
            $answer = app(EstablishmentQuestionAnswer::class)
                ->where([ 'establishment_id' => $data['entity_id'], 'question_id' => $question->id ])->first();

            if(empty($answer))
                $answer = app(EstablishmentQuestionAnswer::class);

            $answer->establishment_id = $data['entity_id'];
        }

        $answer->fill([
            'question_id' => $question->id,
            'answer' => $data['answer'],
            'text' => $data['text'],
            'submitted_at' => now()->toDateTimeString()
        ])->save();

        if(in_array($question->field, $answer->metaToSave)) {

            if($data['entity_type'] === 'worker')
            {
                $entity = app(Worker::class)->find($data['entity_id']);
            }

            if($data['entity_type'] === 'establishment')
            {
                $entity = app(Establishment::class)->find($data['entity_id']);
            }

            $meta = $entity->meta;
            $meta[$question->field] = $answer->text;
            $entity->meta = $meta;

            $entity->save();
        }

        return $answer;
    }
}
