<?php

namespace App\models\loadtrim;

/**
 * 
 */
use Illuminate\Database\Eloquent\Model;

class LoadtrimModel extends Model {

    protected $table = 'load_trim_info';
    protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll() {
        $result = LoadtrimModel::get();
        return $result;
    }

    public static function update_fpl_id($data) {
//        print_r($data);exit;
        $fpl_id = (array_key_exists('fpl_id', $data)) ? $data['fpl_id'] : '';
        $aircraft_callsign = $data['aircraft_callsign'];
        if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        }
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $dep_time = $departure_time_hours.$departure_time_minutes;

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        $date_of_flight = (array_key_exists('date_of_flight', $data)) ? $data['date_of_flight'] : '';

        $result = self::where('callsign','LIKE', $aircraft_callsign)
                        ->where('departure_aerodrome', $departure_aerodrome)
                        ->where('destination_aerodrome', $destination_aerodrome)
                        ->where('date_of_flight', $date_of_flight)
                        ->where('dep_time', $dep_time)->update(['fpl_id' => $fpl_id]);
        return $result;
    }

}

?>