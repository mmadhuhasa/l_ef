<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePcTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pc', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('callsign', 100);
			$table->string('pilot', 999);
			$table->string('mobile', 999);
			$table->string('copilot', 999);
			$table->string('copilot_mob', 999);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pc');
	}

}
