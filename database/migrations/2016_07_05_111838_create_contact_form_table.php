<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_form', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 244);
			$table->string('email', 244);
			$table->string('mobile_number', 10);
			$table->text('message', 65535);
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
		Schema::drop('contact_form');
	}

}
