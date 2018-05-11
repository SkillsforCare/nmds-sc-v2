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
        $people = [
            [
                'first_name' => 'Victoria',
                'last_name' => 'Garnett',
                'email' => 'Victoria.Garnett@skillsforcare.org.uk',
                'username' => 'vgarnett',
                'password' => 'vgarnettsecret'
            ],
            [
                'first_name' => 'Richard',
                'last_name' => 'Bishop',
                'email' => 't_Richard.Bishop@skillsforcare.org.uk',
                'username' => 'rbishop',
                'password' => 'rbishopsecret'
            ],
            [
                'first_name' => 'Jess',
                'last_name' => 'Arkesden',
                'email' => 'Jess.Arkesden@skillsforcare.org.uk',
                'username' => 'jarkesden',
                'password' => 'jarkesdensecret'
            ],
            [
                'first_name' => 'Will',
                'last_name' => 'Fenton',
                'email' => 'Will.Fenton@skillsforcare.org.uk',
                'username' => 'wfenton',
                'password' => 'wfentonsecret'
            ],
        ];

        collect($people)->each(function($person){
            factory(App\Person::class)->create([
                'first_name' => $person['first_name'],
                'last_name' => $person['last_name'],
                'email' => $person['email'],
            ])->user()->save(factory(App\User::class)->make([
                'username' => $person['username'],
                'password' => bcrypt($person['password'])
            ]));
        });
    }
}
