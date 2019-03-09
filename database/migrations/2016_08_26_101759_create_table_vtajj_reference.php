<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVtajjReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('lnt_vtajj_reference', function(Blueprint $table){
	  $table->increments('id',true);
	  $table->integer('fuel_weight');
	  $table->decimal('moment',9,2);
	  $table->tinyinteger('is_active');
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
