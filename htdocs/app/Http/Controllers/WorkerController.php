<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionAnswer;
use App\QuestionCategory;
use App\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establishment = auth()->user()->person->establishment;
        $workers = Worker::inEstablishment($establishment)->get();
        return view('records.workers', compact('workers'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        $answers = $worker->answers;

        //dd($answers);

        $questions = Question::inCategory('worker')
            ->with('section')
            ->get()
            ->transform(function($question) use($answers, $worker) {
                $question->worker_id = $worker->id;

                $workerAnswer = $answers->where('question_id', $question->id)->first();

                $question->answer = app(QuestionAnswer::class);

                if($workerAnswer)
                    $question->answer = $workerAnswer;

                return $question;
            })
            ->sortBy('section.order')
            ->sortBy('order')
            ->groupBy(function ($item, $key) {
                return $item->section->name;
            });

       // dd($questions->toArray());

        return view('workers.show', compact('worker', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
