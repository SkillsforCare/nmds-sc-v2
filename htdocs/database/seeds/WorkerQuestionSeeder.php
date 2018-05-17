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
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '31',
            'question' => 'Please provide an identifier for this worker.',
            'help_text' => null,
            'field' => 'UNIQUEWORKERID',
            'field_type' => 'text',
            'options' => null,
            'validation' => 'required|max:50',
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
            'validation' => 'required|date|age_between14-100',
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
            'field' => 'MAINJOBROLE',
            'field_type' => 'select',
            'options' => config('lookups.mainjobrole'),
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
            'options' => config('lookups.carecert'),
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
            'field' => 'SCQUAL',
            'field_type' => 'select',
            'options' => config('lookups.scqual'),
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
            'field' => 'SCQUAL-1',
            'field_type' => 'select',
            'options' => config('lookups.scqual-1'),
            'validation' => 'required',
            'order' => 3
        ]);



    }
}