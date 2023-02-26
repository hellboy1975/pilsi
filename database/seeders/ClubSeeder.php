<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubs = [
            [
                'abbreviation' => 'CEGSA',
                'name' => 'Cave Exploration Group (South Australia) Incorporated',
                'location' => 'South Australia',
                'website' => 'https://www.cegsa.org.au',
                'about' => "The Cave Exploration Group (South Australia) Incorporated (CEGSA), also known as the Cave Exploration Group of South Australia, was established in 1955. The Group's philosophy is to foster caving, speleology and the preservation of natural caves, with particular reference to South Australia. Its objectives are to explore, survey and study South Australian caves, to record the results of such investigations and to cooperate with other bodies in the furtherance of these aims."
            ],
            [
                'abbreviation' => 'FUSSI',
                'name' => 'Flinders University Speleological Society Incorporated',
                'location' => 'South Australia',
                'website' => 'https://www.cegsa.org.au',
                'about' => "We're a club at Flinders University. Members of the general public and the University community are very welcome.<br/>Formed in 1974, the original purpose of Flinders University Speleological Society Inc. was to carry out scientific work at the Naracoorte Caves. Since then FUSSI members have visited many areas other than Naracoorte and undertaken speleological work on the Nullarbor and the Flinders Ranges"
            ],[
                'abbreviation' => 'SCG',
                'name' => 'Scout Caving Group (South Australia)',
                'location' => 'South Australia',
                'website' => 'https://qstore.sa.scouts.com.au/outdooradventure/caving/',
                'about' => "The Scout Caving Group commenced in 1982 with a group of Scout Leaders who were concerned for the welfare and safety of members of the Scout Association undertaking activities in caving. The main purpose of SCG is to promote and conduct adventurous activities in an underground environment and to provide training for Scout Caving Leaders."
            ]
        ];

        DB::table('clubs')->insert($clubs);
    }
}
