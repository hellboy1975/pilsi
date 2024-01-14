<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RegionSeeder::class,
            CaveSeeder::class,
            SqueezeSeeder::class,
            TripSeeder::class,
            ClubSeeder::class,
            VisitSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
