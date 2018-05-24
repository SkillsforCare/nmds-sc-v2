<?php

use App\QuestionCategory;
use App\QuestionGroup;
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
        $groups = QuestionGroup::get();

        // Worker...

        // Personnel
        $personnel =  $sections->where('slug', 'personal-details')->first();

        // 31.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'basic-details')->first()->id,
            'number' => '31',
            'label' => 'Name / Worker ID',
            'question' => 'Please provide an identifier for this worker.',
            'help_text' => null,
            'field' => 'UNIQUEWORKERID',
            'field_type' => 'text',
            'validation' => 'required|max:50',
            'order' => 1,
            'hidden_at' => null,
            'mandatory_at' => $now
        ]);

        // 56-1.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'basic-details')->first()->id,
            'number' => '56-1',
            'label' => 'Parental Leave',
            'question' => 'Is this worker on parental leave?',
            'help_text' => null,
            'field' => 'PARENTALLEAVE',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 2,
            'hidden_at' => null
        ]);

        // 32.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'basic-details')->first()->id,
            'number' => '32',
            'label' => 'NI Number',
            'question' => 'What is the national insurance number of this worker?',
            'help_text' => null,
            'field' => 'NINUMBER',
            'field_type' => 'text',
            'validation' => 'ni_number',
            'order' => 3,
            'hidden_at' => null
        ]);

        // 33.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'basic-details')->first()->id,
            'number' => '33',
            'label' => 'Postcode',
            'question' => 'What is the home postcode of this worker?',
            'help_text' => null,
            'field' => 'POSTCODE',
            'field_type' => 'text',
            'validation' => '',
            'order' => 4,
            'hidden_at' => null
        ]);

        // 34.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'basic-details')->first()->id,
            'number' => '34',
            'label' => 'Date of Birth',
            'question' => 'What is the date of birth of this worker?',
            'help_text' => null,
            'field' => 'DOB',
            'field_type' => 'date',
            'validation' => 'sometimes|date|age_between',
            'order' => 5,
            'hidden_at' => null
        ]);

        // 35.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'basic-details')->first()->id,
            'number' => '35',
            'label' => 'Gender Identity',
            'question' => 'What is the gender identity of this worker?',
            'help_text' => null,
            'field' => 'GENDER',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 6,
            'hidden_at' => null
        ]);

        // 36.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'disability')->first()->id,
            'number' => '36',
            'label' => 'Disability Identification',
            'question' => 'Has this worker identified as having a disability?',
            'help_text' => null,
            'field' => 'DISABLED',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 7,
            'hidden_at' => null
        ]);

        // 37.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'ethnicity')->first()->id,
            'number' => '37',
            'label' => 'Ethnic Identity',
            'question' => 'What is the ethnic identity of this worker?',
            'help_text' => null,
            'field' => 'ETHNICITY',
            'field_type' => 'select',
            'validation' => null,
            'order' => 8,
            'hidden_at' => null
        ]);

        // 38.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'ethnicity')->first()->id,
            'number' => '38',
            'label' => 'Nationality',
            'question' => 'What is the nationality of this worker?',
            'help_text' => null,
            'field' => 'NATIONALITY',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 9,
            'hidden_at' => null
        ]);

        // 39.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'ethnicity')->first()->id,
            'number' => '39',
            'label' => 'British Citizenship?',
            'question' => 'Does this worker hold British citizenship?',
            'help_text' => null,
            'field' => 'BRITISHCITIZENSHIP',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 10,
            'hidden_at' => $now
        ]);

        // 40.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'ethnicity')->first()->id,
            'number' => '40',
            'label' => 'Nationality (not British)',
            'question' => 'If not British, what is this worker\'s nationality?',
            'help_text' => null,
            'field' => 'NATIONALITY-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 11,
            'hidden_at' => $now
        ]);

        // 41.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'born-in-uk')->first()->id,
            'number' => '41',
            'label' => 'Born in UK?',
            'question' => 'Was this worker born in the UK?',
            'help_text' => null,
            'field' => 'COUNTRYOFBIRTH',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 12,
            'hidden_at' => $now
        ]);

        // 42.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'born-in-uk')->first()->id,
            'number' => '42',
            'label' => 'Country of Birth',
            'question' => 'What country was this worker born in?',
            'help_text' => null,
            'field' => 'COUNTRYOFBIRTH-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 13,
            'hidden_at' => $now
        ]);

        // 43.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $personnel->id,
            'question_group_id' => $groups->where('slug', 'born-in-uk')->first()->id,
            'number' => '43',
            'label' => 'Arrived in UK',
            'question' => 'What year did this worker arrive in the UK?',
            'help_text' => null,
            'field' => 'YEAROFENTRY',
            'field_type' => 'text',
            'validation' => null,
            'order' => 14,
            'hidden_at' => $now
        ]);


        // Employment
        $employment =  $sections->where('slug', 'employment-details')->first();

        // 44
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'ethnicity')->first()->id,
            'number' => '44',
            'label' => 'Employment Status',
            'question' => 'What is the employment status of this worker?',
            'help_text' => null,
            'field' => 'EMPLSTATUS',
            'field_type' => 'select',
            'validation' => null,
            'order' => 1,
            'hidden_at' => null
        ]);

        // 45
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '45',
            'label' => 'Date started main job',
            'question' => 'Date the worker started in their main job.',
            'help_text' => null,
            'field' => 'STARTDATE',
            'field_type' => 'date',
            'validation' => null,
            'order' => 2,
            'hidden_at' => null
        ]);

        // 46
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '46',
            'label' => 'Recruited from',
            'question' => 'Where was this worker recruited from?',
            'help_text' => null,
            'field' => 'RECSOURCE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 3,
            'hidden_at' => null
        ]);

        // 47
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '47',
            'label' => 'Date started in the adult social care sector',
            'question' => 'When did this worker start working in the adult social care sector?',
            'help_text' => null,
            'field' => 'STARTINSECT',
            'field_type' => 'date',
            'validation' => null,
            'order' => 4,
            'hidden_at' => null
        ]);


        // 48.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '48',
            'label' => 'Main Job Role',
            'question' => 'What is the main job role of this worker?',
            'help_text' => null,
            'field' => 'MAINJOBROLE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 5,
            'hidden_at' => null,
            'mandatory_at' => $now
        ]);

        // 49.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '49',
            'label' => 'Additional Job Roles',
            'question' => 'Does this worker have any additional job roles?',
            'help_text' => null,
            'field' => 'OTHERJOBROLE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 6,
            'hidden_at' => null
        ]);

        // 50.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '50',
            'label' => 'Zero-hours contract',
            'question' => 'Is this worker on a zero-hours contract?',
            'help_text' => null,
            'field' => 'ZEROHRCONT',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 7,
            'hidden_at' => null
        ]);

        // 51.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '51',
            'label' => 'Hours contracted to work per week',
            'question' => 'How many hours is this worker contracted to work per week?',
            'help_text' => null,
            'field' => 'CONTHOURS',
            'field_type' => 'text',
            'validation' => null,
            'order' => 8,
            'hidden_at' => null
        ]);

        // 52.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '52',
            'label' => 'Additional hours last week',
            'question' => 'What additional hours did this worker complete in the last week?',
            'help_text' => null,
            'field' => 'ADDLHOURS',
            'field_type' => 'text',
            'validation' => null,
            'order' => 9,
            'hidden_at' => null
        ]);

        // 52-1.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '52-1',
            'label' => 'Average hours per week',
            'question' => 'What are the average hours per week for this worker?',
            'help_text' => null,
            'field' => 'AVHOURS',
            'field_type' => 'text',
            'validation' => null,
            'order' => 10,
            'hidden_at' => null
        ]);

        // 53.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'employment-status')->first()->id,
            'number' => '53',
            'label' => 'Employment Status',
            'question' => 'This worker is:',
            'help_text' => null,
            'field' => 'FULLTIME',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 11,
            'hidden_at' => null
        ]);

        // 54.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'pay')->first()->id,
            'number' => '54',
            'label' => 'Salary interval',
            'question' => 'How would you like to record this worker\'s pay?',
            'help_text' => null,
            'field' => 'SALARYINT',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 12,
            'hidden_at' => null
        ]);

        // 55.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'pay')->first()->id,
            'number' => '55',
            'label' => 'Salary / Hourly rate',
            'question' => 'Please enter this worker\'s (annual salary/hourly rate):',
            'help_text' => null,
            'field' => 'SALARY',
            'field_type' => 'text',
            'validation' => null,
            'order' => 13,
            'hidden_at' => null
        ]);

        // 56.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $employment->id,
            'question_group_id' => $groups->where('slug', 'pay')->first()->id,
            'number' => '56',
            'label' => 'Days sick in the last 12 months',
            'question' => 'How many sickness days has this worker taken in the last 12 months?',
            'help_text' => null,
            'field' => 'DAYSSICK',
            'field_type' => 'text',
            'validation' => null,
            'order' => 14,
            'hidden_at' => null
        ]);



        // Learning and dev.
        $learning =  $sections->where('slug', 'learning-development')->first();

        // 59.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'question_group_id' => $groups->where('slug', 'care-certificate')->first()->id,
            'number' => '59',
            'label' => 'Engaged in Care Certificate',
            'question' => 'Has this worker engaged in the Care Certificate?',
            'help_text' => null,
            'field' => 'CARECERT',
            'field_type' => 'select',
            'validation' => null,
            'order' => 1,
            'hidden_at' => null
        ]);

        // 60.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'question_group_id' => $groups->where('slug', 'care-certificate')->first()->id,
            'number' => '60',
            'label' => 'Date achieved',
            'question' => 'Date achieved:',
            'help_text' => null,
            'field' => 'CARECERTDATE',
            'field_type' => 'date',
            'validation' => 'date',
            'order' => 2,
            'hidden_at' => $now
        ]);

        // 62.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'question_group_id' => $groups->where('slug', 'qualifications')->first()->id,
            'number' => '62',
            'label' => 'Qualification relevant to social care',
            'question' => 'Does this worker hold a qualification relevant to social care?',
            'help_text' => null,
            'field' => 'SCQUAL',
            'field_type' => 'select',
            'validation' => null,
            'order' => 3,
            'hidden_at' => null
        ]);

        // 63.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'question_group_id' => $groups->where('slug', 'qualifications')->first()->id,
            'number' => '63',
            'label' => 'Highest social care qualification',
            'question' => 'What is their highest level of social care qualification?',
            'help_text' => null,
            'field' => 'SCQUAL-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 4,
            'hidden_at' => $now
        ]);

        // 64.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'question_group_id' => $groups->where('slug', 'qualifications')->first()->id,
            'number' => '64',
            'label' => 'Non-social care qualifications',
            'question' => 'Does this worker hold any non-social care qualifications?',
            'help_text' => null,
            'field' => 'NONSCQUAL',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 5,
            'hidden_at' => null
        ]);

        // 65.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $learning->id,
            'question_group_id' => $groups->where('slug', 'qualifications')->first()->id,
            'number' => '65',
            'label' => 'Highest non-social care qualification?',
            'question' => 'What is their highest level of non-social care qualification?',
            'help_text' => null,
            'field' => 'NONSCQUAL-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 6,
            'hidden_at' => $now
        ]);

        // Training
        $training =  $sections->where('slug', 'training')->first();

        // 67-1.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'question_group_id' => $groups->where('slug', 'training')->first()->id,
            'number' => '67-1',
            'label' => 'Training',
            'question' => 'Do you want to add training for this worker?',
            'help_text' => null,
            'field' => 'TRAINING',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 1,
            'hidden_at' => null
        ]);

        // 67-2.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-2',
            'label' => 'Select category',
            'question' => 'Select category',
            'help_text' => null,
            'field' => 'TRAINING-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 2,
            'hidden_at' => $now
        ]);

        // 67-2.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-3',
            'label' => 'Name of training',
            'question' => 'Name of training',
            'help_text' => null,
            'field' => 'TRAININGNAME',
            'field_type' => 'text',
            'validation' => null,
            'order' => 3,
            'hidden_at' => $now
        ]);

        // 67-3.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-3',
            'label' => 'Date completed:',
            'question' => 'Date completed:',
            'help_text' => null,
            'field' => 'TRAININGDATECOMPLETED',
            'field_type' => 'date',
            'validation' => null,
            'order' => 4,
            'hidden_at' => $now
        ]);

        // 67-3.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-4',
            'label' => 'Expiry date:',
            'question' => 'Expiry date:',
            'help_text' => null,
            'field' => 'TRAININGDATEEXPIRY',
            'field_type' => 'date',
            'validation' => null,
            'order' => 5,
            'hidden_at' => $now
        ]);

        // 67-4.
        factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $training->id,
            'number' => '67-4',
            'label' => 'Accredited?',
            'question' => 'Is this training accredited?',
            'help_text' => null,
            'field' => 'TRAININGACCREDITED',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 6,
            'hidden_at' => $now
        ]);
    }
}