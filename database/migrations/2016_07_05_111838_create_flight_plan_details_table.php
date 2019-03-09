<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlightPlanDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flight_plan_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->string('aircraft_callsign', 7);
			$table->string('departure_aerodrome', 4);
			$table->string('destination_aerodrome', 4);
			$table->string('departure_time_hours', 2);
			$table->string('departure_time_minutes', 2);
			$table->string('date_of_flight', 6);
			$table->string('departure_station', 30)->nullable();
			$table->string('destination_station', 30)->nullable();
			$table->string('pilot_in_command', 25);
			$table->string('mobile_number', 11);
			$table->string('copilot', 25);
			$table->string('cabincrew', 25);
			$table->string('operator', 50);
			$table->string('departure_latlong', 15)->nullable();
			$table->string('destination_latlong', 20)->nullable();
			$table->string('flight_rules', 1);
			$table->string('flight_type', 1);
			$table->string('aircraft_type', 6);
			$table->string('weight_category', 1);
			$table->string('equipment', 32);
			$table->string('transponder', 1);
			$table->string('crushing_speed_indication', 1);
			$table->string('crushing_speed', 5);
			$table->string('flight_level_indication', 1);
			$table->string('flight_level', 4);
			$table->string('route', 150);
			$table->string('total_flying_hours', 2);
			$table->string('total_flying_minutes', 2);
			$table->string('first_alternate_aerodrome', 4);
			$table->string('second_alternate_aerodrome', 4)->nullable();
			$table->string('alternate_station', 50)->nullable();
			$table->string('registration', 7);
			$table->string('endurance_hours', 2);
			$table->string('endurance_minutes', 2);
			$table->string('indian', 100);
			$table->string('foreigner', 50);
			$table->string('foreigner_nationality', 50);
			$table->string('sel', 4)->nullable();
			$table->string('fir_crossing_time', 50)->nullable();
			$table->string('pbn', 20)->nullable();
			$table->string('nav', 8)->nullable();
			$table->string('code', 20);
			$table->string('per', 2);
			$table->string('take_off_altn', 20);
			$table->string('route_altn', 20);
			$table->string('tcas', 10);
			$table->string('credit', 20);
			$table->string('no_credit', 20);
			$table->string('remarks', 200);
			$table->string('emergency_uhf', 3)->nullable();
			$table->string('emergency_vhf', 3)->nullable();
			$table->string('emergency_elba', 3)->nullable();
			$table->string('polar', 3)->nullable();
			$table->string('desert', 3)->nullable();
			$table->string('maritime', 3)->nullable();
			$table->string('jungle', 3)->nullable();
			$table->string('light', 3)->nullable();
			$table->string('floures', 3)->nullable();
			$table->string('jacket_uhf', 3)->nullable();
			$table->string('jacket_vhf', 3)->nullable();
			$table->string('number', 3)->nullable();
			$table->string('capacity', 3)->nullable();
			$table->string('cover', 3)->nullable();
			$table->string('color', 50)->nullable();
			$table->string('aircraft_color', 50)->nullable();
			$table->string('fic', 10);
			$table->string('adc', 10);
			$table->string('india_time', 50);
			$table->string('plan_status');
			$table->dateTime('filed_date')->default('0000-00-00 00:00:00');
			$table->boolean('is_active');
			$table->boolean('is_delete');
			$table->boolean('is_app');
			$table->boolean('is_old_record');
			$table->integer('updated_by');
			$table->integer('adc_updated_by');
			$table->dateTime('adc_updated_time')->default('0000-00-00 00:00:00');
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
		Schema::drop('flight_plan_details');
	}

}
