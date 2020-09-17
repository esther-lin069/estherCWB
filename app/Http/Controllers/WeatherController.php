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

        return view('index', compact('weeks'));
    }

    public function chartData(Request $request)
    {
        $datas = ThreeDay::where('location',$request->location)->take(8)->get(['dataTime','AT','T','pop6h']);

        return $datas;
    }
}
