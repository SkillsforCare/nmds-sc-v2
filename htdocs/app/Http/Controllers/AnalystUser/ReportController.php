<?php

namespace App\Http\Controllers\AnalystUser;


use App\Http\Controllers\Controller;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('analyst-user.reports.index');
    }
}
