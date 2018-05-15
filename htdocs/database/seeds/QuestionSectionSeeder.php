<?php

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
        factory(App\QuestionSection::class)->create([
            'slug' => 'personal-details',
            'name' => 'Personal Details',
            'order' => 1
        ]);

        factory(App\QuestionSection::class)->create([
            'slug' => 'employment',
            'name' => 'Employment',
            'order' => 2
        ]);

        factory(App\QuestionSection::class)->create([
            'slug' => 'learning-development',
            'name' => 'Learning and Development',
            'order' => 3
        ]);

    }
}
