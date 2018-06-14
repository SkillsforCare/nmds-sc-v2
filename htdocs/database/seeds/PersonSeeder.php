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

        $person->user->assignRole('edit-user');


        $person = factory(App\Person::class)->create([
            'establishment_id' => null,
            'first_name' => 'Jess',
            'last_name' => 'Arkesden',
            'email' => 'Jess.Arkesden@skillsforcare.org.uk'
        ]);
        $person->user()->save(factory(App\User::class)->make([
            'username' => 'analystjess',
            'password' => bcrypt('secret')
        ]));

        $person->user->assignRole('analyst-user');

    }
}
