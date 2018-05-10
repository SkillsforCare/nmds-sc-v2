<?php

use App\QuestionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionTypes = QuestionType::get();


        Collection::times(20, function ($number) use($questionTypes) {

            $question = factory(App\Question::class)->create([
                'number' => $number,
                'question_type_uuid' => $questionTypes->where('slug', 'establishment')->first()->uuid,
                'field' => str_random(5),
                'order' => $number
            ]);

            // Randomly answer some and if a type of select, random one of the options.
            if(rand(1,5) == 3)
                $question->answer()->save(factory(App\Answer::class)->make());

        });

        Collection::times(20, function ($number) use($questionTypes) {

            $question = factory(App\Question::class)->create([
                'number' => $number,
                'question_type_uuid' => $questionTypes->where('slug', 'worker')->first()->uuid,
                'field' => str_random(5),
                'order' => $number
            ]);

            // Randomly answer some and if a type of select, random one of the options.
            if(rand(1,3) == 3) {

                $answer = factory(App\Answer::class)->make();

                if($question->field_type == 'select') {
                    $answer = factory(App\Answer::class)->make([ 'answer' => collect($question->options)->random()['value'] ]);
                }

                if($question->field_type == 'date') {
                    $answer = factory(App\Answer::class)->make([ 'answer' => \Carbon\Carbon::now()->toDateString() ]);
                }

                if($question->field_type == 'yes_no') {

                    $options = collect([
                        [ 'text' => 'Yes', 'value' => 'yes' ],
                        [ 'text' => 'No', 'value' => 'no' ]
                    ])->random();

                    $answer = factory(App\Answer::class)->make([ 'answer' => $options['value'], 'text' => $options['text'] ]);
                }

                $question->answer()->save($answer);
            }
        });
    }
}
