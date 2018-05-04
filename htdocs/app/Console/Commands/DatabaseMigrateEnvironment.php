<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseMigrateEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:migrate-environment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command migrates the database based on the applications environment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(app()->environment(['local', 'development', 'alpha'])) {
            $this->call('migrate:fresh');
            $this->call('db:seed');
        }
    }
}
