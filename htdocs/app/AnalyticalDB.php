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

    protected $workerColumns = [];
    protected $workerComputedColumns = [
        'ESTNAME',
        'AGE'
    ];

    /**
     * AnalyticalDB constructor.
     * @param array $workerColumns
     */
    public function __construct()
    {
        parent::__construct();
        $this->workerColumns = config('reports.fields.analyticaldbworker');
    }

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

    public function getWorkerAnalyticalDBReport()
    {
        // Get all of the questions.
        $questions = Question::inCategory('worker')->get();

        // Get all the worker answers.
        $answers = WorkerQuestionAnswer::with('question')->take(40)->get();

        // Get all establishments and workers.
        $workers = Worker::with('establishment')
            ->orderBy('establishment_id')->get();

        // Get the columns for the report.
        $columns = collect(self::getColumnsFor('worker'));

        $computed = collect($this->workerComputedColumns);

        return $workers->transform(function($worker) use($columns, $computed, $questions, $answers) {

            $report = [];

            $columns->each(function($column) use(&$report, $worker, $questions, $answers) {

                $answer = optional($answers
                    ->where('worker_id', $worker->id)
                    ->where('question.field', $column)
                    ->first()->answer);

                // If the answer is NULL, then check for a computed field.

                $report[$column] = empty($answer->answer) ? '' : $answer->answer;
            });

            $computed->each(function($column) use(&$report) {
                $report[$column] = empty($answer->answer) ? '' : $answer->answer;
            });

            return $report;
        });
    }

    public function getColumnsFor($category) {

        switch($category) {
            case 'worker':
                $fields = $this->workerColumns;
                break;
            default:
                $fields = [];
        }

        return $fields;
    }
}
