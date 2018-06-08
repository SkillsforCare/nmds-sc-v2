<?php

use Illuminate\Database\Seeder;

class AnalyticalDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\AnalyticalDB::class)->create([
            'type' => 'archive',
            'year' => 2018,
            'month' => 1,
        ]);

        factory(\App\AnalyticalDB::class)->create([
            'type' => 'archive',
            'year' => 2018,
            'month' => 2,
        ]);

        factory(\App\AnalyticalDB::class)->create([
            'type' => 'archive',
            'year' => 2018,
            'month' => 3,
        ]);

        factory(\App\AnalyticalDB::class)->create([
            'type' => 'archive',
            'year' => 2018,
            'month' => 4,
        ]);

        factory(\App\AnalyticalDB::class)->create([
            'type' => 'archive',
            'year' => 2018,
            'month' => 5,
        ]);
    }
}
