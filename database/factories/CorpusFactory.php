<?php

use Faker\Generator as Faker;

$factory->define(App\Corpus::class, function (Faker $faker) {
    return [
        'categoria_id' => function () {
            return factory(App\Categoria::class)->create()->id;
        },
        'titulo' => $faker->unique()->text(25),
        'descricao' => $faker->unique()->text(255),
    ];
});
