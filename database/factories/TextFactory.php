<?php

 use Faker\Generator as Faker;

 $factory->define(App\Text::class, function (Faker $faker) {
    return [
        'corpus_id' => function () {
            return factory(App\Corpus::class)->create()->id;
        },
        'conteudo' => $faker->unique()->realText(50000),
        'idioma' => $faker->randomElement($array = array ('pt','en')) ,
    ];
});
