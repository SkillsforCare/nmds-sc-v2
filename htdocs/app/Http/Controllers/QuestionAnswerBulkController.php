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

        $data = collect($data)->transform(function($item){
            if(is_array($item))
                $item = build_date($item);

            return $item;
        })->toArray();

        // Validate the questions
        Validator::make($data, $rules)->validate();

        unset($data['_token']);
        unset($data['_method']);

        collect($data)->each(function($value, $key) use(&$meta, $questions, $worker) {

            // Determine from the questions the field type
            $question = $questions->where('field', $key)->first();

            // Also create an answer to the question.
            app(WorkerQuestionAnswer::class)->saveAnswer($question, [
                'worker_id' => $worker->id,
                'answer' => $value,
            ]);
        });

        // Get the 'next' group for one of the questions and redirect to it.
        $group = $questions->first()->group->next_group;

        return response()
            ->redirectToRoute('records.workers.edit',
                [ 'worker' => $worker, 'group' => $group->slug ]
            )->with('status', 'Progress saved!');;
    }
}
