<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Week;
use App\ThreeDay;

class WeatherController extends Controller
{
    public function index($location)
    {
        $weeks = Week::where('location',$location)->where('time','06:00')->get();
        $three_days = ThreeDay::where('location',$location)->get();

        return view('index', compact(['weeks','three_days']));
    }
}
