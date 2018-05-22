<?php

use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Establishment::class)->create([
            'name' => 'Rothley Meadows',
        ]);
    }
}
