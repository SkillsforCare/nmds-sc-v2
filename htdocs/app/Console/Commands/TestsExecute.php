<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestsExecute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs Dusk, Feature and Unit tests.';

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
        //config()->set('env', 'testing');

        if(app()->environment(['testing'])) {
            $this->call('migrate:fresh');
            $this->call('db:seed');
            $this->call('dusk');
            $this->call('tests:run');
        }

        //config()->set('env', 'local');

        return true;
    }
}
