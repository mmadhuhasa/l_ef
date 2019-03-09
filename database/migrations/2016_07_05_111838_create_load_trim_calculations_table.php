<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoadTrimCalculationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('load_trim_calculations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('item', 244);
			$table->string('weight_in_lbs', 244);
			$table->string('arm_inches', 244);
			$table->string('moment', 244);
			$table->string('percentage_of_mac', 244);
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
		Schema::drop('load_trim_calculations');
	}

}
