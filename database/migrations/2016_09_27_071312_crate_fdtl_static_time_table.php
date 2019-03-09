<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateFdtlStaticTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('fdtl_static_time', function(Blueprint $table) {
            $table->increments('id');
            $table->string('reporting_time');
            $table->string('flight_time');
            $table->string('chocks_off');
            $table->string('chocks_on');
            $table->string('duty_end_time');
            $table->tinyInteger('is_active');
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
        Schema::drop('fdtl_static_time');
    }
}
