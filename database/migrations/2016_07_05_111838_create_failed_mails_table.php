<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFailedMailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('failed_mails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('flight_plan_details_id');
			$table->string('subject', 244);
			$table->string('action', 244);
			$table->dateTime('time')->default('0000-00-00 00:00:00');
			$table->text('message', 65535);
			$table->boolean('is_active');
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
		Schema::drop('failed_mails');
	}

}
