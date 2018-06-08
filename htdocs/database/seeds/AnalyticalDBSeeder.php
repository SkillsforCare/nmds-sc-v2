<?php

use App\Question;
use App\WorkerQuestionAnswer;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

class AnalyticalDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // To give a variety of data for the download zip downloads, have the seeders create 10 establishments,
        // each with 20 workers.
        // For each of the 20 workers, randomly answer 50% of the questions
        // and date stamp them over 5 month period Jan 2018 - May 2018.

        $monthsToBuild = collect([
            '2017-05-31 23:59:59',
            '2017-06-30 23:59:59',
            '2017-07-31 23:59:59',
            '2017-08-31 23:59:59',
            '2017-09-30 23:59:59',
            '2017-10-31 23:59:59',
            '2017-11-30 23:59:59',
            '2017-12-31 23:59:59',
            '2018-01-31 23:59:59',
            '2018-02-28 23:59:59',
            '2018-03-31 23:59:59',
            '2018-04-30 23:59:59',
            '2018-05-31 23:59:59'
        ]);

        $monthsToBuild->each(function($month) {

            $now = Carbon::parse($month);

            factory(App\Establishment::class, 2)->create()->each(function($establishment) use($now) {
                factory(App\Worker::class, 20)->create([
                    'establishment_id' => $establishment->id
                ])->each(function($worker) use($now) {
                    // Answer the mandatory questions.
                    $mandatory = App\Question::inCategory('worker')->mandatory()->get();

                    $faker = app(Faker::class);

                    $mandatory->each(function($question) use ($worker, $faker, $now) {

                        $text = '';
                        if ($question->field_type === 'select' or
                            $question->field_type === 'select-search' or
                            $question->field_type === 'radio-list') {
                            $text = collect(config('lookups.' . strtolower($question->field)))
                                ->random()['value'];
                        }

                        if($question->field_type === 'text') {
                            if($question->field === 'UNIQUEWORKERID')
                            {
                                $text = $faker->firstName . ' ' . $faker->lastName;
                            }
                        }

                        $answer = app(App\WorkerQuestionAnswer::class)->saveAnswer($question, [
                            'worker_id' => $worker->id,
                            'answer' => $text,
                        ]);

                        $date = $now;
                        $day = rand(1, 28);
                        $date->day = $day;
                        $date->hour = 0;
                        $date->minute = 0;
                        $date->second = 0;

                        $answer->submitted_at = $date->toDateTimeString();
                        $answer->created_at = $date->toDateTimeString();
                        $answer->updated_at = $date->toDateTimeString();
                        $answer->save();
                    });

                    $randomQuestions = App\Question::inCategory('worker')
                        ->whereNull('mandatory_at')
                        ->inRandomOrder()->take(17)->get();

                    $faker = app(Faker::class);

                    $randomQuestions->each(function($question) use ($worker, $faker, $now) {

                        $text = '';
                        if ($question->field_type === 'select' or
                            $question->field_type === 'select-search' or
                            $question->field_type === 'radio-list') {
                            $text = collect(config('lookups.' . strtolower($question->field)))
                                ->random()['value'];
                        }

                        if($question->field_type === 'text') {
                            if($question->field === 'UNIQUEWORKERID')
                            {
                                $text = $faker->firstName . ' ' . $faker->lastName;
                            }
                        }

                        $answer = app(App\WorkerQuestionAnswer::class)->saveAnswer($question, [
                            'worker_id' => $worker->id,
                            'answer' => $text,
                        ]);

                        $date = $now;
                        $day = rand(1, 28);
                        $date->day = $day;
                        $date->hour = 0;
                        $date->minute = 0;
                        $date->second = 0;

                        $answer->submitted_at = $date->toDateTimeString();
                        $answer->created_at = $date->toDateTimeString();
                        $answer->updated_at = $date->toDateTimeString();
                        $answer->save();
                    });
                });
            });

            \Artisan::call('analytical-db:worker-generate', [ 'date' => $now->toDateTimeString() ]);

        });


        // Jan 2018


        // Generate a CSV/ZIP report for January.

        /*
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
        */
    }
}
