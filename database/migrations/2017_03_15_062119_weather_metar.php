<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WeatherMetar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('weather_metars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('airport_code');
            $table->string('wx_date');
            $table->string('wx_time_gmt');
            $table->string('wind_direction')->nullable;
            $table->integer('wind_speed')->nullable;
            $table->integer('wind_gust')->nullable;
            $table->string('var_wind_direction')->nullable;
            $table->integer('visibility')->nullable;
            $table->string('rv1')->nullable;
            $table->string('rv2')->nullable;
            $table->string('wx')->nullable;
            $table->string('clouds1')->nullable;
            $table->string('clouds2')->nullable;
            $table->string('clouds3')->nullable;
            $table->string('temperature')->nullable;
            $table->string('dew_point')->nullable;
            $table->integer('pressure')->nullable;
            $table->string('trend_sky')->nullable;
            $table->string('trend_wind_direction')->nullable;
            $table->integer('trend_wind_speed')->nullable;
            $table->integer('trend_wind_gust')->nullable;
            $table->integer('trend_visibility')->nullable;
            $table->string('trend_wx')->nullable;
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lr_actions');
    }
}
