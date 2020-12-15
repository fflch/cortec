<?php

namespace Database\Factories;

use App\Models\Text;
use App\Models\Corpus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TextFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Text::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'corpus_id' => Corpus::factory()->create()->id,
            'conteudo'  => $this->faker->unique()->realText(50000),
            'idioma'    => $this->faker->randomElement($array = array ('pt','en')) , 
        ];
    }
}


 //   'corpus_id' => function () {
   //     return Corpus::factory()->create()->id;        },
        