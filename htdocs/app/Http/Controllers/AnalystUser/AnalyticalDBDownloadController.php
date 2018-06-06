<?php

namespace App\Http\Controllers\AnalystUser;


use App\AnalyticalDB;
use App\Exports\AnalyticalDBWorkerExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AnalyticalDBDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = AnalyticalDB::orderBy('year')->distinct('year')->pluck('year')->transform(function($year){
            return [
                'text' => $year,
                'value' => $year
            ];
        });

        return view('analyst-user.reports.analytical-db-download.index', compact('years'));
    }

    public function store(Request $request)
    {
        return Excel::download(app(AnalyticalDBWorkerExport::class), 'test.csv');
    }
}
