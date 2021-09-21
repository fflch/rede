<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Snapshot;
use App\Models\Porta;

class SnapshotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $status_key = array_rand(Snapshot::status);

    $snapshot = [
        'status'    => Snapshot::status[$status_key],
        'porta_id'  => Porta::inRandomOrder()->pluck('id')->first(),
    ];
        
    Snapshot::create($snapshot);
    Snapshot::factory(40)->create();
    }
}
