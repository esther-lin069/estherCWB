<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_weeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location');
            $table->string('date');
            $table->string('time');
            $table->string('pop6h');
            $table->string('wx');
            $table->integer('minT');
            $table->integer('maxT');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_weeks');
    }
}
