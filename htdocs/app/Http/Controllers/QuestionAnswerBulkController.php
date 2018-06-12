<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Question;
use App\Worker;
use App\WorkerQuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerBulkController extends Controller
{
    public function update(Request $request, Worker $worker)
    {

        // Get the submitted questions to validate.
        $rules = [];
        $questions = Question::inCategory('worker')->whereIn('field', array_keys($request->all()))
            ->get()
            ->each(function($question) use(&$rules) {
                if(!empty($question->validation))
                    $rules[$question->field] = $question->validation;
            });

        $data = $request->all();


        $next = false;
        if($request->has('saveNext'))
            $next = true;


        $data = collect($data)->transform(function($item){
            if(is_array($item))
                $item = build_date($item);

            return $item;
        })->toArray();

        // Validate the questions
        Validator::make($data, $rules)->validate();

        unset($data['_token']);
        unset($data['_method']);
        unset($data['saveNext']);

        collect($data)->each(function($value, $key) use(&$meta, $questions, $worker) {

            // Determine from the questions the field type
            $question = $questions->where('field', $key)->first();
            $text = $question->text_value($answer = $value);
            $worker->saveMetaData($field = $key, $answer = $value, $text);
        });

        // Get the 'next' group for one of the questions and redirect to it.
        $group = $questions->first()->group;

        if($next) {
            return response()
                ->redirectToRoute('records.workers.edit',
                    ['worker' => $worker, 'group' => $group->next_group->slug]
                )->with('status', 'Progress saved!');
        }

        return response()
            ->redirectToRoute('records.workers.edit',
                ['worker' => $worker, 'group' => $group->slug]
            )->with('status', 'Progress saved!');
    }
}
