<?php

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
        $person = factory(App\Person::class)->create([
            'first_name' => 'Victoria',
            'last_name' => 'Garnett',
            'email' => 'Victoria.Garnett@skillsforcare.org.uk'
        ]);
        $person->user()->save(factory(App\User::class)->make([
            'username' => 'vgarnett',
            'password' => bcrypt('vgarnettsecret')
        ]));

        $person = factory(App\Person::class)->create([
            'first_name' => 'Richard',
            'last_name' => 'Bishop',
            'email' => 't_Richard.Bishop@skillsforcare.org.uk'
        ]);
        $person->user()->save(factory(App\User::class)->make([
            'username' => 'rbishop',
            'password' => bcrypt('rbishopsecret')
        ]));
    }
}
