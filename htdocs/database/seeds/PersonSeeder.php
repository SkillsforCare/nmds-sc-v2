<?php

use App\Establishment;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $establishment = Establishment::first();

        $person = factory(App\Person::class)->create([
            'establishment_id' => $establishment->id,
            'first_name' => 'Victoria',
            'last_name' => 'Garnett',
            'email' => 'Victoria.Garnett@skillsforcare.org.uk'
        ]);
        $person->user()->save(factory(App\User::class)->make([
            'username' => 'vgarnett',
            'password' => bcrypt('secret')
        ]));

    }
}
