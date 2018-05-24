<?php

use App\QuestionSection;
use Illuminate\Database\Seeder;

class QuestionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = QuestionSection::get();

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'slug' => 'basic-details',
            'name' => 'Basic Details',
            'order' => 1
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'slug' => 'disability',
            'name' => 'Disability',
            'order' => 2
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'slug' => 'ethnicity',
            'name' => 'Ethnicity',
            'order' => 3
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'slug' => 'born-in-uk',
            'name' => 'Born in UK',
            'order' => 4
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'slug' => 'employment-status',
            'name' => 'Employment Status',
            'order' => 1
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'slug' => 'pay',
            'name' => 'Pay',
            'order' => 2
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'slug' => 'experience',
            'name' => 'Experience',
            'order' => 3
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'slug' => 'care-certificate',
            'name' => 'Care Certificate',
            'order' => 4
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'slug' => 'qualifications',
            'name' => 'Qualifications',
            'order' => 5
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'training')->first()->id,
            'slug' => 'training',
            'name' => 'Training',
            'order' => 6
        ]);
    }
}
