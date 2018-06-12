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
                        $answer = '';

                        if ($question->field_type === 'select' or
                            $question->field_type === 'select-search' or
                            $question->field_type === 'radio-list') {
                            $answer = collect(config('lookups.' . strtolower($question->field)))
                                ->random()['value'];
                        }

                        if($question->field_type === 'text') {
                            if($question->field === 'UNIQUEWORKERID')
                            {
                                $answer = $faker->firstName . ' ' . $faker->lastName;
                                $text = $answer;
                            }
                        }

                        $text = $question->text_value($text);
                        $worker->saveMetaData($question->field, $answer, $text);

                        $date = $now;
                        $day = rand(1, 28);
                        $date->day = $day;
                        $date->hour = 0;
                        $date->minute = 0;
                        $date->second = 0;
                    });

                    $randomQuestions = App\Question::inCategory('worker')
                        ->whereNull('mandatory_at')
                        ->inRandomOrder()->take(17)->get();

                    $faker = app(Faker::class);

                    $randomQuestions->each(function($question) use ($worker, $faker, $now) {

                        $text = '';
                        $answer = '';

                        if ($question->field_type === 'select' or
                            $question->field_type === 'select-search' or
                            $question->field_type === 'radio-list') {
                            $text = collect(config('lookups.' . strtolower($question->field)))
                                ->random()['value'];
                        }


                        if ($question->field_type === 'date' or $question->field === 'DOB') {
                            $now = now()->subYear(rand(18, 40));
                            $answer = $now->toDateString();
                            $text = $now->format('d/m/Y');
                        }

                        if($question->field_type === 'text') {
                            if($question->field === 'UNIQUEWORKERID')
                            {
                                $answer = $faker->firstName . ' ' . $faker->lastName;
                                $text = $answer;
                            }
                            else {
                                $answer = $faker->sentence;
                                $text =  $answer;
                            }
                        }

                        $text = $question->text_value($text);
                        $worker->saveMetaData($question->field, $answer, $text);

                        $date = $now;
                        $day = rand(1, 28);
                        $date->day = $day;
                        $date->hour = 0;
                        $date->minute = 0;
                        $date->second = 0;
                    });
                });
            });

            \Artisan::call('analytical-db:worker-generate', [ 'date' => $now->toDateTimeString() ]);

        });
    }
}
