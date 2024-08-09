<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            UserSeeder::class,
            CaveSeeder::class,
            SqueezeSeeder::class,
            TripSeeder::class,
            ClubSeeder::class,
            VisitSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
