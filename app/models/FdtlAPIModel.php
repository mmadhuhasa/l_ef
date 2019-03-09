<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FdtlAPIModel extends Model {

    protected $table = "fdtl_api_details";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'user_id', 'current_landing', 'aircraft_callsign', 'date_of_flight', 'departure_aerodrome', 'destination_aerodrome', 'departure_time', 'total_flying_time', 'dep_time_total_time', 'reporting_time', 'flight_time', 'chocks_off', 'chocks_on', 'duty_end_time', 'flight_duty_period', 'split_duty', 'is_split_duty', 'total_ft', 'is_total_ft', 'total_flight_duty_period', 'is_total_fdp', 'today_next_plan_last_dep_time', 'today_last_duty_end_time', 'next_day_earliest_dep_time');

    public static function get_first_plan_data($data) {
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];

        $result = FdtlAPIModel::where('aircraft_callsign', $aircraft_callsign)
//               ->where('destination_aerodrome',$departure_aerodrome)
                ->orderBy('id', 'desc')
                ->first();
        return $result;
    }

    public static function get_previous_plan_data($data) {
        $id = $data['id'];
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];

        $result = FdtlAPIModel::where('aircraft_callsign', $aircraft_callsign)
                ->where('user_id', $id)
                ->orderBy('id', 'desc')
                ->take(6)
                ->get();
        return $result;
    }

}
