<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviseChangeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('revise_change', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('callsign', 10);
			$table->string('departure_aerodrome', 10);
			$table->integer('departure_hours');
			$table->integer('departure_minutes');
			$table->string('destination_aerodrome', 11);
			$table->integer('date_of_flight');
			$table->string('changedropdown', 200);
			$table->string('changedata', 200);
			$table->string('email', 100);
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
		Schema::drop('revise_change');
	}

}
