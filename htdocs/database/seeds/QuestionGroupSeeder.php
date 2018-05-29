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

        $group = factory(App\QuestionGroup::class)->create([
            'id' => 1,
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => null,
            'group_next_id' => 2,
            'slug' => 'personal-details',
            'name' => 'Personal Details',
            'order' => 1
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'identity',
            'name' => 'Identity',
            'order' => 2
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'ethnicity',
            'name' => 'Ethnicity',
            'order' => 3
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'born-in-uk',
            'name' => 'Born in UK',
            'order' => 4
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'employment-status',
            'name' => 'Employment Status',
            'order' => 1
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'pay',
            'name' => 'Pay',
            'order' => 2
        ]);
        
        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'care-certificate',
            'name' => 'Care Certificate',
            'order' => 4
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'qualifications',
            'name' => 'Qualifications',
            'order' => 5
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'training')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => null,
            'slug' => 'training',
            'name' => 'Training',
            'order' => 6
        ]);
    }
}
