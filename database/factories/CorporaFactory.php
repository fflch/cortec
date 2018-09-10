<?php

use Faker\Generator as Faker;

$factory->define(App\Corpora::class, function (Faker $faker) {
    return [
        'titulo' => $faker->text(25),
    ];
});
