<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LntDataModel extends Model {

    protected $table = 'lnt_data';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','aircraft_callsign', 'date_of_flight', 'departure_aerodrome', 'destination_aerodrome', 'departure_time', 'pilot_in_command',
	'copilot', 'jump', 'weight5', 'weight6', 'weight7', 'weight8', 'weight9', 'weight10', 'weight11', 'weight12', 'weight13',
	'weight14', 'weight15', 'weight16', 'weight17', 'moment5', 'moment6', 'moment7', 'moment8', 'moment9', 'moment10', 'moment11',
	'moment12', 'moment13', 'moment14', 'moment15', 'moment16', 'moment17', 'no_of_pax', 'no_of_adults', 'no_of_infants', 'fc',
	'bags', 'take_off_fuel', 'landing_fuel', 'zero_fuel_weight', 'take_off_fuel_weight', 'landing_fuel_weight', 'zero_fuel_cg',
	'take_off_fuel_cg', 'landing_fuel_cg', 'trim_setting','landing_fuel_trim_setting', 'is_active'];

}
