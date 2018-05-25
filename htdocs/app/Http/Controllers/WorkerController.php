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
        $questions = Question::inCategory('worker')->mandatory()->get();
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
        // Get the submitted questions to validate.
        $rules = [];
        $questions = Question::whereIn('field', array_keys($request->all()))
            ->get()
            ->each(function($question) use(&$rules) {
                if(!empty($question->validation))
                    $rules[$question->field] = $question->validation;
            });

        // Validate the questions
        $this->validate($request,$rules);

        // Create the worker.
        $meta_fields = $request->all();
        unset($meta_fields['_token']);

        $worker = Worker::create(
            [
                'establishment_id' => auth()->user()->person->establishment->id
            ]
        );

        collect($meta_fields)->each(function($value, $meta_field) use(&$meta, $questions, $worker) {

            // Determine from the questions the field type
            $question = $questions->where('field', $meta_field)->first();

            // Also create an answer to the question.
            app(WorkerQuestionAnswer::class)->saveAnswer($question, [
                'worker_id' => $worker->id,
                'answer' => $value,
            ]);
        });

        return response()->redirectToRoute('records.workers.edit', $worker);
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
     *
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {

        $workerAnswers = $worker->answers;

        $questions = QuestionCategory::with('sections.groups.questions')
            ->where('slug', 'worker')
            ->get()[0]->sections;

        $questions->each(function($section) use($workerAnswers ) {
            return $section->groups->each(function($group) use($workerAnswers) {

                $group->prev_group = $group->group_previous_id;
                $group->next_group = $group->group_next_id;

                $group->questions->each(function($question) use($workerAnswers) {

                    $question->answer = (object) [
                        'text' => null,
                        'answer' => null
                    ];

                    $answer = $workerAnswers->where('question_id', $question->id)->first();

                    if(!empty($answer)) {
                        $question->answer = $answer;
                    }

                    return $question;
                });

                return $group;
            });
        });

        return view('workers.edit', compact('worker', 'questions'));
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
