<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caves = [
            [
                'name' => 'Corra-Lynn Cave',
                'code' => '5-Y1',
                'region_id' => 4,
                'description' => 'A long cave found on the Yorke Peninsula',
                'creator_id' => 1,
            ],
            [
                'name' => 'Brown Snake Cave',
                'code' => '5-U47',
                'region_id' => 6,
                'description' => 'A cave with a tight entrance near Naracoorte',
                'creator_id' => 1,
            ],
            [
                'name' => 'Stick-Tomato Cave',
                'code' => '5-U10/11',
                'region_id' => 6,
                'description' => 'A cave near Naracoorte. Also known as Wet Cave, a self-guided tourist cave',
                'creator_id' => 1,
            ],
            [
                'name' => 'River Road Cave',
                'code' => '5-M18',
                'region_id' => 2,
                'description' => 'On the side of the Murray River. Also known as Gloop Cave',
                'creator_id' => 1,
            ],
            [
                'name' => 'Fox Cave',
                'code' => '5-U22',
                'region_id' => 6,
                'description' => 'One of the Wild Adventure Caves at Naracoorte',
                'creator_id' => 1,
            ],
        ];

        DB::table('caves')->insert($caves);
    }
}
