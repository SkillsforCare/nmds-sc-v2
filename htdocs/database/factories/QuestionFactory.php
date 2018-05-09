<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence . '?',
        'help_text' => '[Help]' . $faker->sentence
    ];
});
