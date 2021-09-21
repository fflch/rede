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
        Snapshot::factory(40)->create();
    }
}
