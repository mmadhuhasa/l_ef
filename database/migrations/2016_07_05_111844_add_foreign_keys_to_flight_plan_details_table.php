<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFlightPlanDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('flight_plan_details', function(Blueprint $table)
		{
			$table->foreign('user_id', 'flight_plan_details_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('flight_plan_details', function(Blueprint $table)
		{
			$table->dropForeign('flight_plan_details_ibfk_1');
		});
	}

}
