<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Porta;
use App\Models\Equipamento;
use Faker\Factory;

class PortaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $porta = [  

            'porta'           => substr_replace('1/0/', $faker->numberbetween(0,48), 4, 0),
            'equipamento_id'  => Equipamento::inRandomOrder()->pluck('id')->first(),
        ];
        
        Porta::create($porta);
        Porta::factory(40)->create();
    }
}
