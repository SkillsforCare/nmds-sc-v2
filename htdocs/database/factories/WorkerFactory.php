<?php

use App\Establishment;
use Faker\Generator as Faker;

$factory->define(App\Worker::class, function (Faker $faker) {

    $jobroles = collect([
        'Senior Care Worker',
        'Care Worker',
        'Community Support and Outreach Work',
        'Advice Guidance and Advocacy',
        'Nursing assistant'
    ]);


    return [
        'establishment_id' => factory(Establishment::class)->create()->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'job_role' => $jobroles->random(),
    ];
});
