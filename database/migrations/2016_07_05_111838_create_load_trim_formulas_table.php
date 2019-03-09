<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoadTrimFormulasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('load_trim_formulas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 244);
			$table->text('formula', 65535);
			$table->text('purpose', 65535);
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
		Schema::drop('load_trim_formulas');
	}

}
