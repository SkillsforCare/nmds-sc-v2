<?php

use App\Establishment;
use App\Question;
use App\WorkerQuestionAnswer;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class UATUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect(
            [
                [
                    'username' => 'testuser1',
                    'first_name' => 'Test',
                    'last_name' => 'User 1',
                    'email' => 'testuser1@example.org'
                ],
                [
                    'username' => 'testuser2',
                    'first_name' => 'Test',
                    'last_name' => 'User 2',
                    'email' => 'testuser2@example.org'
                ],
                [
                    'username' => 'testuser3',
                    'first_name' => 'Test',
                    'last_name' => 'User 3',
                    'email' => 'testuser3@example.org'
                ],
                [
                    'username' => 'testuser4',
                    'first_name' => 'Test',
                    'last_name' => 'User 4',
                    'email' => 'testuser4@example.org'
                ],
                [
                    'username' => 'testuser5',
                    'first_name' => 'Test',
                    'last_name' => 'User 5',
                    'email' => 'testuser5@example.org'
                ]
            ]);

        $questions = Question::whereIn('field', ['UNIQUEWORKERID', 'MAINJOBROLE'])->get();

        $users->each(function($user) use($questions) {
            $establishment = factory(Establishment::class)->create();

            $person = factory(App\Person::class)->create([
                'establishment_id' => $establishment->id,
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email']
            ]);
            $person->user()->save(factory(App\User::class)->make([
                'username' => $user['username'],
                'password' => bcrypt('secret')
            ]));

            $person->user->assignRole('edit-user');

            factory(App\Worker::class, 20)->create([
                'establishment_id' => $establishment->id
            ])->each(function ($worker) use($questions) {

                $faker = app(Faker::class);

                // ID
                $identifier = $questions->where('field', 'UNIQUEWORKERID')->first();
                $id = app(WorkerQuestionAnswer::class)->create([
                    'question_id' => $identifier->id,
                    'worker_id' => $worker->id,
                    'answer' => $faker->firstName . ' ' . $faker->lastName,
                    'text' => $identifier->question,
                    'submitted_at' => now()->toDateTimeString()
                ]);

                // Job
                $jobrole = $questions->where('field', 'MAINJOBROLE')->first();

                $job = collect($jobrole->options)->where('value', '!=', null)->random();

                $job = app(WorkerQuestionAnswer::class)->create([
                    'question_id' => $jobrole->id,
                    'worker_id' => $worker->id,
                    'answer' =>  $job['value'],
                    'text' => $job['text'],
                    'submitted_at' => now()->toDateTimeString()
                ]);

                // Save meta;

                $meta = $worker->meta;

                $meta['MAINJOBROLE'] = $job->text;
                $meta['UNIQUEWORKERID'] = $id->answer;

                $worker->meta = $meta;

                // Randomly assign an 'unfinished' record
                $number = rand(1,10);

                if($number == 2)
                    $worker->finished_adding_at = now();

                $worker->save();
            });
        });
    }
}
