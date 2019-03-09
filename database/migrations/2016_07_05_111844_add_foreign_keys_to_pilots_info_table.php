<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPilotsInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pilots_info', function(Blueprint $table)
		{
			$table->foreign('copilot_id', 'copilot_for')->references('id')->on('pilot_master')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pilot_id', 'pilot_for')->references('id')->on('pilot_master')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pilots_info', function(Blueprint $table)
		{
			$table->dropForeign('copilot_for');
			$table->dropForeign('pilot_for');
		});
	}

}
