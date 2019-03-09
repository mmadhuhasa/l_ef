<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeatherDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weather_data', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('station_id');
			$table->string('airport_name');
			$table->string('airport_code');
			$table->text('raw_report', 65535)->nullable();
			$table->string('time');
			$table->string('wind_direction');
			$table->string('wind_speed');
			$table->string('wind_gusting');
			$table->string('visibility_distance');
			$table->string('wind_variable');
			$table->string('visibility_condition');
			$table->string('rvr');
			$table->string('cloude1_type');
			$table->string('cloude1_height');
			$table->string('cloude2_type');
			$table->string('cloude2_height');
			$table->string('cloude3_type');
			$table->string('cloude3_height');
			$table->string('temparature');
			$table->string('dew_point');
			$table->string('qnh');
			$table->string('trend');
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
		Schema::drop('weather_data');
	}

}
