<?php

namespace Database\Factories;

use App\Models\Corpus;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CorpusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Corpus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'categoria_id' => Categoria::factory()->create()->id,
            'titulo'       => $this->faker->unique()->text(25),
            'descricao'    => $this->faker->unique()->text(255),
            'tipologia'    => $this->faker->unique()->words(3, true),
            'compilador'   => $this->faker->unique()->name(),
            'ano'          => $this->faker->unique()->year(),
        ];
    }
}
 // 'categoria_id' => function () { 
 //       return Categoria::factory()->create()->id; }, 
        
