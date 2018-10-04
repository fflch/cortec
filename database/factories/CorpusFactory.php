<?php

use Faker\Generator as Faker;

$factory->define(App\Corpus::class, function (Faker $faker) {
    return [
        'corpora_id' => 0,
        'conteudo' => $faker->unique()->text(50000),
    ];
});
