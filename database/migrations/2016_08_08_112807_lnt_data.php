<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LntData extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
	Schema::create('lnt_data', function(Blueprint $table) {
	    $table->increments('id', true);
	    $table->string('aircraft_callsign',200);
	    $table->string('date_of_flight', 100);
	    $table->string('departure_aerodrome', 200);
	    $table->string('destination_aerodrome',200);
	    $table->string('departure_time',200);
	    $table->string('pilot_in_command',200);
	    $table->string('copilot',200);
	    $table->integer('jump');
	    
	    $table->integer('weight5');
	    $table->integer('weight6');
	    $table->integer('weight7');
	    $table->integer('weight8');
	    $table->integer('weight9');
	    $table->integer('weight10');
	    $table->integer('weight11');
	    $table->integer('weight12');
	    $table->integer('weight13');
	    $table->integer('weight14');
	    $table->integer('weight15');
	    $table->integer('weight16');
	    $table->integer('weight17');
	    
	    $table->string('moment5');
	    $table->string('moment6');
	    $table->string('moment7');
	    $table->string('moment8');
	    $table->string('moment9');
	    $table->string('moment10');
	    $table->string('moment11');
	    $table->string('moment12');
	    $table->string('moment13');
	    $table->string('moment14');
	    $table->string('moment15');
	    $table->string('moment16');
	    $table->string('moment17');
	    
	    $table->integer('no_of_pax');
	    $table->integer('no_of_adults');
	    $table->integer('no_of_infants');
	    $table->integer('fc');
	    $table->integer('bags');
	    $table->integer('take_off_fuel');
	    $table->integer('landing_fuel');
	    $table->integer('zero_fuel_weight');
	    $table->integer('take_off_fuel_weight');
	    $table->integer('landing_fuel_weight');
	    $table->decimal('zero_fuel_cg');
	    $table->decimal('take_off_fuel_cg');
	    $table->decimal('landing_fuel_cg');
	    $table->decimal('trim_setting',5,2);
	    $table->decimal('landing_fuel_trim_setting',5,2);
	    $table->boolean('is_active');
	    $table->timestamps();
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
	Schema::drop('lnt_data');
    }

}
