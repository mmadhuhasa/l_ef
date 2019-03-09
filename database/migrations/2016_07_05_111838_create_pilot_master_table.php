<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePilotMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilot_master', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 244);
			$table->string('email', 244);
			$table->string('mobile_number', 244);
			$table->boolean('is_pilot');
			$table->boolean('is_copilot');
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
		Schema::drop('pilot_master');
	}

}
