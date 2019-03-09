<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStationAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('station_addresses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('chennai', 100);
			$table->string('mumbai', 100);
			$table->string('kolkata', 100);
			$table->string('delhi', 100);
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
		Schema::drop('station_addresses');
	}

}
