<?php

use App\Establishment;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $establishment = Establishment::first();

        factory(App\Worker::class, 20)->create([
            'establishment_id' => $establishment->id
        ]);
    }
}
