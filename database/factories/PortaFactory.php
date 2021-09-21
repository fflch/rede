<?php

namespace Database\Factories;

use App\Models\Porta;
use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Porta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'porta'           => substr_replace('1/0/', $this->faker->numberbetween(0,48), 4, 0),
            'equipamento_id'  => Equipamento::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
