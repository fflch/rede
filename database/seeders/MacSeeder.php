<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Mac;
use App\Models\Snapshot;

class MacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $mac = [  

            'vlan'          => $faker->numberBetween(0, 4096),
            'mac'           => $faker->macAddress(),
            'snapshot_id'   => Snapshot::inRandomOrder()->pluck('id')->first(), 
        ];
        
        Mac::create($mac);
        Mac::factory(40)->create();
    }
}
