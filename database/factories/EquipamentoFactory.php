<?php

namespace Database\Factories;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipamentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Equipamento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $model_key = array_rand(Equipamento::model);
        $local_key = array_rand(Equipamento::local);
        $position_key = array_rand(Equipamento::position);
        $hostname = $this->faker->randomNumber($nbDigits = 9);

        return [
            'hostname'      => substr_replace($hostname, '.', 3, 0),
            'model'         => Equipamento::model[$model_key],
            'ip'            => $this->faker->ipv4(), 
            'poe_type'      => 'no', 
            'local'         => Equipamento::local[$local_key], 
            'position'      => Equipamento::position[$position_key],
        ];
    }
}
