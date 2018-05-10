<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {

    $type = collect([ 'text', 'date', 'select', 'yes_no' ])->random();

    // If the question is a select, then create some options.
    $options = null;
    if($type == 'select') {

        $rand = rand(1,10);

        for( $i = 0 ; $i <=  $rand ; $i++) {
            $options[] = [
                'text' => $faker->words(rand(1,5), true),
                'value' => $faker->word
            ];
        }
    }

    if($type == 'yes_no') {
        $options[] = [
            'text' => 'Yes',
            'value' => 'yes'
        ];

        $options[] = [
            'text' => 'No',
            'value' => 'no'
        ];
    }

    return [
        'question' => $faker->sentence . '?',
        'help_text' => '[Help]' . $faker->sentence,
        'field_type' => $type,
        'options' => $options
    ];
});
