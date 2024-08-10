<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'PiLSiBot',
                'id' => 1,
                'email' => 'bot@pilsi.xyz',
                'bio' => 'I am a bot which adds caves automagically',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
