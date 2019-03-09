<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Station_Addresses_model extends Model
{
    protected $table = "station_addresses";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'chennai', 'mumbai', 'kolkata', 'delhi');
	
	public static function get_station_addresses1() {
        $result = Station_Addresses_model::where('id', '=', '1')->first();
        return $result;
    }
	
	public static function get_station_addresses2() {
        $result = Station_Addresses_model::where('id', '=', '2')->first();
        return $result;
    }
	
	public static function get_station_addresses3() {
        $result = Station_Addresses_model::where('id', '=', '3')->first();
        return $result;
    }
	
}
