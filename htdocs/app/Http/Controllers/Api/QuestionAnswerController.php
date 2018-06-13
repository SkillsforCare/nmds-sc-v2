<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionAnswerResource;
use App\Question;
use App\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $validation = collect($data)->transform(function($item){
            if(is_array($item)) {
                $item = build_date($item);
            }
            return $item;
        })->toArray();

        // Validate the questions
        Validator::make($validation, $rules)->validate();


        if($request->entity_type == 'worker') {

            $worker = app(Worker::class)->find($request->entity_id);

            unset($data['entity_type']);
            unset($data['entity_id']);
            $key = array_keys($data);

            //dd($key[0], $request->get($key[0]));

            $worker->saveMetaData($key[0], $request->get($key[0]));

            $question = Question::inCategory('worker')->where('field', $key[0])->first();

            $question->answer = json_decode(json_encode($worker->fresh()->meta_data($key[0])));
        }

        return new QuestionAnswerResource($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    private function validateQuestions($questions)
    {
        dd($questions);
    }
}
