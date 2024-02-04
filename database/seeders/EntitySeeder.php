<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entities = [
            [
                'name' => 'Cave',
                'description' => 'A cave found within a region',
            ],
            [
                'name' => 'Squeeze',
                'description' => 'A squeeze found within a cave',
            ],
            [
                'name' => 'Region',
                'description' => 'Regions where caves are found',
            ],
            [
                'name' => 'User',
                'description' => 'Users on the PiLSi site',
            ],
            [
                'name' => 'Trip',
                'description' => 'Trips to Region(s)',
            ],
        ];

        DB::table('entities')->insert($entities);
    }
}
