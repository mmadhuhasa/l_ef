<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSunriseSunset2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sunrise_sunset2', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('stations', 65535)->nullable();
			$table->text('day', 65535)->nullable();
			$table->text('date', 65535)->nullable();
			$table->text('month', 65535)->nullable();
			$table->text('year', 65535)->nullable();
			$table->text('sunrise', 65535)->nullable();
			$table->text('sunset', 65535)->nullable();
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
		Schema::drop('sunrise_sunset2');
	}

}
