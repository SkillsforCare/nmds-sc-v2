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


            // Answer the identifier and job_role questions and apply them to
            // the worker's meta fields.

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

            $job = collect($jobrole->options)->random();

            $job = app(WorkerQuestionAnswer::class)->create([
                'question_id' => $jobrole->id,
                'worker_id' => $worker->id,
                'answer' =>  $job['value'],
                'text' => $job['text'],
                'submitted_at' => now()->toDateTimeString()
            ]);

            // Save meta;

            $meta = $worker->meta;

            $meta['jobrole'] = $job->text;
            $meta['identifier'] = $id->answer;

            $worker->meta = $meta;

            // Randomly assign an 'unfinished' record
            $number = rand(1,3);

            if($number == 2)
                $worker->finished_adding_at = now();

            $worker->save();
        });
    }
}
