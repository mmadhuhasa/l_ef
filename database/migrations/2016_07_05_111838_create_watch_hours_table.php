<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWatchHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watch_hours', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('aerodrome', 6);
			$table->string('monday_open', 6);
			$table->string('monday_close', 6);
			$table->string('tuesday_open', 6);
			$table->string('tuesday_close', 6);
			$table->string('wednesday_open', 6);
			$table->string('wednesday_close', 6);
			$table->string('thursday_open', 6);
			$table->string('thursday_close', 6);
			$table->string('friday_open', 6);
			$table->string('friday_close', 6);
			$table->string('saturday_open', 6);
			$table->string('saturday_close', 6);
			$table->string('sunday_open', 6);
			$table->string('sunday_close', 6);
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
		Schema::drop('watch_hours');
	}

}
