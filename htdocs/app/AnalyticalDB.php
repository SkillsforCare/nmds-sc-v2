<?php

namespace App;

use App\Exports\AnalyticalDBWorkerExport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class AnalyticalDB extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [ 'type', 'month', 'year' ];

    public function workerZipGenerate(Carbon $date)
    {
        $fileName = 'AGGWP_ANALYSIS_M' . $date->format('Ym');
        Excel::store(app(AnalyticalDBWorkerExport::class), '/archive/'. $fileName . '.csv', 'analytical-db');

        $csvFile = storage_path('app/analytical-db/archive/') . $fileName  . '.csv';
        $zipFile = storage_path('app/analytical-db/archive/') . $fileName  . '.zip';

        \Zipper::make($zipFile)->add($csvFile)->close();
        Storage::disk('analytical-db')->delete( '/archive/'. $fileName  . '.csv');

        $this->type = 'archive';
        $this->year = $date->year;
        $this->month = $date->month;

        $this->save();

        $this->addMedia($zipFile)
            ->toMediaCollection('analytical-db-worker');

        return $this;

    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('analytical-db-worker')
            ->useDisk('analytical-db');
    }
}
