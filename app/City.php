<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function weeks()
    {
        return $this->hasMany('App\Week');
    }

    public function threeDays()
    {
        return $this->hasMany('App\ThreeDay');
    }
}
