<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCallsignInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('callsign_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('aircraft_callsign', 244);
			$table->string('designation', 244);
			$table->string('name', 244);
			$table->text('email', 65535);
			$table->text('mobile_number', 65535);
			$table->tinyInteger('is_fpl');
			$table->tinyInteger('is_change');
			$table->tinyInteger('is_fic_adc');
			$table->integer('is_active');
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
		Schema::drop('callsign_info');
	}

}
