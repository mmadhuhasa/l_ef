<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateFdtlAPITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdtl_api_details', function(Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id',10)->unsigned();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('no_of_landings');
            $table->string('aircraft_callsign', 5);
            $table->string('date_of_flight', 6);
            $table->string('departure_aerodrome', 4);
            $table->string('destination_aerodrome', 4);
            $table->string('departure_time_hours', 2);
            $table->string('departure_time_minutes', 2);
            $table->string('total_flying_hours', 2);
            $table->string('total_flying_minutes', 2);
            $table->string('reporting_time');
            $table->string('flight_time');
            $table->string('chocks_off');
            $table->string('chocks_on');
            $table->string('duty_end_time');
            $table->string('flight_duty_period');
            $table->string('split_duty');
            $table->string('total_ft');
            $table->string('total_flight_duty_period');
            $table->string('today_next_plan_last_dep_time');
            $table->string('today_last_duty_end_time');
            $table->string('next_day_earliest_dep_time');
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
        Schema::drop('fdtl_api_details');
    }
}
