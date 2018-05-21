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
        $now = now()->toDateTimeString();

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
            'validation' => 'required|max:50',
            'order' => 1
        ]);

        // 32.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '32',
            'question' => 'What is the national insurance number of this worker?',
            'help_text' => null,
            'field' => 'NINUMBER',
            'field_type' => 'text',
            'validation' => 'ni_number',
            'order' => 2
        ]);

        // 33.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '33',
            'question' => 'What is the home postcode of this worker?',
            'help_text' => null,
            'field' => 'POSTCODE',
            'field_type' => 'text',
            'validation' => '',
            'order' => 3
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
            'validation' => 'sometimes|date|age_between',
            'order' => 4
        ]);

        // 35.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '35',
            'question' => 'What is the gender identity of this worker?',
            'help_text' => null,
            'field' => 'GENDER',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 5
        ]);

        // 36.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '36',
            'question' => 'Has this worker identified as having a disability?',
            'help_text' => null,
            'field' => 'DISABLED',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 6
        ]);

        // 37.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '37',
            'question' => 'What is the ethnic identity of this worker?',
            'help_text' => null,
            'field' => 'ETHNICITY',
            'field_type' => 'select',
            'validation' => null,
            'order' => 7
        ]);

        // 38.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '38',
            'question' => 'What is the nationality of this worker?',
            'help_text' => null,
            'field' => 'NATIONALITY',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 8
        ]);

        // 39.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '39',
            'question' => 'Does this worker hold British citizenship?',
            'help_text' => null,
            'field' => 'BRITISHCITIZENSHIP',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 8
        ]);

        // 40.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '40',
            'question' => 'What is this worker\'s nationality?',
            'help_text' => null,
            'field' => 'NATIONALITY-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 9
        ]);

        // 41.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '41',
            'question' => 'Was this worker born in the UK?',
            'help_text' => null,
            'field' => 'COUNTRYOFBIRTH',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 10
        ]);

        // 42.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '42',
            'question' => 'What country was this worker born in?',
            'help_text' => null,
            'field' => 'COUNTRYOFBIRTH-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 11
        ]);

        // 43.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'number' => '43',
            'question' => 'What year did this worker arrive in the UK?',
            'help_text' => null,
            'field' => 'YEAROFENTRY',
            'field_type' => 'text',
            'validation' => null,
            'order' => 12
        ]);


        // Employment
        $employment =  $sections->where('slug', 'employment-details')->first();

        // 44
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '44',
            'question' => 'What is the employment status of this worker?',
            'help_text' => null,
            'field' => 'EMPLSTATUS',
            'field_type' => 'select',
            'validation' => null,
            'order' => 1
        ]);

        // 45
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '45',
            'question' => 'Date the worker started in their main job.',
            'help_text' => null,
            'field' => 'STARTDATE',
            'field_type' => 'date',
            'validation' => null,
            'order' => 2
        ]);

        // 46
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '46',
            'question' => 'Where was this worker recruited from?',
            'help_text' => null,
            'field' => 'RECSOURCE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 3
        ]);

        // 47
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '47',
            'question' => 'When did this worker start working in the adult social care sector?',
            'help_text' => null,
            'field' => 'STARTINSECT',
            'field_type' => 'date',
            'validation' => null,
            'order' => 4
        ]);


        // 48.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '48',
            'question' => 'What is the main job role of this worker?',
            'help_text' => null,
            'field' => 'MAINJOBROLE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 5
        ]);

        // 49.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '49',
            'question' => 'Does this worker have any additional job roles?',
            'help_text' => null,
            'field' => 'OTHERJOBROLE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 6
        ]);

        // 50.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '50',
            'question' => 'Is this worker on a zero-hours contract?',
            'help_text' => null,
            'field' => 'ZEROHRCONT',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 7
        ]);

        // 51.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '51',
            'question' => 'How many hours is this worker contracted to work per week?',
            'help_text' => null,
            'field' => 'CONTHOURS',
            'field_type' => 'text',
            'validation' => null,
            'order' => 8
        ]);

        // 52.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '52',
            'question' => 'What additional hours did this worker complete in the last week?',
            'help_text' => null,
            'field' => 'ADDLHOURS',
            'field_type' => 'text',
            'validation' => null,
            'order' => 9
        ]);

        // 52-1.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '52-1',
            'question' => 'What are the average hours per week for this worker?',
            'help_text' => null,
            'field' => 'AVHOURS',
            'field_type' => 'text',
            'validation' => null,
            'order' => 10
        ]);

        // 53.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '53',
            'question' => 'This worker is:',
            'help_text' => null,
            'field' => 'FULLTIME',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 11
        ]);

        // 54.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '54',
            'question' => 'How would you like to record this worker\'s pay?',
            'help_text' => null,
            'field' => 'SALARYINT',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 12
        ]);

        // 55.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '55',
            'question' => 'Please enter this worker\'s (annual salary/hourly rate):',
            'help_text' => null,
            'field' => 'SALARY',
            'field_type' => 'text',
            'validation' => null,
            'order' => 13
        ]);

        // 56.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '56',
            'question' => 'How many sickness days has this worker taken in the last 12 months?',
            'help_text' => null,
            'field' => 'DAYSSICK',
            'field_type' => 'text',
            'validation' => null,
            'order' => 14
        ]);

        // 56-1.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'number' => '56-1',
            'question' => 'Is this worker on parental leave?',
            'help_text' => null,
            'field' => 'PARENTALLEAVE',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 15
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
            'validation' => null,
            'order' => 1
        ]);

        // 60.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'number' => '60',
            'question' => 'Date achieved:',
            'help_text' => null,
            'field' => 'CARECERTDATE',
            'field_type' => 'date',
            'validation' => 'date',
            'order' => 2
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
            'validation' => null,
            'order' => 3
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
            'validation' => null,
            'order' => 4
        ]);

        // 64.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'number' => '64',
            'question' => 'Does this worker hold any non-social care qualifications?',
            'help_text' => null,
            'field' => 'NONSCQUAL',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 5
        ]);

        // 65.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'number' => '65',
            'question' => 'What is their highest level of non-social care qualification?',
            'help_text' => null,
            'field' => 'NONSCQUAL-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 6
        ]);

        // Training
        $training =  $sections->where('slug', 'training')->first();

        // 67-1.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-1',
            'question' => 'Does this worker have any training?',
            'help_text' => null,
            'field' => 'TRAINING',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 1
        ]);

        // 67-2.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-2',
            'question' => 'Select category',
            'help_text' => null,
            'field' => 'TRAINING-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 2
        ]);

        // 67-2.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-3',
            'question' => 'Name of training',
            'help_text' => null,
            'field' => 'TRAININGNAME',
            'field_type' => 'text',
            'validation' => null,
            'order' => 3
        ]);

        // 67-3.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-3',
            'question' => 'Date completed:',
            'help_text' => null,
            'field' => 'TRAININGDATECOMPLETED',
            'field_type' => 'date',
            'validation' => null,
            'order' => 4
        ]);

        // 67-3.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-4',
            'question' => 'Expiry date:',
            'help_text' => null,
            'field' => 'TRAININGDATEEXPIRY',
            'field_type' => 'date',
            'validation' => null,
            'order' => 5
        ]);

        // 67-4.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-4',
            'question' => 'Is this training accredited?',
            'help_text' => null,
            'field' => 'TRAININGACCREDITED',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 6
        ]);
    }
}