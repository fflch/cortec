<?php

 use Faker\Generator as Faker;

 $factory->define(App\Corpus::class, function (Faker $faker) {
    return [
        'corpora_id' => function () {
            return factory(App\Corpora::class)->create()->id;
        },
        'conteudo' => $faker->unique()->text(50000),
    ];
});
