<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherThreeDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_three_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location');
            $table->timestamp('dataTime');
            $table->string('wx');
            $table->integer('AT');
            $table->integer('T');
            $table->string('pop6h')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_three_days');
    }
}
