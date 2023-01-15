<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = [
            'name' => 'Squeeze-o-rama 2023!',
            'trip_leader' => 'Joe Caver',
            'notes' => 'A bunch of cavers from all over South Australia converge on Corra-Lynn Cave, and smash out all the squeezes they can!',
            'user_id' => 1,
            'region_id' => 4,            
            'start_date' => Carbon::create('2023', '04', '21'),
            'end_date' => Carbon::create('2023', '04', '22')
        ];

        DB::table('trips')->insert($trips);
    }
}

