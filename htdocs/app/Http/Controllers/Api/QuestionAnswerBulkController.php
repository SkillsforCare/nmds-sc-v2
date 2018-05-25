<?php

namespace App\Http\Controllers\Api;

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
        $questions = Question::inCategory('worker')->get();

        return collect($request->all())->transform(function($question) use($questions, $worker) {

            $q = $questions->where('id', $question['id'])->first();

            $field[$q->field] = $question['answer'];
            $rule[$q->field] = $q->validation;

            $validator = Validator::make($field, $rule);

            if($validator->fails()) {
                $question['errors'] = $validator->errors()->first($q->field);
            } else {
                // Save the answer...
                $question['answer'] = app(WorkerQuestionAnswer::class)->saveAnswer($q, [
                    'worker_id' => $worker->id,
                    'answer' => $question['answer'],
                ]);
            }

            return $question;
        });
    }
}
