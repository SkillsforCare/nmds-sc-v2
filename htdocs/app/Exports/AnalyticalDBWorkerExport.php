<?php

namespace App\Exports;

use App\AnalyticalDB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AnalyticalDBWorkerExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        return view('analyst-user.reports.analytical-db-download.downloads.worker', [
            'report' => app(AnalyticalDB::class)->getWorkerAnalyticalDBReport()
        ]);
    }
}