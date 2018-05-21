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
            'slug' => 'employment-details',
            'name' => 'Employment details',
            'order' => 2
        ]);

        factory(App\QuestionSection::class)->create([
            'slug' => 'learning-development',
            'name' => 'Learning and Development',
            'order' => 3
        ]);

        factory(App\QuestionSection::class)->create([
            'slug' => 'training',
            'name' => 'Training',
            'order' => 4
        ]);

        factory(App\QuestionSection::class)->create([
            'slug' => 'establishment-details',
            'name' => 'Establishment Details',
            'order' => 5
        ]);

    }
}
