<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstablishmentSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(WorkerSeeder::class);
    }
}
