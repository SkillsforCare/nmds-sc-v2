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
            'name' => 'Personal details',
            'order' => 1
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'personal-information',
            'name' => 'Personal information',
            'order' => 2
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'nationality',
            'name' => 'Nationality',
            'order' => 3
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'personal-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'place-of-birth',
            'name' => 'Place of birth',
            'order' => 4
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'experience',
            'name' => 'Experience',
            'order' => 1
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'sick-leave',
            'name' => 'Sick leave',
            'order' => 2
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'contract-type',
            'name' => 'Contract type',
            'order' => 3
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'zero-hours-contract-details',
            'name' => 'Zero hours contract details',
            'order' => 4
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'employment-details')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'pay-and-hours',
            'name' => 'Pay and hours',
            'order' => 5
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'care-certificate',
            'name' => 'Care certificate',
            'order' => 1
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'apprenticeship',
            'name' => 'Apprenticeship',
            'order' => 2
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'social-care-qualifications',
            'name' => 'Social care qualifications',
            'order' => 3
        ]);

        $group = factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'learning-development')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => $group->id + 2,
            'slug' => 'other-qualifications',
            'name' => 'Other qualifications',
            'order' => 4
        ]);

        factory(App\QuestionGroup::class)->create([
            'question_section_id' => $sections->where('slug', 'training')->first()->id,
            'group_previous_id' => $group->id,
            'group_next_id' => null,
            'slug' => 'training',
            'name' => 'Training',
            'order' => 1
        ]);
    }
}
