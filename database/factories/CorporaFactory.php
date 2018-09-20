<?php

use Faker\Generator as Faker;

$factory->define(App\Corpora::class, function (Faker $faker) {
    return [
        'titulo' => $faker->unique()->text(25),
        'descricao' => $faker->unique()->text(255),
    ];
});
