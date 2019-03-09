<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateDayNightTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('day_night_timings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('day_time_from');
            $table->string('day_time_to');
            $table->string('night_time_from');
            $table->string('night_time_to');
            $table->rememberToken();
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('day_night_timings');
    }
}
