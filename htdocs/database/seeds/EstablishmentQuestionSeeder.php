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
            'question' => 'Are you regulated by CQC?',
            'help_text' => null,
            'field' => 'REGTYPE',
            'field_type' => 'radio-list',
            'validation' => null,
            'order' => 1,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'What is the postcode of your establishment?',
            'help_text' => null,
            'field' => 'POSTCODE',
            'field_type' => 'text',
            'validation' => null,
            'order' => 2,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'Please select your location ID:',
            'help_text' => null,
            'field' => 'LOCATIONID',
            'field_type' => 'select',
            'validation' => null,
            'order' => 3,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '15',
            'question' => 'Enter provider ID',
            'help_text' => null,
            'field' => 'PROVNUM',
            'field_type' => 'select',
            'validation' => null,
            'order' => 3,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'What is the name of your establishment?',
            'help_text' => null,
            'field' => 'ESTNAME',
            'field_type' => '',
            'validation' => 'required|max:120',
            'order' => 4,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'What is the address of your establishment 1?',
            'help_text' => null,
            'field' => 'ADDRESS1',
            'field_type' => 'text',
            'validation' => null,
            'order' => 5,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'Enter address 2?',
            'help_text' => null,
            'field' => 'ADDRESS2',
            'field_type' => 'text',
            'validation' => null,
            'order' => 6,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'Enter address 3?',
            'help_text' => null,
            'field' => 'ADDRESS3',
            'field_type' => 'text',
            'validation' => null,
            'order' => 7,
            'hidden_at' => null
        ]);

        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => null,
            'question' => 'Enter post town?',
            'help_text' => null,
            'field' => 'POST',
            'field_type' => 'text',
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

        // 18. Other service.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '17',
            'question' => 'Do you provide any other service?',
            'help_text' => null,
            'field' => 'OTHERSERVICE',
            'field_type' => 'select',
            'validation' => null,
            'order' => 8,
            'hidden_at' => null
        ]);

        // 19. Other service list.
        $question = factory(App\Question::class)->create([
            'question_category_id' => $category->id,
            'question_section_id' => $details->id,
            'number' => '18',
            'question' => 'Do you provide any other service?',
            'help_text' => null,
            'field' => 'OTHERSERVICE-1',
            'field_type' => 'select',
            'validation' => null,
            'order' => 9,
            'hidden_at' => null
        ]);



    }
}