<?php

namespace App\Http\Controllers;

use App\QuestionGroup;
use App\Worker;

class FinishWorkerRecordController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param Worker $worker
     * @return Response
     */
    public function __invoke(Worker $worker)
    {
        $worker->update([ 'finished_adding_at' => now()->toDateTimeString() ]);
        $group = QuestionGroup::default()->first();

        return response()->redirectToRoute('records.workers.edit', [ 'worker' => $worker, 'group' => $group->slug]);
    }


}
