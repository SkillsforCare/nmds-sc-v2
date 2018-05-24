<?php

use App\QuestionCategory;
use Illuminate\Database\Seeder;

class QuestionSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = QuestionCategory::get();

        factory(App\QuestionSection::class)->create([
            'question_category_id' => $categories->where('slug', 'worker')->first()->id,
            'slug' => 'personal-details',
            'name' => 'Personal Details',
            'order' => 1
        ]);

        factory(App\QuestionSection::class)->create([
            'question_category_id' => $categories->where('slug', 'worker')->first()->id,
            'slug' => 'employment-details',
            'name' => 'Employment details',
            'order' => 2
        ]);

        factory(App\QuestionSection::class)->create([
            'question_category_id' => $categories->where('slug', 'worker')->first()->id,
            'slug' => 'learning-development',
            'name' => 'Learning and Development',
            'order' => 3
        ]);

        factory(App\QuestionSection::class)->create([
            'question_category_id' => $categories->where('slug', 'worker')->first()->id,
            'slug' => 'training',
            'name' => 'Training',
            'order' => 4
        ]);

        factory(App\QuestionSection::class)->create([
            'question_category_id' => $categories->where('slug', 'establishment')->first()->id,
            'slug' => 'establishment-details',
            'name' => 'Establishment Details',
            'order' => 5
        ]);

    }
}
