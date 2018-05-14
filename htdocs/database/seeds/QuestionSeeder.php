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
                'question_type_id' => $questionTypes->where('slug', 'establishment')->first()->id,
                'field' => str_random(5),
                'order' => $number
            ]);


            // For each person, answer three questions.
            if($number < 4 ) {
                $people->each(function($person) use($question) {

                    $answer = factory(App\Answer::class)->make([
                        'person_id' => $person->id
                    ]);


                    if($question->field_type == 'select') {
                        $option = collect($question->options)->random();
                        $answer = factory(App\Answer::class)->make([ 'person_id' => $person->id, 'answer' => $option['value'], 'text' => $option['text'] ]);
                    }

                    if($question->field_type == 'date') {
                        $answer = factory(App\Answer::class)->make([ 'person_id' => $person->id, 'answer' => now()->toDateString(), 'text' => now()->format('d/m/Y') ]);
                    }

                    if($question->field_type == 'yes_no') {

                        $options = collect([
                            [ 'text' => 'Yes', 'value' => 'yes' ],
                            [ 'text' => 'No', 'value' => 'no' ]
                        ])->random();

                        $answer = factory(App\Answer::class)->make([ 'person_id' => $person->id, 'answer' => $options['value'], 'text' => $options['text'] ]);
                    }

                    $question->answer($person)->save($answer);

                });
            }
        });

        Collection::times(20, function ($number) use($questionTypes, $people) {

            $question = factory(App\Question::class)->create([
                'number' => $number,
                'question_type_id' => $questionTypes->where('slug', 'worker')->first()->id,
                'field' => str_random(5),
                'order' => $number
            ]);

            // For each person, answer three questions.
            if($number < 4 ) {
                $people->each(function($person) use($question) {

                    $answer = factory(App\Answer::class)->make([
                        'person_id' => $person->id
                    ]);

                    if($question->field_type == 'select') {
                        $option = collect($question->options)->random();
                        $answer = factory(App\Answer::class)->make([ 'person_id' => $person->id, 'answer' => $option['value'], 'text' => $option['text'] ]);
                    }

                    if($question->field_type == 'date') {
                        $answer = factory(App\Answer::class)->make([ 'person_id' => $person->id, 'answer' => \Carbon\Carbon::now()->toDateString(), 'text' => now()->format('d/m/Y') ]);
                    }

                    if($question->field_type == 'yes_no') {

                        $options = collect([
                            [ 'text' => 'Yes', 'value' => 'yes' ],
                            [ 'text' => 'No', 'value' => 'no' ]
                        ])->random();

                        $answer = factory(App\Answer::class)->make([ 'person_id' => $person->id, 'answer' => $options['value'], 'text' => $options['text'] ]);
                    }

                    $question->answer($person)->save($answer);

                });
            }
        });

    }
}
