<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeightCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weight_category', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('wt_id', 100);
			$table->string('wt_desc', 30);
			$table->integer('status');
			$table->integer('order')->nullable();
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
		Schema::drop('weight_category');
	}

}
