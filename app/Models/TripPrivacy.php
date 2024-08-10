<?php

namespace App\Models;

enum TripPrivacy: int
{
    case PUBLIC = 0;
    case PRIVATE = 1;
    case HIDDEN = 2;
}
