<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('mobile_number', 11)->unique('mobile_number');
			$table->string('operator');
			$table->text('additional_emails', 65535);
			$table->text('user_callsigns', 65535);
			$table->string('remember_token', 100)->nullable();
			$table->boolean('is_admin');
			$table->boolean('is_users_admin');
			$table->boolean('is_active');
			$table->boolean('is_delete');
			$table->boolean('is_app');
			$table->integer('updated_by');
			$table->boolean('fpl');
			$table->boolean('fdtl');
			$table->boolean('navlog');
			$table->boolean('lnt');
			$table->boolean('notams');
			$table->boolean('weather');
			$table->boolean('lr');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}

}
