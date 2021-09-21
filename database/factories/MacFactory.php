<?php

namespace Database\Factories;

use App\Models\Mac;
use App\Models\Snapshot;
use Illuminate\Database\Eloquent\Factories\Factory;

class MacFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mac::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vlan'          => $this->faker->numberBetween(0, 4096),
            'mac'           => $this->faker->macAddress(),
            'snapshot_id'   => Snapshot::inRandomOrder()->pluck('id')->first(), 
        ];
    }
}
