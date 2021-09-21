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
        Porta::factory(40)->create();
    }
}
