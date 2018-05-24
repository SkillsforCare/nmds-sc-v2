<?php

namespace App\Http\Controllers;

use App\Question;
use App\WorkerQuestionAnswer;
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
        $questions = QuestionCategory::with('sections.groups.questions')
            ->where('slug', 'worker')
            ->get()[0]->sections;

        $questions->each(function($section) {
            return $section->groups->each(function($group){

                $group->prev_group = $group->group_previous_id;
                $group->next_group = $group->group_next_id;

                return $group;
            });
        });

        return view('workers.create', compact('questions'));
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
        $questions = app(Question::class)->getQuestions('worker', $worker);

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
