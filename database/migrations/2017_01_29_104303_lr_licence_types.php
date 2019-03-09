<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LrLicenceTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lr_licence_types', function (Blueprint $table) {
	    $table->increments('id',true);
	    $table->string('name')->nullable();
	    $table->string('number')->nullable();
	    $table->boolean('is_active')->default(0);
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
