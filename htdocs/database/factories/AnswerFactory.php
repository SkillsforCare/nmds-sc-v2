<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {

    $answer = $faker->paragraphs(4, true);

    return [
        'answer' => $answer,
        'text' => str_limit($answer, 15)
    ];
});
