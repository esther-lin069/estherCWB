<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreeDay extends Model
{
    protected $table = 'weather_three_days';
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function getDataTimeAttribute($value)
    {
        return ($value);
    }
}
