<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoadTrimReferenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('load_trim_reference', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('fuel_in_lbs');
			$table->string('main_percentage_mac', 244);
			$table->string('aux_percentage_mac', 244);
			$table->string('tail_percentage_mac', 244);
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
		Schema::drop('load_trim_reference');
	}

}
