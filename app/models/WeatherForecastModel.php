<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WeatherForecastModel extends Model {     
	
	public static function getAirports($searchString)
	{
		$result = DB::table('weather')->select('state')->where('state', 'like', '%'.$searchString.'%')->get();
		return $result;
	}
	
	public static function getAirportInformation($location)
	{ 
		if (strpos($location, 'Hyderabad') !== false || strpos($location, 'Bangalore') !== false) {
			$locationArray = explode(' ', $location);
			$location = $locationArray[0];
			$result = DB::table('weather')->where('state', $location)->first();
		}	
		$result = DB::table('weather')->where('state', $location)->get();
		return $result;
	}
}