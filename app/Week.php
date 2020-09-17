<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $table = 'weather_weeks';
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
