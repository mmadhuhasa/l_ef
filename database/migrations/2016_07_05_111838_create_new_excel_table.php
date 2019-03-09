<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewExcelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('new_excel', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('Date', 244);
			$table->string('Aircraft', 244);
			$table->string('SignOn', 244);
			$table->string('OffBlock', 244);
			$table->string('OnBlock', 244);
			$table->string('SignOff', 244);
			$table->integer('landings');
			$table->string('duty_tyme', 244);
			$table->string('flying_time', 244);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('new_excel');
	}

}
