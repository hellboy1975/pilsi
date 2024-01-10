<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'name' => 'Adelaide Hills',
                'code' => '5-A',
                'country_code' => 'AU',
                'description' => 'Caves found in the Adelaide Hills',
            ],
            [
                'name' => 'Murraylands',
                'code' => '5-M',
                'country_code' => 'AU',
                'description' => 'Caves found along the River Murray',
            ],
            [
                'name' => 'Flinders',
                'code' => '5-F',
                'country_code' => 'AU',
                'description' => 'Caves found in the Flinders Ranges',
            ],
            [
                'name' => 'Yorke Peninsula',
                'code' => '5-Y',
                'country_code' => 'AU',
                'description' => 'Caves found on the Yorke Peninsula',
            ],
            [
                'name' => 'Eyre Peninsula',
                'code' => '5-E',
                'country_code' => 'AU',
                'description' => 'Caves found on the Eyre Peninsula',
            ],
            [
                'name' => 'Upper South East',
                'code' => '5-U',
                'country_code' => 'AU',
                'description' => 'Caves found in the Upper SE of South Australia.  Typically Naracoorte and the caves north of Penola',
            ],
            [
                'name' => 'Lower South East',
                'code' => '5-L',
                'country_code' => 'AU',
                'description' => 'Caves found in the Lower SE of South Australia.  Typically caves found around Mt Gambier and Millicent',
            ],
            [
                'name' => 'Nullarbor',
                'code' => '5-N',
                'country_code' => 'AU',
                'description' => 'Caves found on the Nullarbor Plain.  May or may not include WA caves depending on who you ask!',
            ],
            [
                'name' => 'Kangaroo Island',
                'code' => '5-K',
                'country_code' => 'AU',
                'description' => 'Caves on Kangaroo Island',
            ],
        ];

        DB::table('regions')->insert($regions);
    }
}
