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

        // 13.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '13',
            'question' => 'Are you regulated by CQC?',
            'help_text' => null,
            'field' => 'CQCREGULATED',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 1,
            'hidden_at' => null
        ]);

        // Postcode.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '13-1',
            'question' => 'What is the postcode of your establishment?',
            'help_text' => null,
            'field' => 'POSTCODE1',
            'field_type' => 'text',
            'validation' => null,
            'order' => 2,
            'hidden_at' => null
        ]);

        // 15. Location ID
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '15',
            'question' => 'Please select your CQC Location ID:',
            'help_text' => null,
            'field' => 'CQCLOCATIONID',
            'field_type' => 'select',
            'validation' => null,
            'order' => 3,
            'hidden_at' => null
        ]);

        // 1. Establishment name.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '1',
            'question' => 'What is the name of your establishment?',
            'help_text' => null,
            'field' => 'ESTABLISHMENTNAME',
            'field_type' => '',
            'validation' => null,
            'order' => 4,
            'hidden_at' => null
        ]);

        // 2. Establishment address.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '1',
            'question' => 'What is the address of your establishment?',
            'help_text' => null,
            'field' => 'ADDRESS',
            'field_type' => 'textarea',
            'validation' => null,
            'order' => 5,
            'hidden_at' => null
        ]);

        // 3. Establishment telephone number.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '3',
            'question' => 'What is the best number to call you on?',
            'help_text' => null,
            'field' => 'TELEPHONE',
            'field_type' => 'text',
            'validation' => null,
            'order' => 6,
            'hidden_at' => null
        ]);

        // 17. Main service.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '17',
            'question' => 'What is the main service you provide?',
            'help_text' => null,
            'field' => 'MAINSERVICE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 7,
            'hidden_at' => null
        ]);
    }
}