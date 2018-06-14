<?php

use App\QuestionCategory;
use App\QuestionSection;
use Illuminate\Database\Seeder;

class EstablishmentQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->toDateTimeString();

        $category = QuestionCategory::where('slug', 'establishment')->first();
        $sections = QuestionSection::get();

        // Establishment...

        // Details
        $details = $sections->where('slug', 'establishment-details')->first();

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'CQC Regulated',
            'question' => 'Are you regulated by CQC?',
            'help_text' => null,
            'field' => 'REGTYPE',
            'field_type' => 'radio-list',
            'validation' => 'nullable',
            'order' => 1,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Postcode',
            'question' => 'What is the postcode of your establishment?',
            'help_text' => null,
            'field' => 'POSTCODE',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 2,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Location ID',
            'question' => 'Please select your location ID:',
            'help_text' => null,
            'field' => 'LOCATIONID',
            'field_type' => 'select',
            'validation' => 'nullable',
            'order' => 3,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Provider ID',
            'question' => 'Enter provider ID',
            'help_text' => null,
            'field' => 'PROVNUM',
            'field_type' => 'text',
            'validation' => null,
            'order' => 3,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Establishment name',
            'question' => 'What is the name of your establishment?',
            'help_text' => null,
            'field' => 'ESTNAME',
            'field_type' => 'text',
            'validation' => 'required|max:120',
            'order' => 4,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Address 1',
            'question' => 'What is the address of your establishment 1?',
            'help_text' => null,
            'field' => 'ADDRESS1',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 5,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Address 2',
            'question' => 'Enter address 2?',
            'help_text' => null,
            'field' => 'ADDRESS2',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 6,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Address 3',
            'question' => 'Enter address 3?',
            'help_text' => null,
            'field' => 'ADDRESS3',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 7,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Post Town',
            'question' => 'Enter post town?',
            'help_text' => null,
            'field' => 'POSTTOWN',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 8,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Telephone',
            'question' => 'What is the best number to call you on?',
            'help_text' => null,
            'field' => 'PHONE',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 9,
            'hidden_at' => null
        ]);

        // 17. Main service.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '17',
            'label' => 'Main service',
            'question' => 'What is the main service you provide?',
            'help_text' => null,
            'field' => 'MAINSERVICE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 10,
            'hidden_at' => null
        ]);

        // 18. Other service.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '17',
            'label' => 'Other services',
            'question' => 'Do you provide any other service?',
            'help_text' => null,
            'field' => 'OTHERSERVICE',
            'field_type' => 'radio-list',
            'validation' => 'nullable',
            'order' => 11,
            'hidden_at' => null
        ]);

        // 19. Other service list.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '18',
            'label' => 'Other services',
            'question' => 'What are the other services you provide?',
            'help_text' => null,
            'field' => 'ALLSERVICES',
            'field_type' => 'select',
            'validation' => 'nullable',
            'order' => 12,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Capacity',
            'question' => 'What is the capacity of your main service?',
            'help_text' => null,
            'field' => 'CAPACITY',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 13,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Utilisation',
            'question' => 'What is the current uptake of your main service?',
            'help_text' => null,
            'field' => 'UTILISATION',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 14,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Share information with CQC?',
            'question' => 'Can we share your information with the CQC?',
            'help_text' => null,
            'field' => 'PERMCQC',
            'field_type' => 'radio-list',
            'validation' => 'nullable',
            'order' => 15,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Share information with My NHS / NHS Choices?',
            'question' => 'Can we share your information with My NHS / NHS Choices?',
            'help_text' => null,
            'field' => 'PERMNHSC',
            'field_type' => 'radio-list',
            'validation' => 'nullable',
            'order' => 16,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Share information with your local authority?',
            'question' => 'Can we share your information with your local authority?',
            'help_text' => null,
            'field' => 'PERMLA',
            'field_type' => 'radio-list',
            'validation' => 'nullable',
            'order' => 17,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Selected local authorities.',
            'question' => 'Select all that apply',
            'help_text' => null,
            'field' => 'SHARELA',
            'field_type' => 'select',
            'validation' => 'nullable',
            'order' => 18,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Permanent and temporary staff',
            'question' => 'How many permanent and temporary staff do you have?',
            'help_text' => null,
            'field' => 'TOTALPERMTEMP',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 19,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Type of employer',
            'question' => 'What type of employer are you?',
            'help_text' => null,
            'field' => 'ESTTYPE',
            'field_type' => 'select',
            'validation' => 'nullable',
            'order' => 20,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Other type of employer',
            'question' => 'What type of employer are you?',
            'help_text' => null,
            'field' => 'OTHERTYPE',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 21,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Workers in each job role',
            'question' => 'Please enter the number of workers you have in each job role:',
            'help_text' => null,
            'field' => 'ALLJOBROLES',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 22,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Starters in the last 12 months',
            'question' => 'How many starters have you had in the last 12 months? (Permanent and temporary only)',
            'help_text' => null,
            'field' => 'TOTALSTARTERS',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 23,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Leavers in the last 12 months',
            'question' => 'How many workers have left in the last 12 months? (Permanent and temporary only)',
            'help_text' => null,
            'field' => 'TOTALLEAVERS',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 24,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Number of vacancies',
            'question' => 'How many vacancies do you currently have? (Permanent and temporary)',
            'help_text' => null,
            'field' => 'TOTALVACANCIES',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 25,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Job roles (starters)',
            'question' => 'What are their new job roles (starters)?',
            'help_text' => null,
            'field' => 'STARTERS',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 26,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Job roles (leavers)',
            'question' => 'What were their job roles (leavers)?',
            'help_text' => null,
            'field' => 'LEAVERS',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 27,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Job roles (vacancies)',
            'question' => 'What are these job roles (vacancies)?',
            'help_text' => null,
            'field' => 'VACANCIES',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 28,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Reasons workers left',
            'question' => 'Of workers that left, why did they leave?',
            'help_text' => null,
            'field' => 'REASONS',
            'field_type' => 'select',
            'validation' => 'nullable',
            'order' => 29,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Where did they go?',
            'question' => 'Where did they go?',
            'help_text' => null,
            'field' => 'DESTINATIONS',
            'field_type' => 'select',
            'validation' => 'nullable',
            'order' => 29,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'label' => 'Number of volunteers',
            'question' => 'How many volunteers do you have?',
            'help_text' => null,
            'field' => 'VOLUNTEERS',
            'field_type' => 'text',
            'validation' => 'nullable',
            'order' => 30,
            'hidden_at' => null
        ]);



    }
}