<?php

namespace Database\Factories;

use App\Models\Snapshot;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Porta;

class SnapshotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Snapshot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    

    public function definition()
    {
        $status_key = array_rand(Snapshot::status);

        return [
        'status'    => Snapshot::status[$status_key],
        'porta_id'  => Porta::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
