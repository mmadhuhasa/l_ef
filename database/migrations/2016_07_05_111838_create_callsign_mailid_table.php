<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCallsignMailidTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('callsign_mailid', function(Blueprint $table)
		{
			$table->integer('sno', true);
			$table->string('createdate', 200);
			$table->string('callsign', 50);
			$table->text('mailid', 65535);
			$table->string('mobilenum', 150);
			$table->string('status', 1);
			$table->string('loginid', 12);
			$table->string('rnav', 100);
			$table->string('non_rnav', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('callsign_mailid');
	}

}
