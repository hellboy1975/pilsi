<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqueezeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $squeezes = 
        [
            [
                'name' => 'Wedding Cake Squeeze',
                'pilsi' => '10Ki',
                'description' => 'Keyhole shaped squeeze near a rare Corra-Lynn speleothem.  Typical approach is on your back upwards through the squeeze.',
                'cave_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Brown Snake Entrance solution tube (entry)',
                'pilsi' => '9TC-',
                'description' => 'Entrance solution tube for this cave has a tight corkscrew squeeze near the bottom.  Note getting back up is significantly harder!',
                'cave_id' => 2,
                'user_id' => 1
            ],
            [
                'name' => 'Brown Snake Entrance solution tube (exit)',
                'pilsi' => '11TC+',
                'description' => 'Entrance solution tube for this cave has a tight corkscrew squeeze near the bottom.  Gravity sucks quite a bit in the exit of this cave...',
                'cave_id' => 2,
                'user_id' => 1
            ],
            [
                'name' => 'Eye of the Needle',
                'description' => 'Relatively easy squeeze through a well worn speleothem.  Excellent beginners squeeze.',
                'pilsi' => '3E-',
                'cave_id' => 3,
                'user_id' => 1
            ],
            [
                'name' => 'Bandicoots Bypass',
                'pilsi' => '7K-',
                'description' => 'Infamous entrance/exit to the Skeleton section of Corra-Lynn cave.  The entire bypass is hardwork, is about 40m long and comes to a moderately challenging and very indtimidating keyhole restriction.',
                'cave_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Taylors Tomb',
                'pilsi' => '10S+',
                'description' => 'Vertical squeeze for those who like both tricky climbs and contortion.',
                'cave_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Birth Canal (up)',
                'pilsi' => '5T+M',
                'description' => 'A 10m slog through mud followed by a slimey exit.  Difficulty can be increased during times of flood, and or "blockages".',
                'cave_id' => 4,
                'user_id' => 1
            ],
            [
                'name' => 'Birth Canal (down)',
                'pilsi' => '2T-M',
                'description' => 'For the Gloop completionist, you can go back through the squeeze in reverse.  Not tight, but expect mud in your face.',
                'cave_id' => 4,
                'user_id' => 1
            ],
            [
                'name' => 'Fox Cave gate (entry)',
                'pilsi' => '4L-',
                'description' => 'The Fox Cave gate is part of a letterbox squeeze.  Marginally easier going down, mostly due to gravity',
                'cave_id' => 5,
                'user_id' => 1
            ],
            [
                'name' => 'Fox Cave gate (exit)',
                'pilsi' => '5L+',
                'description' => 'The Fox Cave gate is part of a letterbox squeeze.  Going up feels a little harder as gravity works against you, however there is less blood rushing to your head.',
                'cave_id' => 5,
                'user_id' => 1
            ]
        ];

        DB::table('squeezes')->insert($squeezes);
    }
}
