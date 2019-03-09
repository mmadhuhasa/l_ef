<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		// $this->call(UserTableSeeder::class);

		$this->call('UsersTableSeeder');
		$this->call('FlightPlanDetailsTableSeeder');
		$this->call('StationAddressesTableSeeder');
		$this->call('WatchHoursTableSeeder');
		$this->call('NotificationActionsTableSeeder');
		$this->call('LoadTrimReferenceTableSeeder');
		$this->call('MacTrimTableSeeder');
		$this->call('DesignationsTableSeeder');
		$this->call('SupportMailsTableSeeder');
		$this->call('PilotMasterTableSeeder');
		$this->call('PilotsInfoTableSeeder');
		$this->call('LntVtajjReferenceTableSeeder');
		$this->call('CallsignInfoTableSeeder');
		$this->call('StationsTableSeeder');
		$this->call('FdtlStaticTimeTableSeeder');
		$this->call('TransportTimeTableSeeder');
		$this->call('DayNightTimingsTableSeeder');
		$this->call('TotalFtTableSeeder');
		$this->call('TotalFdpTableSeeder');
		$this->call('FirstLandingTableSeeder');
		$this->call('UserRoles');

		Model::reguard();

	    $this->call('LrLicenseTypesTableSeeder');
        $this->call('LrLicenseDetailsTableSeeder');
    }
}
