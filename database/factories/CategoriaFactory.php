<?php

 use Faker\Generator as Faker;

 $factory->define(App\Categoria::class, function (Faker $faker) {
    return [
        'nome' => $faker->unique()->text(25),
    ];
});
