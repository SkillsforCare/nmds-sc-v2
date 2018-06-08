<?php

namespace App\Http\Controllers\AnalystUser;


use App\AnalyticalDB;
use App\Exports\AnalyticalDBWorkerExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $fileName = 'analytical-db-download-' . str_slug(now()->toDateTimeString());
        Excel::store(app(AnalyticalDBWorkerExport::class), '/live/'. $fileName . '.csv', 'analytical-db');

        $csvFile = storage_path('app/analytical-db/live/') . $fileName  . '.csv';
        $zipFile = storage_path('app/analytical-db/live/') . $fileName  . '.zip';

        \Zipper::make($zipFile)->add($csvFile)->close();
        
        Storage::disk('analytical-db')->delete( '/live/'. $fileName  . '.csv');

        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
}
