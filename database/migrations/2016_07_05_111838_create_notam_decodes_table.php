<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotamDecodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notam_decodes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code1');
			$table->string('signification1');
			$table->string('code2');
			$table->text('signification2', 65535);
			$table->boolean('status')->default(0);
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
		Schema::drop('notam_decodes');
	}

}
