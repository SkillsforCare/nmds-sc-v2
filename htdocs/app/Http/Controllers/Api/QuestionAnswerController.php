<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionAnswerResource;
use App\Question;
use App\QuestionType;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question_type = QuestionType::where('slug', request()->query('filter')['question_type'])->firstOrFail();

        $questions = (new Question)->personAnswers($question_type, auth()->user()->person);


        return QuestionAnswerResource::collection($questions);
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
        $question = app(Question::class)->findorFail($request->id);

        $this->validate($request,[
            'answer' => $question->validation,
            'text' => 'required'
        ]);

        $answer = app(Answer::class)->find($request->answer_id);

        if(empty($answer))
            $answer = app(Answer::class);

        $answer->fill([
            'question_id' => $question->id,
            'person_id' => $request->user()->person->id,
            'answer' => $request->answer,
            'text' => $request->text,
            'submitted_at' => now()->toDateTimeString()
        ])->save();

        $question->answer = $answer;

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
