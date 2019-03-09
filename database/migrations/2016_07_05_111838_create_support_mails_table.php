<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportMailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('support_mails', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('to_mail_ids', 65535);
			$table->text('cc_mail_ids', 65535);
			$table->text('bcc_mail_ids', 65535);
			$table->text('local_mail_ids', 65535);
			$table->boolean('is_bcc_active');
			$table->boolean('is_cc_active');
			$table->integer('is_active');
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
		Schema::drop('support_mails');
	}

}
