<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstablishmentSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(QuestionCategorySeeder::class);
        $this->call(QuestionSectionSeeder::class);
        $this->call(QuestionGroupSeeder::class);
        $this->call(EstablishmentQuestionSeeder::class);
        $this->call(WorkerQuestionSeeder::class);
        $this->call(WorkerSeeder::class);
    }
}
