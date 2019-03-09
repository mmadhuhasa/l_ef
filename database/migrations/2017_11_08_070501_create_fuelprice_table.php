<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelpriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelprices', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('airport_code');
            $table->string('city');
            $table->decimal('eflight_price',10,2)->nullable();
            $table->decimal('basic_price',10,2)->nullable();
            $table->decimal('tax',10,2)->nullable();
            $table->decimal('tax_amount',10,2)->nullable();
            $table->decimal('hp_price',10,2)->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
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
         Schema::drop('fuelprices');
    }
}
