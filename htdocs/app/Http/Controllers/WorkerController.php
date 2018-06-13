<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionGroup;
use App\QuestionSection;
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

        $filter = request()->get('filter') == 'attention' ? 'attention' : null;

        $originalCount = 0;

        if($filter == 'attention') {
            $workers = Worker::inEstablishment($establishment)->get()->tap(function ($collection) use(&$originalCount) {
                $originalCount = $collection->count();
            })->requiresAttention();

        } else {
            $workers = Worker::inEstablishment($establishment)->get();
            $originalCount = $workers->count();
        }

        return view('records.workers', compact('workers', 'filter', 'originalCount'));
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
            $worker->saveMetaData($field = $meta_field, $answer = $value);
        });

        return response()->redirectToRoute('records.workers.edit', [ 'worker' => $worker, 'group' => QuestionGroup::default()->first()->slug ]);
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
     * @param  \App\Worker $worker
     * @param QuestionGroup $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker, $group)
    {
        $categories = QuestionCategory::with('sections.groups')
            ->where('slug', 'worker')
            ->first();

        if($group !== 'summary') {
            $groupQuestion = QuestionGroup::with('prev_group', 'next_group', 'section', 'questions')->where('slug', $group)->first();

            if(!$groupQuestion and $group !== 'summary') {
                $groupQuestion = QuestionGroup::default()->first();
                return response()->redirectToRoute('records.workers.edit',
                    [ 'worker' => $worker, 'group' => $groupQuestion->slug ]);
            }

        } else {
            $groupQuestion = QuestionSection::whereHas('category', function($q) {
                $q->where('slug', 'worker');
            })->with('groups.prev_group', 'groups.next_group', 'groups.questions')->get();
        }

        if($group !== 'summary') {
            $groupQuestion->questions->transform(function ($question) use ($worker) {
                $question->answer = optional($worker->meta_data($question->field)) ? $worker->meta_data($question->field)['answer'] : null;
                return $question;
            });
        } else {
            $groupQuestion->transform(function($section) use ($worker) {

                $section->groups->transform(function($group) use ($worker) {

                    $group->questions->transform(function ($question) use ($worker) {

                        $answer =  $worker->meta_data($question->field);

                        if($question->field_type == 'date') {
                            $answer = friendly_date($worker->meta_data($question->field)['answer']);
                        } else {
                            $answer = $answer['text'];
                        }

                        if(empty($answer)) {
                            $answer = 'Not answered';
                        }

                        $question->answer = $answer;

                        return $question;
                    });

                    return $group;

                });

                return $section;
            });
        }

        return view('workers.edit', compact('worker', 'categories', 'groupQuestion', 'group'));
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
