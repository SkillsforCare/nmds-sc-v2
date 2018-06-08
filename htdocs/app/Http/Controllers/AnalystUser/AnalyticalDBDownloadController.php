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
        if($request->has('year') and $request->has('month')) {

            $file = AnalyticalDB::where('year', $request->year)
                ->where('month', $request->month)
                ->where('year', $request->year)
                ->first();

            if(empty($file))
                return redirect()->back()->with('status', 'Unable to find file!');

            return $file->getFirstMedia('analytical-db-worker');

        } else {
            $fileName = 'AGGWP_ANALYSIS_M' . now()->format('Ym');
            Excel::store(app(AnalyticalDBWorkerExport::class), '/live/'. $fileName . '.csv', 'analytical-db');

            $csvFile = storage_path('app/analytical-db/live/') . $fileName  . '.csv';
            $zipFile = storage_path('app/analytical-db/live/') . $fileName  . '.zip';

            \Zipper::make($zipFile)->add($csvFile)->close();

            Storage::disk('analytical-db')->delete( '/live/'. $fileName  . '.csv');

            return response()->download($zipFile)->deleteFileAfterSend(true);
        }
    }
}
