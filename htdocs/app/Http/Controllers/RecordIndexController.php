<?php

namespace App\Http\Controllers;

use App\Worker;

class RecordIndexController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param Worker $worker
     * @return Response
     */
    public function __invoke()
    {
        $requiresAttention = Worker::inEstablishment()->get()->requiresAttention()->count();
        return view('records.index', compact('requiresAttention'));
    }


}
