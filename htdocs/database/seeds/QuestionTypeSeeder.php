<?php

use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\QuestionType::class)->create([
            'slug' => 'establishment',
            'name' => 'Establishment',
        ]);

        factory(App\QuestionType::class)->create([
           'slug' => 'worker',
           'name' => 'Worker',
        ]);
    }
}
