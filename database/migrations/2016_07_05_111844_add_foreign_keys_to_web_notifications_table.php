<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWebNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('web_notifications', function(Blueprint $table)
		{
			$table->foreign('user_id', 'FK_users_role_map1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('action', 'notify_act')->references('id')->on('notification_actions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('web_notifications', function(Blueprint $table)
		{
			$table->dropForeign('FK_users_role_map1');
			$table->dropForeign('notify_act');
		});
	}

}
