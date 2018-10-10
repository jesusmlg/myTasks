<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public static function getPriorities()
    {
        return ['LOW','MEDIUM','HIGH'];
    }
}
