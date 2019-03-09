<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FlightPlanDetailsModel extends Model {

    protected $table = "flight_plan_details";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'user_id', 'aircraft_callsign', 'flight_rules', 'flight_type', 'aircraft_type',
        'weight_category', 'equipment', 'transponder', 'departure_aerodrome', 'departure_time_hours', 'departure_time_minutes',
        'crushing_speed_indication', 'crushing_speed', 'flight_level_indication', 'flight_level', 'route', 'destination_aerodrome',
        'total_flying_hours', 'total_flying_minutes', 'first_alternate_aerodrome', 'second_alternate_aerodrome',
        'departure_station', 'departure_latlong', 'destination_station', 'destination_latlong', 'alternate_station',
        'date_of_flight', 'registration', 'endurance_hours', 'endurance_minutes', 'indian', 'foreigner',
        'foreigner_nationality', 'pilot_in_command', 'mobile_number', 'copilot', 'cabincrew', 'operator',
        'sel', 'fir_crossing_time', 'pbn', 'nav', 'code', 'per', 'take_off_altn',
        'route_altn', 'tcas', 'credit', 'no_credit', 'remarks', 'emergency_uhf', 'emergency_vhf',
        'emergency_elba', 'polar', 'desert', 'maritime', 'jungle', 'light', 'floures', 'jacket_uhf', 'jacket_vhf',
        'number', 'capacity', 'cover', 'color', 'aircraft_color', 'fic', 'adc',
        'india_time', 'plan_status', 'filed_date', 'is_active', 'is_delete', 'is_app', 'updated_by',
        'chocks_on', 'chocks_off', 'landing_time', 'airborne_time', 'fuel_value', 'pob','fuel_required','is_etd_changed');

    public static function getAll() {
        $result = FlightPlanDetailsModel::where('is_active', '1')
                ->orderBy('id', 'desc')
                ->orderBy('date_of_flight', 'desc')
                ->orderBy('departure_time_hours', 'desc')
                ->orderBy('departure_time_minutes', 'desc')
                ->get();
        return $result;
    }

    public static function get_fpl_details($id) {
        $result = FlightPlanDetailsModel::where('id', $id)->first();
        return $result;
    }

    public static function delete_record($id) {
        $result = FlightPlanDetailsModel::where('id', $id)->delete();
        return $result;
    }

    public static function get_call_sign_details($aircraft_callsign) {

        if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        }

        $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                ->where('plan_status', '1')
                ->orderBy('id', 'desc')
                ->orderBy('date_of_flight', 'desc')
                ->orderBy('departure_time_hours', 'desc')
                ->orderBy('departure_time_minutes', 'desc')
                ->first();
        return $result;
    }

    public static function get_call_sign_details_by_dof($data, $param = '') {
        $aircraft_callsign = substr($data['aircraft_callsign'], 0, 5);
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $date_of_flight = (array_key_exists('selected_dof', $data)) ? $data['selected_dof'] : '';

        $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                ->where('destination_aerodrome', $departure_aerodrome)
                ->where('date_of_flight', $date_of_flight)
                ->where(function ($query) use ($departure_station, $departure_aerodrome) {
                    if ($departure_station && $departure_aerodrome == 'ZZZZ') {
                        $query->where('destination_station', $departure_station);
                    }
                })
                ->where('plan_status', '1')
                ->orderBy('id', 'desc')
                ->orderBy('date_of_flight', 'desc')
                ->orderBy('departure_time_hours', 'desc')
                ->orderBy('departure_time_minutes', 'desc')
                ->first();
        return $result;
    }

    public static function get_flight_details($data, $get_plan_status = '') {
        $aircraft_callsign = $data['aircraft_callsign'];

        if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        }

        $departure_aerodrome = $data['departure_aerodrome'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                ->where('departure_aerodrome', $departure_aerodrome)
                ->where('destination_aerodrome', $destination_aerodrome)
                ->where('plan_status', '1')
                ->where(function ($query) use ($departure_station, $destination_station, $departure_aerodrome, $destination_aerodrome) {
                    if ($departure_station && $departure_aerodrome == 'ZZZZ') {
                        $query->where('departure_station', $departure_station);
                    }
                    if ($destination_station && $destination_aerodrome == 'ZZZZ') {
                        $query->where('destination_station', $destination_station);
                    }
                })
                ->orderBy('id', 'desc')
                ->orderBy('date_of_flight', 'desc')
                ->orderBy('departure_time_hours', 'desc')
                ->orderBy('departure_time_minutes', 'desc')
                ->first();

        if ($get_plan_status) {
            $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                    ->where('departure_aerodrome', $departure_aerodrome)
                    ->where('destination_aerodrome', $destination_aerodrome)
                    ->where(function ($query) use ($departure_station, $destination_station, $departure_aerodrome, $destination_aerodrome) {
                        if ($departure_station && $departure_aerodrome == 'ZZZZ') {
                            $query->where('departure_station', $departure_station);
                        }
                        if ($destination_station && $destination_aerodrome == 'ZZZZ') {
                            $query->where('destination_station', $destination_station);
                        }
                    })
                    ->orderBy('id', 'desc')
                    ->orderBy('date_of_flight', 'desc')
                    ->orderBy('departure_time_hours', 'desc')
                    ->orderBy('departure_time_minutes', 'desc')
                    ->first(['date_of_flight']);
        }

        return $result;
    }

    public static function get_count_fpl($day = '', $month = '', $year = '', $user = '', $from_date = '', $to_date = '', $date_filter = '') {
        $current_date = date('ymd');
        $from_date = '';
        $to_date = '';
        if ($day != '' && $day != 'cancel') {
            $result = FlightPlanDetailsModel::where('date_of_flight', $current_date)
                    ->where('is_active', '1')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->get();
        } elseif ($month != '') {
            $start_day_month = date("Ym") . "01";
            $last_day_month = date("Ym") . "31";
            $start_day_month = date("ymd", strtotime($start_day_month));
            $last_day_month = date("ymd", strtotime($last_day_month));
            $result = FlightPlanDetailsModel::whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->where('is_active', '1')
                    ->get();
        } elseif ($from_date != '' && $to_date != '') {
            $result = FlightPlanDetailsModel::whereBetween('date_of_flight', [$from_date, $to_date])
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->where('is_active', '1')
                    ->get();
        } elseif ($date_filter != '') {
            $result = FlightPlanDetailsModel::whereBetween('date_of_flight', [$from_date, $to_date])
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->where('is_active', '1')
                    ->get();
        } elseif ($day == 'cancel') {
            $result = FlightPlanDetailsModel::where('is_active', '1')
                    ->where('date_of_flight', $current_date)
                    ->where('plan_status', 2)
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->count();
        } else {
            $result = FlightPlanDetailsModel::where('is_active', '1')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->count();
        }
        return $result;
    }

    public static function get_auto_num_details($data, $cancel = '') {

        $aircraft_callsign = $data['aircraft_callsign'];
        $no_auto_number_array = ['VTVAK', 'VTVAM'];

        if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        }

        $departure_aerodrome = $data['departure_aerodrome'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = date('ymd', strtotime($data['date_of_flight']));
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        if ($cancel) {
            $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('departure_aerodrome', $departure_aerodrome)
                            ->where('destination_aerodrome', $destination_aerodrome)
                            ->where(function ($query) use ($departure_station, $destination_station, $departure_aerodrome, $destination_aerodrome) {
                                if ($departure_station && $departure_aerodrome == 'ZZZZ') {
                                    $query->where('departure_station', $departure_station);
                                }
                                if ($destination_station && $destination_aerodrome == 'ZZZZ') {
                                    $query->where('destination_station', $destination_station);
                                }
                            })
                            ->where('date_of_flight', $date_of_flight)
                            ->where('departure_time_hours', $departure_time_hours)
                            ->where('departure_time_minutes', $departure_time_minutes)
                            ->where('plan_status', '!=', '2')
                            ->orderBy('id', 'desc')->get();
        } else {
            $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('departure_aerodrome', $departure_aerodrome)
                            ->where('destination_aerodrome', $destination_aerodrome)
                            ->where('date_of_flight', $date_of_flight)
                            ->where('plan_status', '!=', '2')
                            ->orderBy('id', 'desc')->get();
            if (in_array($aircraft_callsign, $no_auto_number_array)) {
                $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('date_of_flight', $date_of_flight)
                                ->where('plan_status', '!=', '2')
                                ->orderBy('id', 'desc')->get();
            }
        }
        return $result;
    }

    public static function get_fpl_filter_data($data) {
        $departure_aerodrome = (array_key_exists('departure_aerodrome2', $data)) ? $data['departure_aerodrome2'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome2', $data)) ? $data['destination_aerodrome2'] : '';
//	$date_of_flight = (array_key_exists('date_of_flight', $data)) ? $data['date_of_flight'] : '';
        $aircraft_callsign = (array_key_exists('aircraft_callsign2', $data)) ? $data['aircraft_callsign2'] : '';
        $from_date = (array_key_exists('from_date', $data)) ? $data['from_date'] : '';
        $to_date = (array_key_exists('to_date', $data)) ? $data['to_date'] : '';
        $filter = [];
        $where_fpl_data = "is_active=1 ";
        if ($departure_aerodrome != '') {
            $where_fpl_data .= "AND departure_aerodrome = '$departure_aerodrome'";
        }
        if ($destination_aerodrome != '') {
            $where_fpl_data .= "AND destination_aerodrome = '$destination_aerodrome'";
        }
        if ($aircraft_callsign != '') {
            $where_fpl_data .= "AND aircraft_callsign = '$aircraft_callsign'";
        }
        if ($from_date != '' && $to_date != '') {
            $where_fpl_data .= "AND date_of_flight BETWEEN '$from_date' AND '$to_date'";
        }
//	echo $where_fpl_data ;exit;
        $result = FlightPlanDetailsModel::whereRaw($where_fpl_data)
                ->paginate(25);

        return $result;
    }

    public static function fetch_fpl_records($user_id = '') {
        $current_date = date('ymd');
        $result = FlightPlanDetailsModel::where('is_active', '1')
                ->where('date_of_flight', $current_date)
                ->orderBy('date_of_flight', 'desc')
                ->orderBy('departure_time_hours', 'desc')
                ->orderBy('departure_time_minutes', 'desc')
                ->paginate(25);
//	 $result->setPath('custom/url');
        return $result;
    }

    public static function get_fpl_stats() {
        $current_day = date('ymd');
        $yesterday = date('ymd', strtotime("-1 day"));
        $result = FlightPlanDetailsModel::join('fpl_stats', 'flight_plan_details.id', '=', 'fpl_stats.fpl_id')
                ->where('flight_plan_details.date_of_flight', $yesterday)
                ->where('flight_plan_details.is_active', 1)
                ->where('fpl_stats.revised_by', '=', 0)
//                ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                ->select('fpl_stats.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
                ->get();

        return $result;
    }

    public static function get_fpl_stats2($aircraft_callsign, $from_date, $to_date, $flag, $month = '') {
        $current_day = date('ymd');
        if ($from_date != '' && $to_date != '' & $flag == 'dates') {
            $result = FlightPlanDetailsModel::leftjoin('fpl_stats', 'flight_plan_details.id', '=', 'fpl_stats.fpl_id')
                    ->where('flight_plan_details.date_of_flight', $current_day)
                    ->where('flight_plan_details.is_active', 1)
                    ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                    ->select('fpl_stats.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
                    ->get();
        } else {
            if ($month != '') {
                $start_day_month = date("Ym") . "01";
                $last_day_month = date("Ym") . "31";
                $start_day_month = date("ymd", strtotime($start_day_month));
                $last_day_month = date("ymd", strtotime($last_day_month));
                $result = FlightPlanDetailsModel::leftjoin('fpl_stats', 'flight_plan_details.id', '=', 'fpl_stats.fpl_id')
                        ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                        ->where('flight_plan_details.is_active', 1)
                        ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                        ->select('fpl_stats.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
                        ->get();
            } else {
                $result = FlightPlanDetailsModel::leftjoin('fpl_stats', 'flight_plan_details.id', '=', 'fpl_stats.fpl_id')
                        ->where('flight_plan_details.date_of_flight', $current_day)
                        ->where('flight_plan_details.is_active', 1)
                        ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                        ->select('fpl_stats.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
                        ->get();
            }
        }
        return $result;
    }

    public function handlers()
    {
        return $this->hasOne('App\models\Handler','airport_code','destination_aerodrome');
    }
    public function handlers1()
    {
        return $this->hasOne('App\models\Handler','callsign', 'aircraft_callsign');
    }

}
