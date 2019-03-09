<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotamCoordinatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notam_coordinates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('airport');
			$table->string('fir');
			$table->string('notam_number');
			$table->string('revised_notam_number');
			$table->integer('recent_id');
			$table->string('lattitude');
			$table->string('longtitude');
			$table->integer('lat_degs');
			$table->integer('lat_mins');
			$table->integer('lat_secs');
			$table->integer('lat_milli_secs');
			$table->integer('long_degs');
			$table->integer('long_mins');
			$table->integer('long_secs');
			$table->integer('long_milli_secs');
			$table->boolean('status');
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
		Schema::drop('notam_coordinates');
	}

}
