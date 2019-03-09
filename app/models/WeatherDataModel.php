<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class WeatherDataModel extends Model {

    protected $table = 'weather_data';
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'station_id', 'airport_name', 'airport_code', 'raw_report', 'time', 'wind_speed', 'wind_direction', 'wind_gusting', 'visibility_distance',
	'wind_variable', 'visibility_condition', 'rvr', 'cloude1_type', 'cloude1_height', 'is_active', 'created_at', 'updated_at');

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    public static $instance;
    public static $counter = 0;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance() {
	if (!isset(WeatherDataModel::$instance)) {
	    WeatherDataModel::$instance = new WebNotificationsModel();
	}

	return WeatherDataModel::$instance;
    }

    public static function get_all() {
	return WeatherDataModel::where('is_active', 1)->get();
    }

    public static function list_of_raw_data() {
	$result = WeatherDataModel::leftJoin('stations', 'weather_data.station_id', '=', 'stations.id')
		->where('weather_data.is_active', 1)
		->where('weather_data.airport_code', '!=', '')
		->distinct('weather_data.airport_code')
		->orderBy('weather_data.id', 'desc')		
		->select('weather_data.raw_report','stations.aero_name')
		->get();
	return $result;
    }

}
