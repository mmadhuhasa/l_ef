<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfplTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ofpl', function(Blueprint $table)
		{
			$table->integer('fp_id', true);
			$table->string('aircraft_callsign', 7);
			$table->string('flight_rules', 1)->index('flight_rules');
			$table->string('flight_type', 1)->index('flight_type');
			$table->integer('no_of_aircraft')->index('no_of_aircraft');
			$table->string('aircraft_type', 6);
			$table->string('weight_category', 1)->index('weight_category');
			$table->string('equipment', 32);
			$table->string('transponder', 1)->index('transponder');
			$table->string('dep_aero', 4);
			$table->string('dep_time', 5);
			$table->string('crushing_speed', 5);
			$table->string('fl_level', 4);
			$table->string('route', 150);
			$table->string('dest_aero', 4);
			$table->string('totalflyingtime', 5);
			$table->string('alt_aero', 4);
			$table->string('alt_aero2', 4)->nullable();
			$table->string('pbn', 20)->nullable();
			$table->string('nav', 10)->nullable();
			$table->string('dep_lat_long', 15)->nullable();
			$table->string('dep_station', 30)->nullable();
			$table->string('dest_lat_long', 20)->nullable();
			$table->string('dest_station', 30)->nullable();
			$table->string('date_of_flight', 6);
			$table->string('registration', 7);
			$table->string('sel', 4)->nullable();
			$table->string('operator', 50);
			$table->string('endurance', 4);
			$table->string('pilot_in_command', 25);
			$table->string('mob_no', 11);
			$table->string('copilot', 25);
			$table->string('cabincrew', 25);
			$table->string('fir_cross_est_time', 50)->nullable();
			$table->string('alt_station', 50)->nullable();
			$table->string('tcas', 10);
			$table->string('agcs', 10);
			$table->string('credit', 20);
			$table->string('noc', 20);
			$table->string('remarks', 200);
			$table->string('code', 20);
			$table->string('per', 2);
			$table->string('takealtn', 20);
			$table->string('routealtn', 20);
			$table->string('indian', 100);
			$table->string('foriegner', 50);
			$table->string('fordetails', 50);
			$table->string('ata', 100)->nullable();
			$table->string('mails', 200);
			$table->string('uhf', 3)->nullable();
			$table->string('vhf', 3)->nullable();
			$table->string('elba', 3)->nullable();
			$table->string('polar', 3)->nullable();
			$table->string('desert', 3)->nullable();
			$table->string('maritime', 3)->nullable();
			$table->string('jungle', 3)->nullable();
			$table->string('light', 3)->nullable();
			$table->string('fluores', 3)->nullable();
			$table->string('jac_uhf', 3)->nullable();
			$table->string('jac_vhf', 3)->nullable();
			$table->string('number', 3)->nullable();
			$table->string('capacity', 3)->nullable();
			$table->string('cover', 3)->nullable();
			$table->string('color', 50)->nullable();
			$table->string('aft_clr', 50)->nullable();
			$table->string('modifieddate', 100);
			$table->integer('status');
			$table->string('usermob', 12);
			$table->string('modifiedby', 25);
			$table->string('dummy', 1);
			$table->string('utc', 50);
			$table->string('userid', 10);
			$table->string('revisestatus', 25);
			$table->string('date', 10);
			$table->string('month', 10);
			$table->integer('year');
			$table->integer('today_date');
			$table->string('mailconfirm', 100);
			$table->string('deptime_cancel', 100);
			$table->string('smsstatus', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ofpl');
	}

}
