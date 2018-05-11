<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Filters\FilterQuestionType;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionAnswerResource;
use App\Question;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::w;


        $questions = QueryBuilder::for(Question::class)
            ->allowedIncludes(['answer'])
            ->allowedFilters(Filter::custom('question_type', FilterQuestionType::class))
            ->get();

        //dd($questions->toArray());

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
        $question = app(Question::class)->withUuid($request->uuid)->firstOrFail();

        $this->validate($request,[
            'answer' => $question->validation,
            'text' => 'required'
        ]);

        $answer = app(Answer::class)->withUuid($request->answer_uuid)->first();

        if(empty($answer))
            $answer = app(Answer::class);

        //dd($answer);

        $answer->fill([
            'person_uuid' => $request->user()->person->uuid,
            'answer' => $request->answer,
            'text' => $request->text,
            'submitted_at' => now()->toDateTimeString()
        ]);

        $question->answer($request->user()->person)->save($answer);

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
