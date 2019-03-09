<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotamRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notam_records', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('recent_id')->default(1);
			$table->integer('updated_by');
			$table->string('recent_added_number');
			$table->string('notam_number');
			$table->string('dupe_notam_number');
			$table->string('revised_notam_number');
			$table->string('fir');
			$table->string('airport');
			$table->string('from_date');
			$table->string('from_time');
			$table->string('to_date');
			$table->string('to_time');
			$table->string('valid_timing');
			$table->text('notam_text', 65535);
			$table->string('q_code');
			$table->text('f_text', 65535);
			$table->text('g_text', 65535);
			$table->text('from_date_format', 65535);
			$table->text('from_time_format', 65535);
			$table->string('from_time_IST');
			$table->text('to_date_format', 65535);
			$table->text('to_time_format', 65535);
			$table->string('to_time_IST');
			$table->boolean('status');
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
		Schema::drop('notam_records');
	}

}
