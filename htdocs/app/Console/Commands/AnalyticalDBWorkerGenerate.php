<?php

namespace App\Console\Commands;

use App\AnalyticalDB;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AnalyticalDBWorkerGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytical-db:worker-generate {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates the zip report for workers';
    /**
     * @var AnalyticalDB
     */
    private $analyticalDB;

    /**
     * Create a new command instance.
     *
     * @param AnalyticalDB $analyticalDB
     */
    public function __construct(AnalyticalDB $analyticalDB)
    {
        parent::__construct();
        $this->analyticalDB = $analyticalDB;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::parse($this->argument('date'));
        app(AnalyticalDB::class)->workerZipGenerate($date);
    }
}
