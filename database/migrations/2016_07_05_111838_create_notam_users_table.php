<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotamUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notam_users', function(Blueprint $table)
		{
			$table->integer('notam_id', true);
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('mobile_number', 10);
			$table->string('password');
			$table->integer('user_type');
			$table->dateTime('membership_start_date')->default('0000-00-00 00:00:00');
			$table->dateTime('membership_expire_date')->default('0000-00-00 00:00:00');
			$table->dateTime('password_updated_at')->default('0000-00-00 00:00:00');
			$table->dateTime('last_login_time')->default('0000-00-00 00:00:00');
			$table->string('operator');
			$table->string('airport1');
			$table->string('airport2');
			$table->string('airport3');
			$table->string('airport4');
			$table->string('airport5');
			$table->text('all_airports', 65535);
			$table->string('route1');
			$table->string('route2');
			$table->string('route3');
			$table->string('route4');
			$table->string('route5');
			$table->text('all_routes', 65535);
			$table->string('description');
			$table->boolean('status');
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
		Schema::drop('notam_users');
	}

}
