<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAerodromeMailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aerodrome_mails', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('aerodrome', 100);
			$table->string('mail_ids', 200);
			$table->boolean('departure_only')->default(0);
			$table->boolean('destination_only')->default(0);
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
		Schema::drop('aerodrome_mails');
	}

}
