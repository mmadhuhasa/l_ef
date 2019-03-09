<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePilotDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilot_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('callsign', 100);
			$table->string('pilot', 999);
			$table->string('pilot_email', 244);
			$table->string('mobile', 999);
			$table->string('copilot', 999);
			$table->string('copilot_mob', 999);
			$table->string('copilot_email', 244);
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
		Schema::drop('pilot_details');
	}

}
