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
        $fieldTypes = collect([ 'text', 'date', 'select', 'yes_no' ]);

        Collection::times(20, function ($number) use($questionTypes, $fieldTypes) {
            factory(App\Question::class)->create([
                'number' => $number,
                'question_type_uuid' => $questionTypes->where('slug', 'establishment')->first()->uuid,
                'field' => str_random(5),
                'field_type' => $fieldTypes->random(),
                'order' => $number
            ]);
        });

        Collection::times(20, function ($number) use($questionTypes, $fieldTypes) {
            factory(App\Question::class)->create([
                'number' => $number,
                'question_type_uuid' => $questionTypes->where('slug', 'worker')->first()->uuid,
                'field' => str_random(5),
                'field_type' => $fieldTypes->random(),
                'order' => $number
            ]);
        });
    }
}
