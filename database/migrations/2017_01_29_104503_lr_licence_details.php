<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LrLicenceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licence_details', function (Blueprint $table) {
	    $table->increments('id', true);
	    $table->integer('user_id')->unsigned();
	    $table->integer('license_type_id')->unsigned();
	    $table->string('from_date')->nullable();
	    $table->string('to_date')->nullable();
	    $table->boolean('license_status')->default(0);
	    $table->boolean('is_active')->default(0);
	    $table->boolean('is_delete')->default(0);
	    $table->timestamps();

	    $table->foreign('user_id')->references('id')->on('users')->default(0);	    
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
