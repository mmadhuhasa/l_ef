<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChildTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('child', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'child_ibfk_1')->references('id')->on('parent')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('child', function(Blueprint $table)
		{
			$table->dropForeign('child_ibfk_1');
		});
	}

}
