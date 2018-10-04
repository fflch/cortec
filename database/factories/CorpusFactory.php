<?php

use Faker\Generator as Faker;

$factory->define(App\Corpus::class, function (Faker $faker) {
    return [
        'conteudo' => $faker->unique()->text(50000),
    ];
});
