<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWebNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('web_notifications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->integer('action')->unsigned()->index('action');
			$table->integer('unique_id');
			$table->string('subject');
			$table->integer('viewed_user_id')->default(0);
			$table->boolean('on_click');
			$table->boolean('on_close');
			$table->boolean('is_app');
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
		Schema::drop('web_notifications');
	}

}
