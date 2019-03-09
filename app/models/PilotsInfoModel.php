<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PilotsInfoModel extends Model {

    protected $table = "pilots_info";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'aircraft_callsign', 'pilot_id', 'copilot_id','client_ops_id','ops_staff_id', 'is_active');

    public static function get_all() {
	return PilotsInfoModel::where('is_active', '1')->get();
    }

    public static function pilot_in_command($aircraft_callsign, $term) {
	$result = PilotsInfoModel::leftJoin('pilot_master', 'pilot_master.id', '=', 'pilots_info.pilot_id')
		->where('aircraft_callsign', $aircraft_callsign)
		->distinct('pilot_master.name')
		->orderBy('pilot_master.name', 'asc')
		->select('pilot_master.name')
		->get();
	return $result;
    }

    public static function get_pilot_details($pilot) {
	$result = PilotsInfoModel::where('pilot', '=', $pilot)->first();
	return $result;
    }

    public static function copilot($aircraft_callsign, $term) {
	$result = PilotsInfoModel::leftJoin('pilot_master', 'pilot_master.id', '=', 'pilots_info.copilot_id')
		->where('aircraft_callsign', $aircraft_callsign)
		->distinct('pilot_master.name')
		->orderBy('pilot_master.name', 'asc')
		->select('pilot_master.name')
		->get();
	return $result;
    }

    public static function get_pilots($aircraft_callsign) {
	$result = PilotsInfoModel::where('aircraft_callsign', 'LIKE', $aircraft_callsign . '%')
			->where('is_active', '1')->distinct()->orderBy('pilot', 'asc')->get(array('pilot'));
	return $result;
    }

    public static function get_all_pilots_info() {
	return PilotsInfoModel::where('is_active', '1')->get();
    }

    public static function get_callsign_pilots_info() {
	$result = PilotsInfoModel::leftJoin('pilot_master', 'pilots_info.pilot_id', '=', 'pilot_master.id')
		->where('pilot_master.is_active', 1)
		->orderBy('aircraft_callsign', 'ASC')
		->select('pilots_info.id', 'pilots_info.aircraft_callsign', 'pilots_info.pilot_id', 'pilots_info.copilot_id')
		->paginate(25);
	return $result;
    }

    public static function get_callsign_pilot($id) {
	$result = PilotsInfoModel::leftJoin('pilot_master as p', 'pilots_info.pilot_id', '=', 'p.id')
			->orderBy('aircraft_callsign', 'ASC')
			->select('pilots_info.id as id', 'aircraft_callsign', 'p.name as name', 
				 'p.mobile_number as mobile_number', 'p.email as email','p.is_pilot as is_pilot'
				,'p.is_copilot as is_copilot','p.is_active as is_active'
				)
			->where('pilots_info.id', $id)->first();
	return $result;
    }

}
