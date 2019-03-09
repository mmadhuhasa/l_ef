<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePilotsInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilots_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('aircraft_callsign', 244);
			$table->integer('pilot_id')->unsigned()->index('pilot_id');
			$table->integer('copilot_id')->unsigned()->index('copilot_id');
			$table->string('pilot_name', 244);
			$table->string('copilot_name', 244);
			$table->boolean('is_active');
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
		Schema::drop('pilots_info');
	}

}
