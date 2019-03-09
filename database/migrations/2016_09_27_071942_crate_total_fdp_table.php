<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTotalFdpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('total_fdp',function(Blueprint $table){
            $table->increments('id');
            $table->string('no_of_plans');
            $table->string('fdp');
            $table->string('max_12hours_for_min_rest_period');
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
        Schema::drop('total_fdp');
    }
}
