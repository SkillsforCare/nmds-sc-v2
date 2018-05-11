<?php

use App\Person;
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

        $people = Person::get();

        Collection::times(20, function ($number) use($questionTypes, $people) {

            $question = factory(App\Question::class)->create([
                'number' => $number,
                'question_type_uuid' => $questionTypes->where('slug', 'establishment')->first()->uuid,
                'field' => str_random(5),
                'order' => $number
            ]);


            // For each person, answer three questions.
            if($number < 4 ) {
                $people->each(function($person) use($question) {

                    $answer = factory(App\Answer::class)->make([
                        'person_uuid' => $person->uuid
                    ]);


                    if($question->field_type == 'select') {
                        $answer = factory(App\Answer::class)->make([ 'person_uuid' => $person->uuid, 'answer' => collect($question->options)->random()['value'] ]);
                    }

                    if($question->field_type == 'date') {
                        $answer = factory(App\Answer::class)->make([ 'person_uuid' => $person->uuid, 'answer' => \Carbon\Carbon::now()->toDateString() ]);
                    }

                    if($question->field_type == 'yes_no') {

                        $options = collect([
                            [ 'text' => 'Yes', 'value' => 'yes' ],
                            [ 'text' => 'No', 'value' => 'no' ]
                        ])->random();

                        $answer = factory(App\Answer::class)->make([ 'person_uuid' => $person->uuid, 'answer' => $options['value'], 'text' => $options['text'] ]);
                    }

                    $question->answer($person)->save($answer);

                });
            }
        });

        Collection::times(20, function ($number) use($questionTypes, $people) {

            $question = factory(App\Question::class)->create([
                'number' => $number,
                'question_type_uuid' => $questionTypes->where('slug', 'worker')->first()->uuid,
                'field' => str_random(5),
                'order' => $number
            ]);

            // For each person, answer three questions.
            if($number < 4 ) {
                $people->each(function($person) use($question) {

                    $answer = factory(App\Answer::class)->make([
                        'person_uuid' => $person->uuid
                    ]);


                    if($question->field_type == 'select') {
                        $answer = factory(App\Answer::class)->make([ 'person_uuid' => $person->uuid, 'answer' => collect($question->options)->random()['value'] ]);
                    }

                    if($question->field_type == 'date') {
                        $answer = factory(App\Answer::class)->make([ 'person_uuid' => $person->uuid, 'answer' => \Carbon\Carbon::now()->toDateString() ]);
                    }

                    if($question->field_type == 'yes_no') {

                        $options = collect([
                            [ 'text' => 'Yes', 'value' => 'yes' ],
                            [ 'text' => 'No', 'value' => 'no' ]
                        ])->random();

                        $answer = factory(App\Answer::class)->make([ 'person_uuid' => $person->uuid, 'answer' => $options['value'], 'text' => $options['text'] ]);
                    }

                    $question->answer($person)->save($answer);

                });
            }
        });

    }
}
