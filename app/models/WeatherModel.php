<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WeatherModel extends Model {

    protected $table = "weather";
    protected $primaryKey = "id_weather";
    public $timestamps = true;        

    public static function get_fpl_details($id) {
		$result = FlightPlanDetailsModel::where('id', $id)->first();
		return $result;
    }

    public static function delete_record($id) {
		$result = FlightPlanDetailsModel::where('id', $id)->delete();
		return $result;
    }

    public static function get_call_sign_details($aircraft_callsign) {
		$aircraft_callsign = substr($aircraft_callsign, 0, 5);
		$result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
			->orderBy('id', 'desc')
			->orderBy('date_of_flight', 'desc')
			->orderBy('departure_time_hours', 'desc')
			->orderBy('departure_time_minutes', 'desc')
			->first();
		return $result;
    }   
	
	public static function getAirports($searchString)
	{	
		$result = DB::table('weather')->select('state')->where('state', 'like', '%'.$searchString.'%')->get();
		//$result = DB::select("select `state` from weather where `state` like '%".$searchString."%' ");
		return $result;
	}
	
	public static function getAirportInformation($location)
	{
		$result = DB::table('weather')->where('state', $location)->get();		
		return $result;
	}
}