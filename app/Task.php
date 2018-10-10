<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $appends = ['humanDate'];

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getHumanDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
