<?php

use Illuminate\Database\Seeder;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\QuestionCategory::class)->create([
            'slug' => 'establishment',
            'name' => 'Establishment',
        ]);

        factory(App\QuestionCategory::class)->create([
            'slug' => 'worker',
            'name' => 'Worker',
        ]);
    }
}
