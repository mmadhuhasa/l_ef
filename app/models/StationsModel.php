<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StationsModel extends Model {

    protected $table = "stations";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'aero_id', 'aero_name', 'aero_latlong', 'elevation', 'runways', 'length', 'status', 'is_active');

    public static function fetch_stations($term) {
	return $queries = StationsModel::where('is_active', 1)->where('aero_name', 'LIKE', $term . '%')->distinct()->orderBy('aero_name', 'asc')->take(10)->get(array('aero_name'));
	//return $queries = stations::where('aero_name','=',$term)->distinct()->orderBy('aero_name','asc')->take(10)->get(array('aero_name'));  	
    }

    public static function get_aerodrome_details($aerodrome, $station = '') {
	return $queries = StationsModel::where('is_active', 1)
		->where('aero_id', '=', $aerodrome)
		->where(function($query) use($station) {
		    if ($station) {
			$query->where('aero_name', $station);
		    }
		})
		->first();
    }

    public static function get_station_latlong($station) {
	return $queries = StationsModel::where('is_active', 1)->where('aero_name', '=', $station)->first();
    }

    public static function fetch_stations_and_latlong() {
	return $queries = StationsModel::where('is_active', '1')->distinct()->orderBy('aero_name', 'asc')->get(array('aero_name', 'aero_latlong'));
	//return $queries = stations::where('aero_name','=',$term)->distinct()->orderBy('aero_name','asc')->take(10)->get(array('aero_name'));  	
    }

    public static function get_airport_names($term) {
	$result = StationsModel::where('is_active', 1)
			->where('aero_id', 'LIKE', $term . '%')
			->where('aero_id', '!=', 'ZZZZ')
			->orWhere(function($query) use($term) {
			    $query->where('aero_name', 'LIKE', $term . '%');
			    $query->where('aero_id', '!=', 'ZZZZ');
			})
			->distinct()
			->orderBy('aero_name', 'asc')
			->take(10)->get();
	return $result;
    }

    public static function get_airport_names_app() {
	$result = StationsModel::where('aero_id', '!=', 'ZZZZ')
		->where('is_active', '1')
		->distinct()
		->orderBy('aero_name', 'asc')
		->get(['aero_id', 'aero_name']);
	return $result;
    }

}
