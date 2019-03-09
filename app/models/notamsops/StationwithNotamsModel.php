<?php

namespace App\models\notamsops;

use Illuminate\Database\Eloquent\Model;

class StationwithNotamsModel extends Model {

    protected $table = "stations_with_notams";
    protected $primarykey = "id";
    public $timestamps = true;
  
    public static function get_airport_names_based_on_fir($fir) {
	$result = StationwithNotamsModel::where('aero_id', 'like', $fir)
		->where('is_active', '1')
		->distinct()
		->orderBy('aero_id', 'asc')
		->get(['aero_id', 'aero_name']);
	return $result;
    }
    
    
}
