<?php

namespace App\Api\Controllers\Stats;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\WebNotificationsModel;
use App\models\FPLStatsModel;
use Response;
use Log;
use Input;
use App\models\FlightPlanDetailsModel;
use PDF;
use App\User;
use App\Jobs\FPLStatsJob;
use Mail;
use App\myfolder\myFunction;
use Illuminate\Support\Facades\DB;
use App\models\lr\LicenseDetailsModel;
use App\models\FPLStatsUIModel;

Class FPLStatsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $customer_id;

    public function __construct() {
        $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "EFLIGHT");
    }

    public function index(Request $request) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
                    . 'is absolutely forbidden for some reason'], 403);
    }

    public function get_fpl_stats(Request $request) {
        try {
            $dof = $request->dof;
            $current_day = date('ymd');
            if ($dof) {
                $yesterday = $dof;
            } else {
                $yesterday = date('ymd', strtotime("-1 day"));
            }

            $revised_count = 0;
            $changed_count = 0;
            $adc_time_diff = 0;
            $get_fpl_stats_data = FlightPlanDetailsModel::get_fpl_stats();
            $subject = "FPL STATS for " . date('d-M-Y', strtotime('20' . $yesterday));
            $adc_delay_text = [];
            foreach ($get_fpl_stats_data as $get_fpl_stats_data) {
                $fpl_id = $get_fpl_stats_data->fpl_id;


                if ($get_fpl_stats_data->revised_by != 0) {
                    $revised_count++;
                }
                if ($get_fpl_stats_data->changed_by != 0) {
                    $changed_count++;
                }
                $adc_updated_by = $get_fpl_stats_data->adc_updated_by;
                $adc_updated_time = $get_fpl_stats_data->adc_updated_time;
                $adc_updated_time = date("Hi", strtotime($adc_updated_time));
                $departure_time = $get_fpl_stats_data->departure_time_hours . $get_fpl_stats_data->departure_time_minutes;
                if ($adc_updated_by) {
                    $diff_time = (strtotime($departure_time) - strtotime($adc_updated_time)) / 60;
                    $diff_time2 = (strtotime($departure_time) < strtotime($adc_updated_time)) / 60;
                    if ($diff_time < 15 || $diff_time2 > 0) {
                        $adc_time_diff++;

                        $fpl_stats_data = FlightPlanDetailsModel::where('id', $fpl_id)
                                ->first(['aircraft_callsign', 'departure_aerodrome',
                            'destination_aerodrome', 'departure_station', 'destination_station']);
                        $fpl_stats_aircraft_callsign = ($fpl_stats_data) ? $fpl_stats_data->aircraft_callsign : '';
                        $fpl_stats_departure_aerodrome = ($fpl_stats_data) ? $fpl_stats_data->departure_aerodrome : '';
                        $fpl_stats_destination_aerodrome = ($fpl_stats_data) ? $fpl_stats_data->destination_aerodrome : '';

                        $fpl_stats_departure_station = ($fpl_stats_data) ? $fpl_stats_data->departure_station : '';
                        $fpl_stats_destination_station = ($fpl_stats_data) ? $fpl_stats_data->destination_station : '';

                        if ($fpl_stats_departure_aerodrome == 'ZZZZ') {
                            $fpl_stats_departure_aerodrome = $fpl_stats_departure_station;
                        }
                        if ($fpl_stats_destination_aerodrome == 'ZZZZ') {
                            $fpl_stats_destination_aerodrome = $fpl_stats_destination_station;
                        }

                        $adc_updated_user = \App\User::where('id', $adc_updated_by)->first(['name']);
                        $adc_updated_by = ($adc_updated_user) ? $adc_updated_user->name : "";
                        $adc_delay_text[] = "$fpl_stats_aircraft_callsign  
                                <span style='padding-left:18px'>From: $fpl_stats_departure_aerodrome</span>
                                <span style='padding-left:18px'>To: $fpl_stats_destination_aerodrome</span>
                                <span style='padding-left:18px'>DEPT: $departure_time</span>
                                <span style='padding-left:18px'>ADC: $adc_updated_time</span>
                                <span style='padding-left:18px'>BY: $adc_updated_by</span>";
                    }
                }
            }

            $revised_count = WebNotificationsModel::get_fpl_notifications($yesterday, '1');
            $changed_count2 = WebNotificationsModel::get_fpl_notifications($yesterday);

            if ($changed_count2) {
                $changed_count = $changed_count2;
            }

            $get_day_count_fpl = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                            ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')->count();

            $get_fpl_count_by_app = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                            ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                            ->where('is_app', '1')->count();

            $get_cancel_fpl_count = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                            ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                            ->where('plan_status', '2')->count();

            $get_fpl_stats_ui = FPLStatsUIModel::get_all();

            $helicopter_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->helicopter_plans : '';
            $helicopter_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $helicopter_list);
            $helicopter_list = str_replace("'", "", $helicopter_list);
            $helicopter_list = explode(",", $helicopter_list);

            $navlog_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->navlog_plans : '';
            $navlog_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $navlog_list);
            $navlog_list = str_replace("'", "", $navlog_list);
            $navlog_list = explode(",", $navlog_list);

            $weather_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->weather_plans : '';
            $weather_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $weather_list);
            $weather_list = str_replace("'", "", $weather_list);
            $weather_list = explode(",", $weather_list);

            $lnt_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->lnt_plans : '';
            $lnt_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $lnt_list);
            $lnt_list = str_replace("'", "", $lnt_list);
            $lnt_list = explode(",", $lnt_list);

            $runway_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->runway_plans : '';
            $runway_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $runway_list);
            $runway_list = str_replace("'", "", $runway_list);
            $runway_list = explode(",", $runway_list);

            $helicopter_plans = FlightPlanDetailsModel::where('is_active', '1')
                    ->where('date_of_flight', $yesterday)
                    ->where('plan_status', '1')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->whereIN('aircraft_type', $helicopter_list)
                    ->count();

            $helicopter_cancelled_plans = FlightPlanDetailsModel::where('is_active', '1')
                    ->where('date_of_flight', $yesterday)
                    ->where('plan_status', '2')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->whereIN('aircraft_type', $helicopter_list)
                    ->count();

            $helicopter_total_plans = $helicopter_plans + $helicopter_cancelled_plans;

            $fixed_wing_plans = ($get_day_count_fpl - $get_cancel_fpl_count) - $helicopter_plans;
            $fixed_wing_cancelled_plans = $get_cancel_fpl_count - $helicopter_cancelled_plans;
            $fixed_wing_total_plans = $get_day_count_fpl - $helicopter_total_plans;

            $whether_plans = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('plan_status', '1')
                            ->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $weather_list)->count();

            $navlog_plans = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('plan_status', '1')
                            ->where(function($query) use($navlog_list) {
                                $query->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $navlog_list);
                                $query->orWhere(function($query2) {
                                    $query2->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,6)"), ['ZOM101', 'ZOM301']);
                                });
                            })->count();

            $lnt_plans = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('plan_status', '1')
                            ->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $lnt_list)->count();

            $runway_plans = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $yesterday)
                            ->where('plan_status', '1')
                            ->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $runway_list)->count();

            $data = ['get_day_count_fpl' => $get_day_count_fpl,
                'get_fpl_count_by_app' => $get_fpl_count_by_app,
                'get_cancel_fpl_count' => $get_cancel_fpl_count,
                'revised_count' => $revised_count,
                'changed_count' => $changed_count,
                'adc_time_diff' => $adc_time_diff,
                'adc_delay_text' => $adc_delay_text,
                'helicopter_plans' => $helicopter_plans,
                'fixed_wing_plans' => $fixed_wing_plans,
                'whether_plans' => $whether_plans,
                'navlog_plans' => $navlog_plans,
                'lnt_plans' => $lnt_plans,
                'runway_plans' => $runway_plans,
                'helicopter_cancelled_plans' => $helicopter_cancelled_plans,
                'fixed_wing_cancelled_plans' => $fixed_wing_cancelled_plans,
                'helicopter_total_plans' => $helicopter_total_plans,
                'fixed_wing_total_plans' => $fixed_wing_total_plans,
                'subject' => $subject
            ];
            Log::info('Stats job started');
            $this->dispatch(new FPLStatsJob($data));
            Log::info('Stats job ended');
            return 'success';
        } catch (\Exception $e) {
            Log::info('Stats ' . $e->getMessage() . ' Line ' . $e->getLine());
        }
    }

    public function auto_remainder(Request $request) {
        try {
            $data = [];
            $current_date = date('ymd');
            $current_date2 = date('d-M-Y');
            $due_result = LicenseDetailsModel::get_due_records();
            foreach ($due_result as $due_result_value) {
                $email = strtolower($due_result_value->email);
                $user_data = User::where('email', $email)->first(['name']);
                $user_name = ($user_data) ? $user_data->name : '';
                $due_result = LicenseDetailsModel::get_due_records2($due_result_value->email);
                $data['subject'] = "$user_name LICENSE EXPIRY REMINDER // $current_date2"; //"$user_name Due Licenses";
                $data['due_result'] = $due_result;
                $data['email'] = $email;
                Log::info('auto_remainder Starts');
                dispatch(new \App\Jobs\Lr\AutoRemainderEmailJob($data));
                Log::info('auto_remainder Ends');
            }

            return 'success';
        } catch (\Exception $ex) {
            Log::info('test_email: ' . $ex->getMessage());
        }
    }

    public function operator_auto_remainder(Request $request) {
        try {
            $data = [];
            $current_date = date('ymd');
            $current_date2 = date('d-M-Y');
            $due_result = LicenseDetailsModel::get_operator_due_records();
            foreach ($due_result as $key=>$due_result_value) {  
               //if($key==5){ 
                    $email = strtolower($due_result_value->email);
                    $user_data = User::where('email', $email)->first(['name','additional_emails']);
                    $user_name = ($user_data) ? $user_data->name : '';
                    $additional_emails = ($user_data) ? $user_data->additional_emails : '';
                    $due_result = LicenseDetailsModel::get_operator_due_records2($due_result_value->email);
                    $data['subject'] = "$user_name OPERATOR LICENSE EXPIRY REMINDER // $current_date2"; //"$user_name Due Licenses";
                    $data['due_result'] = $due_result;
                    if($additional_emails !="" && $additional_emails){
                    $data['email'] = ["$email","$additional_emails"];
                    }else{
                    $data['email'] = $email;    
                    }
                    if($email=="flightops@flyjupiter.com")
                      $data['email'][]='dgm.ops@flyjupiter.com';
                    if(count($due_result)>0){
                        Log::info('auto_remainder Starts');
                        dispatch(new \App\Jobs\Lr\OperatorAutoEmailJob($data));
                        Log::info('auto_remainder Ends');
                    }
              // } 
            }
            return 'success';
        } catch (\Exception $ex) {
            Log::info('Operator auto remainder: ' . $ex->getMessage());
        }
    }

}
