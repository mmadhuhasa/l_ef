<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('aero_id', 4);
			$table->string('aero_name', 50);
			$table->string('aero_latlong', 50);
			$table->string('elevation', 244);
			$table->string('runways', 244);
			$table->string('length', 50);
			$table->string('status', 350);
			$table->integer('is_active');
			$table->boolean('is_delete');
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
		Schema::drop('stations');
	}

}
