<?php

use App\Establishment;
use App\Question;
use App\WorkerQuestionAnswer;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $establishment = Establishment::first();

        // Default answers.
        $questions = Question::whereIn('field', ['UNIQUEWORKERID', 'MAINJOBROLE'])->get();

        factory(App\Worker::class, 20)->create([
            'establishment_id' => $establishment->id
        ])->each(function ($worker) use($questions, $faker) {

            // Save meta;

            $meta = $worker->meta;

            $job = collect(config('lookups.mainjobrole'))->where('value', '!=', null)->random();
            $meta['MAINJOBROLE'] = [
                'answer' => $job['value'],
                'text' => $job['text']
            ];

            $name = $faker->firstName . ' ' . $faker->lastName;
            $meta['UNIQUEWORKERID'] = [
                'answer' => $name,
                'text' => $name
            ];


            if(rand(1,10) == 5) {
                $now = now()->subYear(rand(18,40));
                $meta['DOB'] = [
                    'answer' => $now->toDateString(),
                    'text' => $now->format('d/m/Y')
                ];
            }

            $worker->meta = $meta;

            // Randomly assign an 'unfinished' record
            $number = rand(1,3);

            if($number == 2)
                $worker->finished_adding_at = now();

            $worker->save();
        });
    }
}
