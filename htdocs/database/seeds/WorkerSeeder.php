<?php

use App\Establishment;
use App\Question;
use App\QuestionAnswer;
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
        $questions = Question::whereIn('field', ['IDENTIFIER', 'JOBROLE'])->get();

        factory(App\Worker::class, 20)->create([
            'establishment_id' => $establishment->id
        ])->each(function ($worker) use($questions, $faker) {


            // Answer the identifier and job_role questions and apply them to
            // the worker's meta fields.

            // ID
            $identifier = $questions->where('field', 'IDENTIFIER')->first();

            $id = app(QuestionAnswer::class)->create([
                'question_id' => $identifier->id,
                'worker_id' => $worker->id,
                'answer' => $faker->firstName . ' ' . $faker->lastName,
                'text' => $identifier->question,
                'submitted_at' => now()->toDateTimeString()
            ]);

            // Job
            $jobrole = $questions->where('field', 'JOBROLE')->first();

            $job = collect($jobrole->options)->random();

            $job = app(QuestionAnswer::class)->create([
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

            $worker->save();
        });
    }
}
