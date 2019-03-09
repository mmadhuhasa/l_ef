<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotamRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notam_routes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('recent_id')->default(1);
			$table->integer('updated_by');
			$table->string('recent_added_number');
			$table->string('notam_number');
			$table->string('revised_notam_number');
			$table->string('fir');
			$table->string('route_name');
			$table->string('airport');
			$table->boolean('status');
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
		Schema::drop('notam_routes');
	}

}
