<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LntCalculatedValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('lnt_calculated_values', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('fuel_weight', 100);
			$table->string('cg_value', 200);			
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
       Schema::drop('lnt_calculated_values');
    }
}
