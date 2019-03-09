<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFicadcTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ficadc', function(Blueprint $table)
		{
			$table->integer('sno', true);
			$table->integer('fpid');
			$table->integer('loginid');
			$table->string('fic', 5);
			$table->string('adc', 10);
			$table->string('aircraft_callsign', 10);
			$table->string('dep_aero', 5);
			$table->string('dest_aero', 5);
			$table->integer('date_of_flight');
			$table->integer('deptime');
			$table->string('dep_station', 50);
			$table->string('dest_station', 50);
			$table->text('mailid', 65535);
			$table->text('datetime', 65535);
			$table->integer('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ficadc');
	}

}
