<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('navlog_masterid');
            $table->integer('no_of_flight');
            $table->integer('flight_date');
            $table->string('callsign');
            $table->string('departure');
            $table->string('destination');
            $table->string('dep_time');
            $table->integer('pax')->nullable();
            $table->integer('load')->nullable();
            $table->integer('fuel')->nullable();
            $table->integer('min_max')->nullable();
            $table->string('pilot');
            $table->biginteger('mobile');
            $table->string('co_pilot');
            $table->string('cabin_crew');
            $table->string('remarks')->nullable();
            $table->string('dept_place')->nullable();
            $table->string('dept_lat')->nullable();
            $table->string('dest_place')->nullable();
            $table->string('dest_lat')->nullable();
            $table->integer('speed')->nullable();
            $table->string('level1')->nullable();
            $table->string('main_route')->nullable();
            $table->string('alternate1')->nullable();
            $table->string('level2')->nullable();
            $table->string('alternate1route')->nullable();
            $table->string('alternate2')->nullable();
            $table->string('level3')->nullable();
            $table->string('alternate2route')->nullable();
            $table->string('take_off_alternate')->nullable();
            $table->string('level4')->nullable();
            $table->string('take_off_alternate_route')->nullable();
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
        Schema::drop('navlogs');
    }
}
