<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipamento;
use Faker\Factory;

class EquipamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $model_key = array_rand(Equipamento::model);
        $local_key = array_rand(Equipamento::local);
        $position_key = array_rand(Equipamento::position);
        $hostname = $faker->randomNumber($nbDigits = 9);

        $equipamento = [  

            'hostname'      => substr_replace($hostname, '.', 3, 0),
            'model'         => Equipamento::model[$model_key],
            'ip'            => $faker->ipv4(), 
            'poe_type'      => 'no', 
            'local'         => Equipamento::local[$local_key],
            'position'      => Equipamento::position[$position_key],
        ];
        
        Equipamento::create($equipamento);
        Equipamento::factory(40)->create();
        
    }
}
