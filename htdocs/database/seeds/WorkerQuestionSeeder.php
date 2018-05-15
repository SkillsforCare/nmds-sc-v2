<?php

use App\QuestionCategory;
use App\QuestionSection;
use Illuminate\Database\Seeder;

class WorkerQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = QuestionCategory::where('slug', 'worker')->first();
        $sections = QuestionSection::get();

        // Worker...

        // Personnel
        $personnel =  $sections->where('slug', 'personal-details')->first();

        // 31.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '31',
            'question' => 'Please provide an identifier for this worker.',
            'help_text' => null,
            'field' => 'IDENTIFIER',
            'field_type' => 'text',
            'options' => null,
            'validation' => 'required',
            'order' => 1
        ]);

        // 34.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '34',
            'question' => 'What is the date of birth of this worker?',
            'help_text' => null,
            'field' => 'DOB',
            'field_type' => 'date',
            'options' => null,
            'validation' => 'required|date',
            'order' => 2
        ]);

        // Employment
        $employment =  $sections->where('slug', 'employment')->first();

        // 48.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '48',
            'question' => 'What is the main job role of this worker?',
            'help_text' => null,
            'field' => 'JOBROLE',
            'field_type' => 'text',
            'options' => null,
            'validation' => 'required',
            'order' => 1
        ]);

        // Learning and dev.
        $learning =  $sections->where('slug', 'learning-development')->first();

        // 59.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'number' => '59',
            'question' => 'Has this worker engaged in the Care Certificate?',
            'help_text' => null,
            'field' => 'CARECERT',
            'field_type' => 'select',
            'options' => [
                [
                    'text' => 'Yes, completed',
                    'value' => 0
                ],
                [
                    'text' => 'Yes, in progress or partially completed',
                    'value' => 1
                ],
                [
                    'text' => 'No, not started',
                    'value' => 2
                ]
            ],
            'validation' => 'required',
            'order' => 1
        ]);

        // 62.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'number' => '62',
            'question' => 'Does this worker hold a qualification relevant to social care?',
            'help_text' => null,
            'field' => 'SOCIALCAREQUALIFICATION',
            'field_type' => 'select',
            'options' => [
                [
                    'text' => 'Yes',
                    'value' => 0
                ],
                [
                    'text' => 'No',
                    'value' => 1
                ],
                [
                    'text' => 'Not known',
                    'value' => 3
                ]
            ],
            'validation' => 'required',
            'order' => 2
        ]);

        // 63.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'number' => '63',
            'question' => 'What is their highest level of social care qualification?',
            'help_text' => null,
            'field' => 'HIGHESTLEVELSOCIALCAREQUALIFICATION',
            'field_type' => 'select',
            'options' => [
                [
                    'text' => 'Entry',
                    'value' => 0
                ],
                [
                    'text' => 'Level 1',
                    'value' => 1
                ],
                [
                    'text' => 'Level 2',
                    'value' => 2
                ],
                [
                    'text' => 'Level 8 and above',
                    'value' => 3
                ],
                [
                    'text' => 'Not known',
                    'value' => 4
                ]
            ],
            'validation' => 'required',
            'order' => 3
        ]);



    }
}