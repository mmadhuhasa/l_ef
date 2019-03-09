<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PilotDetailsModel extends Model {

    protected $table = "pilot_details";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'callsign', 'pilot', 'mobile', 'copilot', 'copilot_mob');

    public static function get_all(){
	return PilotDetailsModel::where('is_active','1')->paginate(25);
    }

    public static function pilot_in_command($callsign, $term) {
        $result = PilotDetailsModel::where('callsign', $callsign)
              ->distinct('pilot')->orderBy('pilot', 'asc')->take(10)->get(array('pilot'));
        return $result;
    }

    public static function get_pilot_details($pilot) {
        $result = PilotDetailsModel::where('pilot', '=', $pilot)->first();
        return $result;
    }
    
    public static function copilot($callsign, $term) {
       $result = PilotDetailsModel::where('callsign', $callsign)
                ->distinct('copilot')->orderBy('copilot', 'asc')->take(10)->get(array('copilot'));
        return $result;
    }
    
    public static function get_pilots($aircraft_callsign) {
        $result = PilotDetailsModel::where('callsign', 'LIKE', $aircraft_callsign . '%')
                  ->where('is_active', '1')->distinct()->orderBy('pilot', 'asc')->get(array('pilot'));
        return $result;
    }

}
