<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMacTrimTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mac_trim', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('percentage_mac', 244)->nullable();
			$table->string('trim', 244)->nullable();
			$table->boolean('is_active')->default(1);
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
		Schema::drop('mac_trim');
	}

}
