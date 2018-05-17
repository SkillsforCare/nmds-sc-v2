<?php

use App\Establishment;
use Faker\Generator as Faker;

$factory->define(App\Worker::class, function (Faker $faker) {



    return [
        'establishment_id' => factory(Establishment::class)->create()->id
    ];
});
