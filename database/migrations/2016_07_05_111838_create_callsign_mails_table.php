<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCallsignMailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('callsign_mails', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('aircraft_callsign', 50)->unique('aircraft_callsign');
			$table->text('mail_ids', 65535);
			$table->string('mobile_number', 150);
			$table->string('login_number', 12);
			$table->string('rnav', 100);
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
		Schema::drop('callsign_mails');
	}

}
