<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstLandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_landing',  function(Blueprint $table){
            $table->increments('id');
            $table->string('ten_hours');
            $table->string('fourty_five_min');
            $table->string('twelve_thirty');
            $table->string('five_hours');
            $table->string('twelve_hours');
            $table->string('one_hour_thirty_min');
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
        //
    }
}
