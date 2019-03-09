<?php

namespace App\Http\Controllers\fpl;

use App\Exceptions\customException;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditPlanRequest;
use App\Http\Requests\FullPlanRequest;
use App\Jobs\EquipmentChangeEmailJob;
use App\Jobs\FlightRuleChangeEmailJob;
use App\Jobs\FlyingTimeChangeEmailJob;
use App\Jobs\OtherChangesEmailJob;
use App\Jobs\SpeedChangeEmailJob;
use App\models\FlightPlanDetailsModel;
use App\models\PilotMasterModel;
use App\models\PilotsInfoModel;
use App\models\StationsModel;
use App\models\WatchHoursModel;
use App\models\WebNotificationsModel;
use App\myfolder\myFunction;
use Auth;
use Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;
use Input;
use Log;
use Mail;
use PDF;
use Redirect;
use Response;
use Crypt;
use App\models\CallsignInfoModel;
use App\models\FPLStatsModel;
use App\models\loadtrim\LoadtrimModel;

class fplController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $user_id;
    public $user_name;
    public $user_email;
    public $is_admin;

    public function __construct() {
        $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
        $this->user_id = Auth::user()->id;
        $this->user_name = Auth::user()->name;
        $this->user_email = Auth::user()->email;
        $this->is_admin = Auth::user()->is_admin;
    }

    public function index(Request $request) {
        try {
            $page = $request->page;
            $id = $request->id;
            $key = $request->_key;
            $cs = $request->_cs;
            $is_navlog = Auth::user()->is_navlog;
            
//            if(!$this->is_admin && $is_navlog){
//              return redirect::to('/navlog');  
//            }
            
            if ($key) {
                $id = Crypt::decrypt($key);
            }

            $quick_id = $request->quick_id;
            $change_fpl_id = $request->change_fpl_id;
            if ($quick_id) {
                $result = FlightPlanDetailsModel::find($quick_id);
                $fpl_json_encode = json_encode($result);
                $data[] = array();
                $data = json_decode($fpl_json_encode, TRUE);
                $data['route1'] = '';
                $data['remarks1'] = '';
                $data['callsign'] = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
                $data['is_myaccount'] = '1';
                $data['is_id'] = $quick_id;
                $data['success'] = 'FPL SUBMITTED SUCCESSFULLY';
                $data['is_plan_filed'] = 1;
                return redirect::to('fpl')->with($data);
            }

            if ($id) {
//		$id = $request->id;
                $fpl_details = FlightPlanDetailsModel::find($id);
                $fpl_json_encode = json_encode($fpl_details);
                $data[] = array();
                $data = json_decode($fpl_json_encode, TRUE);
                $equipment = $data['equipment'];
                if(strpos($equipment, "/") != FALSE){
                    $data['transponder'] = "Transponder Mode";
                }
                $data['route1'] = '';
                $data['remarks1'] = '';
                $data['callsign'] = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
                $data['is_myaccount'] = '1';
                $data['is_id'] = $id;
                return view('fpl.new_full_fpl', $data);
            }

            if ($change_fpl_id) {
                $result = FlightPlanDetailsModel::find($change_fpl_id);
                $aircraft_callsign = $result->aircraft_callsign;
                $data['success'] = $aircraft_callsign . ' FLIGHT PLAN DETAILS CHANGED SUCCESSFULLY';
                return redirect::to('fpl')->with($data);
            }

            switch ($page) {
//		case 'new_plan':
                //		    return view('fpl.new_fpl');
                //		    break;
                //		case 'quick_plan':
                //		    return view('fpl.quick_fpl');
                //		    break;
                case 'edit_plan':
                    return view('fpl.new_edit_fpl');
                    break;
                case 'new_full_fpl':
                    $data[] = array();
                    if ($cs) {
                        $result = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $cs . '%')
                                        ->where('plan_status', 1)
                                        ->orderBy('id', 'desc')->first();
                        if ($result) {
                            $fpl_json_encode = json_encode($result);
                            $data = json_decode($fpl_json_encode, TRUE);
                            unset($data['date_of_flight']);
                        } else {
                            $data = ($result) ? json_decode($fpl_json_encode, TRUE) : [];
                        }
                    }
                    return view('fpl.new_full_fpl', $data);
                    break;

                case 'edit_plan2':
                    return view('fpl.new_edit_fpl2');
                    break;

                case 'new_quick_fpl2':
                    return view('fpl.new_quick_fpl2');
                    break;

                default:
                    $data = [];
                    return view('fpl.new_quick_fpl', $data);
                    break;
            }
        } catch (\Exception $ex) {
            Log::error('Fpl Controller Index : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller Index : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $flag = $request->flag;
            $inputs = $request->all();
//        print_r($inputs);exit;
            $new_plan = $request->is_new_plan;
            switch ($flag) {
                case 'File':
                    $result = $this->file_the_process($inputs);
//                echo $result;exit;
                    if ($result) {
                        return redirect::to('fpl')->with('success', 'FPL SUBMITTED SUCCESSFULLY')
                                        ->with('id', $result->id)
                                        ->with('file_name', $result->file_name)
                                        ->with('pdf_path', $result->pdf_path)
                                        ->with('departure_aerodrome', $result->departure_aerodrome)
                                        ->with('destination_aerodrome', $result->destination_aerodrome)
                                        ->with('date_of_flight', $result->date_of_flight)
                                        ->with('aircraft_callsign', $result->aircraft_callsign)
                                        ->with('pilot_in_command', $result->pilot_in_command)
                                        ->with('mobile_number', $result->mobile_number)
                                        ->with('copilot', $result->copilot)
                                        ->with('cabincrew', $result->cabincrew)
                                        ->with('departure_station', $result->departure_station)
                                        ->with('departure_latlong', $result->departure_latlong)
                                        ->with('destination_station', $result->destination_station)
                                        ->with('destination_latlong', $result->destination_latlong)
                                        ->with('is_plan_filed', '1')
                        ;
                    } else {
                        return redirect::to('fpl')->with('error', 'Something went wrong!');
                    }
                    break;
                case 'Edit':
                    if ($new_plan) {
                        $result = 1;
                        if ($result) {
                            return view('fpl.new_full_fpl', $inputs);
                        } else {
                            return Redirect::back()->with('error', 'Something went wrong!');
                        }
                    } else {
                        $result = $this->on_edit_plan($inputs);
                        if ($result) {
                            return view('fpl.new_edit_fpl', $result);
                        } else {
                            return Redirect::back()->with('error', 'Something went wrong!');
                        }
                    }
                    break;
                case 'Process':

                    $check_flight_details = FlightPlanDetailsModel::get_flight_details($inputs);

                    if (!$check_flight_details) {
                        $result = $this->process_quick_plan($inputs, 'edit_page');
                        return view('fpl.new_edit_fpl', $result);
                    } else {

                        $result = $this->process_quick_plan($inputs);
//                         echo 'khtml'.$result;exit;
                        if ($result) {
                            return view('fpl.new_quick_fpl', $result);
                        } else {
                            return Redirect::back()->with('error', 'Something went wrong!');
                        }
                    }
                    break;

                case 'search':

                    $input = $request->all();
//	print_r($input);exit;
                    $get_all = FlightPlanDetailsModel::get_fpl_filter_data($input);
//	$get_all->setPath('custom/url?from_date=' . $request->from_date);
                    $get_day_count_fpl = count($get_all);
                    $get_month_count_fpl = count($get_all);
                    $get_year_count_fpl = count($get_all);
                    $get_total_count_fpl = count($get_all);
                    $get_dates_count_fpl = count($get_all);
                    $get_user_count_fpl = count($get_all);

                    $data = ['get_all' => $get_all,
                        'get_day_count_fpl' => $get_day_count_fpl,
                        'get_month_count_fpl' => $get_month_count_fpl,
                        'get_year_count_fpl' => $get_year_count_fpl,
                        'get_total_count_fpl' => $get_total_count_fpl,
                        'get_dates_count_fpl' => $get_dates_count_fpl,
                        'get_user_count_fpl' => $get_user_count_fpl,
                        'input_data' => $input,
                    ];
//	print_r($get_filter_data);exit;
                    return view('fpl.new_quick_fpl', $data);
                    break;
                default:
                    break;
            }
        } catch (\Exception $ex) {
            Log::error('Fpl Controller store function: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller store : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function get_callsign_details(Request $request) {
        try {
            $aircraft_callsign = $request->aircraft_callsign;
            $selected_dof = $request->selected_dof;
            $date_of_flight = $selected_dof;
            $result = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);

//	    $data = $request->all();
            // print_r($data);exit;
//	    $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);

            $pilot_in_command = ($result) ? $result->pilot_in_command : '';
            $mobile_number = ($result) ? $result->mobile_number : '';
            $copilot = ($result) ? $result->copilot : '';
            $cabincrew = ($result) ? $result->cabincrew : '';
            $departure_aerodrome = ($result) ? $result->destination_aerodrome : '';
            $departure_station = ($result) ? $result->departure_station : '';
            $departure_latlong = ($result) ? $result->departure_latlong : '';
            $destination_station = ($result) ? $result->destination_station : '';
            $destination_latlong = ($result) ? $result->destination_latlong : '';
//	    if ($result_dof) {
//		// $date_of_flight = ($result_dof) ? $result_dof->date_of_flight : '';
//		$departure_time_hours = ($result_dof) ? $result_dof->departure_time_hours : '';
//		$departure_time_minutes = ($result_dof) ? $result_dof->departure_time_minutes : '';
//		$total_flying_hours = ($result_dof) ? $result_dof->total_flying_hours : '';
//		$total_flying_minutes = ($result_dof) ? $result_dof->total_flying_minutes : '';
//	    } else {
            // $date_of_flight = ($result) ? $result->date_of_flight : '';
            $departure_time_hours = ($result) ? $result->departure_time_hours : '';
            $departure_time_minutes = ($result) ? $result->departure_time_minutes : '';
            $total_flying_hours = ($result) ? $result->total_flying_hours : '';
            $total_flying_minutes = ($result) ? $result->total_flying_minutes : '';
//	    }
//	    $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours . ":" . $departure_time_minutes));
//	    $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours . ":" . $total_flying_minutes));
//
//	    $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
//	    $total_time_after_flying = gmdate('ymd:H:i', strtotime($res_time1) + $secs);
//	    if (!$result_dof) {
//		$total_time_after_flying = gmdate('ymd:H:i');
//	    }
//	    $total_flying_time_format1 = gmdate('H:i', strtotime($res_time1) + $secs);
//	    $total_flying_time_format2 = gmdate('jS M', strtotime($res_time1) + $secs);

            return response::json(['aircraft_callsign' => $aircraft_callsign,
                        'pilot_in_command' => $pilot_in_command,
                        'mobile_number' => $mobile_number,
                        'copilot' => $copilot,
                        'cabincrew' => $cabincrew,
                        'departure_aerodrome' => $departure_aerodrome,
                        'departure_station' => $departure_station,
                        'departure_latlong' => $departure_latlong,
                        'destination_station' => $destination_station,
                        'destination_latlong' => $destination_latlong,
//			'total_time_after_flying' => $total_time_after_flying,
//			'total_flying_time_format1' => $total_flying_time_format1,
//			'total_flying_time_format2' => $total_flying_time_format2, 'is_result_dof' => ($result_dof) ? '1' : '',
            ]);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller get_callsign_details function: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller get_callsign_details : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function get_callsign_details2(Request $request) {
        try {
            $aircraft_callsign = $request->aircraft_callsign;
            $selected_dof = $request->selected_dof;
            $date_of_flight = $selected_dof;

            $data = $request->all();
            // print_r($data);exit;
            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);
            // $date_of_flight = ($result_dof) ? $result_dof->date_of_flight : '';
            $departure_time_hours = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes = ($result_dof) ? $result_dof->total_flying_minutes : '';

            $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours . ":" . $departure_time_minutes));
            $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours . ":" . $total_flying_minutes));

            $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
            $total_time_after_flying = gmdate('ymd:H:i', strtotime($res_time1) + $secs);

            if (!$result_dof) {
                $total_time_after_flying = gmdate('ymd:H:i');
            }

            $total_flying_time_format1 = gmdate('H:i', strtotime($res_time1) + $secs);
            $total_flying_time_format2 = gmdate('jS M', strtotime($res_time1) + $secs);

            return response::json(['aircraft_callsign' => $aircraft_callsign,
                        'total_time_after_flying' => $total_time_after_flying,
                        'total_flying_time_format1' => $total_flying_time_format1,
                        'total_flying_time_format2' => $total_flying_time_format2, 'is_result_dof' => ($result_dof) ? '1' : '',
            ]);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller get_callsign_details function: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller get_callsign_details : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function stations_autocomplete(Request $request) {
        try {
            $results = array();
            $term = Input::get('term');
            $queries = StationsModel::fetch_stations($term);
            foreach ($queries as $query) {
                $results[] = ['value' => $query->aero_name];
            }
            return Response::json($results);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller stations_autocomplete: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller stations_autocomplete : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function station_latlong(Request $request) {
        try {
            $station_name = $request->station_name;
            $station_latlong = StationsModel::get_station_latlong($station_name);
            return response::json(['stationlatlong' => $station_latlong->aero_latlong]);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller station_latlong: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller station_latlong : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function file_plan(Request $request) {
        try {
            $id = $request->id;
            $fpl_details = FlightPlanDetailsModel::where('id', $id)->first();
            $aircraft_callsign = ($fpl_details) ? $fpl_details->aircraft_callsign : '';
            $departure_aerodrome = ($fpl_details) ? $fpl_details->departure_aerodrome : '';
            $destination_aerodrome = ($fpl_details) ? $fpl_details->destination_aerodrome : '';
            $equipment = ($fpl_details) ? $fpl_details->equipment : '';
            $departure_time_hours = ($fpl_details) ? $fpl_details->departure_time_hours : '';
            $departure_time_minutes = ($fpl_details) ? $fpl_details->departure_time_minutes : '';
            $flight_rules = ($fpl_details) ? $fpl_details->flight_rules : '';
            $flight_type = ($fpl_details) ? $fpl_details->flight_type : '';
            $aircraft_type = ($fpl_details) ? $fpl_details->aircraft_type : '';
            $weight_category = ($fpl_details) ? $fpl_details->weight_category : '';
            $crushing_speed_indication = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
            $crushing_speed = ($fpl_details) ? $fpl_details->crushing_speed : '';
            $flight_level_indication = ($fpl_details) ? $fpl_details->flight_level_indication : '';
            $flight_level = ($fpl_details) ? $fpl_details->flight_level : '';
            $route = ($fpl_details) ? $fpl_details->route : '';
            $total_flying_hours = ($fpl_details) ? $fpl_details->total_flying_hours : '';
            $total_flying_minutes = ($fpl_details) ? $fpl_details->total_flying_minutes : '';
            $first_alternate_aerodrome = ($fpl_details) ? $fpl_details->first_alternate_aerodrome : '';
            $second_alternate_aerodrome = ($fpl_details) ? $fpl_details->second_alternate_aerodrome : '';
            $endurance_hours = ($fpl_details) ? $fpl_details->endurance_hours : '';
            $endurance_minutes = ($fpl_details) ? $fpl_details->endurance_minutes : '';
            $tbn = 'TBN';
            $number = ($fpl_details) ? $fpl_details->number : '';
            $capacity = ($fpl_details) ? $fpl_details->capacity : '';
            $color = ($fpl_details) ? $fpl_details->color : '';
            $aircraft_color = ($fpl_details) ? $fpl_details->aircraft_color : '';
            $remarks = ($fpl_details) ? $fpl_details->remarks : '';
            $pilot_in_command = ($fpl_details) ? $fpl_details->pilot_in_command : '';
            $date = ($fpl_details) ? $fpl_details->date_of_flight : '';
            $emergency_uhf = ($fpl_details) ? $fpl_details->emergency_uhf : '';
            $emergency_vhf = ($fpl_details) ? $fpl_details->emergency_vhf : '';
            $emergency_elba = ($fpl_details) ? $fpl_details->emergency_elba : '';
            $polar = ($fpl_details) ? $fpl_details->polar : '';
            $desert = ($fpl_details) ? $fpl_details->desert : '';
            $maritime = ($fpl_details) ? $fpl_details->maritime : '';
            $jungle = ($fpl_details) ? $fpl_details->jungle : '';
            $light = ($fpl_details) ? $fpl_details->light : '';
            $floures = ($fpl_details) ? $fpl_details->floures : '';
            $jacket_uhf = ($fpl_details) ? $fpl_details->jacket_uhf : '';
            $jacket_vhf = ($fpl_details) ? $fpl_details->jacket_vhf : '';
            $signature = '';
            $cover = ($fpl_details) ? $fpl_details->cover : '';
            $filing_date = ($fpl_details) ? $fpl_details->filing_date : '';
            $filing_time = ($fpl_details) ? $fpl_details->filed_date : '';
            $pbn = ($fpl_details) ? $fpl_details->pbn : '';
            $nav = ($fpl_details) ? $fpl_details->nav : '';
            $departure_latlong = ($fpl_details) ? $fpl_details->departure_latlong : '';
            $departure_station = ($fpl_details) ? $fpl_details->departure_station : '';
            $destination_latlong = ($fpl_details) ? $fpl_details->destination_latlong : '';
            $destination_station = ($fpl_details) ? $fpl_details->destination_station : '';
            $date_of_flight = ($fpl_details) ? $fpl_details->date_of_flight : '';
            $registration = ($fpl_details) ? $fpl_details->registration : '';
            $fir_crossing_time = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
            $sel = ($fpl_details) ? $fpl_details->sel : '';
            $code = ($fpl_details) ? $fpl_details->code : '';
            $operator = ($fpl_details) ? $fpl_details->operator : '';
            $per = ($fpl_details) ? $fpl_details->per : '';
            $route_altn = ($fpl_details) ? $fpl_details->route_altn : '';
            $take_off_altn = ($fpl_details) ? $fpl_details->take_off_altn : '';
            $alternate_station = ($fpl_details) ? $fpl_details->alternate_station : '';
            $remarks_value = ($fpl_details) ? $fpl_details->remarks : '';
            $credit = ($fpl_details) ? $fpl_details->credit : '';
            $pilot_in_command = ($fpl_details) ? $fpl_details->pilot_in_command : '';
            $indian = ($fpl_details) ? $fpl_details->indian : '';
            $foreigner = ($fpl_details) ? $fpl_details->foreigner : '';
            $foreigner_nationality = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
            $mobile_number = ($fpl_details) ? $fpl_details->mobile_number : '';
            $transponder = ($fpl_details) ? $fpl_details->transponder : '';
            $copilot = '';
            $cabincrew = '';
            $tcas = ($fpl_details) ? ($fpl_details->tcas == 'YES') ? 'YES' : '' : '';
            $fic = '';
            $adc = '';
            $india_time = '';
            $plan_status = '1';
            $filed_date = ($fpl_details) ? $fpl_details->filed_date : '';
            $no_credit = "";
            $station_addresses_data = myFunction::station_addresses($departure_aerodrome, $destination_aerodrome);
            $originator = "KINDXAAI";
            $data = [
                'aircraft_callsign' => $aircraft_callsign,
                'flight_rules' => $flight_rules,
                'flight_type' => $flight_type,
                'aircraft_type' => $aircraft_type,
                'weight_category' => $weight_category,
                'equipment' => $equipment,
                'transponder' => $transponder,
                'departure_aerodrome' => $departure_aerodrome,
                'departure_time_hours' => $departure_time_hours,
                'departure_time_minutes' => $departure_time_minutes,
                'crushing_speed_indication' => $crushing_speed_indication,
                'crushing_speed' => $crushing_speed,
                'flight_level_indication' => $flight_level_indication,
                'flight_level' => $flight_level,
                'route' => $route,
                'destination_aerodrome' => $destination_aerodrome,
                'total_flying_hours' => $total_flying_hours,
                'total_flying_minutes' => $total_flying_minutes,
                'first_alternate_aerodrome' => $first_alternate_aerodrome,
                'second_alternate_aerodrome' => $second_alternate_aerodrome,
                'departure_station' => $departure_station,
                'departure_latlong' => $departure_latlong,
                'destination_station' => $destination_station,
                'destination_latlong' => $destination_latlong,
                'alternate_station' => $alternate_station,
                'date_of_flight' => $date_of_flight,
                'registration' => $registration,
                'endurance_hours' => $endurance_hours,
                'endurance_minutes' => $endurance_minutes,
                'indian' => $indian,
                'foreigner' => $foreigner,
                'foreigner_nationality' => $foreigner_nationality,
                'pilot_in_command' => $pilot_in_command,
                'mobile_number' => $mobile_number,
                'copilot' => $copilot,
                'cabincrew' => $cabincrew,
                'operator' => $operator,
                'sel' => $sel,
                'fir_crossing_time' => $fir_crossing_time,
                'pbn' => $pbn,
                'nav' => $nav,
                'code' => $code,
                'per' => $per,
                'take_off_altn' => $take_off_altn,
                'route_altn' => $route_altn,
                'tcas' => $tcas,
                'credit' => $credit,
                'no_credit' => $no_credit,
                'remarks' => $remarks,
                'emergency_uhf' => $emergency_uhf,
                'emergency_vhf' => $emergency_vhf,
                'emergency_elba' => $emergency_elba,
                'polar' => $polar,
                'desert' => $desert,
                'maritime' => $maritime,
                'jungle' => $jungle,
                'light' => $light,
                'floures' => $floures,
                'jacket_uhf' => $jacket_uhf,
                'jacket_vhf' => $jacket_vhf,
                'number' => $number,
                'capacity' => $capacity,
                'cover' => $cover,
                'color' => $color,
                'aircraft_color' => $aircraft_color,
                'fic' => $fic,
                'adc' => $adc,
                'india_time' => $india_time,
                'plan_status' => $plan_status,
                'filed_date' > $filed_date,
                'tbn' => "TBN",
                'date' => $date,
                'signature' => $signature,
                'remarks_value' => $remarks_value,
                'filing_time' => $filing_time,
                'filing_date' => $filing_date,
                'station_addresses_data' => $station_addresses_data,
                'originator' => $originator,
            ];
            $subject = "FPL " . $aircraft_callsign . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes
                    . "-" . $destination_aerodrome . " " . date('d-M-Y', strtotime('20' . $date_of_flight));
            if ($departure_aerodrome == 'VABB' || $departure_aerodrome == 'TTTT') {
                $fileName = str_replace('/', '', $subject) . '.pdf';
                $AnnexureCopy = $fileName . 'AnnexureCopy.pdf';
                $filePath = public_path('media/images/fpl/downloads/');
                $flight_plan_pdf_content = view('templates.pdf.fpl.flight_plan_pdf', $data);
                PDF::loadHTML($flight_plan_pdf_content)
                        ->setPaper('a4')
                        ->setOrientation('portrait')
                        ->save($filePath . $fileName);
                $annexure_copy_content = view('templates.pdf.fpl.annexure_copy', $data);
                PDF::loadHTML($annexure_copy_content)
                        ->setPaper('a4')
                        ->setOrientation('portrait')
                        ->save($filePath . $AnnexureCopy);

                $pdf = new \Clegginabox\PDFMerger\PDFMerger();
                $pdf->addPDF($filePath . $fileName, '1');
                $pdf->addPDF($filePath . $AnnexureCopy, '1');
                $pdf->merge('file', $filePath . 'merge/' . $fileName, 'P');

                $merge_path = $filePath . 'merge/' . $fileName;
                return response()->download($merge_path);
            }
            $pdf = PDF::loadView('templates.pdf.fpl.flight_plan_pdf', $data);
            return $pdf->download($subject . '.pdf');
//            //unlink($'filePath.$fileName);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller file_plan function: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller file_plan : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function check_callsign_exist(Request $request) {
        try {
            $aircraft_callsign = $request->aircraft_callsign;
            $aircraft_callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $aircraft_callsign_exist = ($aircraft_callsign_details) ? TRUE : FALSE;
            return response::json(['success' => $aircraft_callsign_exist]);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller check_callsign_exist: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller check_callsign_exist : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function pilot_in_command(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;
            $pilotnames = CallsignInfoModel::pilot_in_command($aircraft_callsign, $term);
            $results[] = '';
            foreach ($pilotnames as $pilot_names) {
                $results[] = ['value' => $pilot_names->name];
//		$results = explode(',', $pilot_names->pilot);
            }
            return Response::json($results);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller pilot_in_command: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller pilot_in_command : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function get_pilot_details(Request $request) {
        $pilot_in_command = $request->pilot_name;
        $get_pilot_details = PilotMasterModel::get_pilot_details('', $pilot_in_command);
        $mobile_number = ($get_pilot_details) ? $get_pilot_details->mobile_number : '';
        return response::json(['mobilenum' => $mobile_number]);
    }

    public function copilot(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;
            $pilotnames = CallsignInfoModel::pilot_in_command($aircraft_callsign, $term);
            $copilot = CallsignInfoModel::copilot($aircraft_callsign, $term);
            $pilot_results = '';
            $copilot_results = '';
            foreach ($pilotnames as $pilot_names) {
                $pilot_results[] = ['value' => $pilot_names->name];
                $pilotnames_array[] = $pilot_names->name;
            }
            foreach ($copilot as $copilot_names) {
                if (!in_array($copilot_names->name, $pilotnames_array)) {
                    $copilot_results[] = ['value' => $copilot_names->name];
                }
            }
            $copilot_results[] = ['value' => 'NA'];
            $results = array_values(array_merge($pilot_results, $copilot_results));

            return Response::json($results);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller copilot: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller copilot : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function process_quick_plan($data, $function = '') {
        try {
            $aircraft_callsign = $data['aircraft_callsign'];

            if (substr($aircraft_callsign, 0, 2) == 'VT') {
                $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
            }
            $departure_aerodrome = $data['departure_aerodrome'];
            $departure_time_hours = $data['departure_time_hours'];
            $departure_time_minutes = $data['departure_time_minutes'];
            $destination_aerodrome = $data['destination_aerodrome'];
            $departure_station = $data['departure_station'];
            $departure_latlong = $data['departure_latlong'];
            $destination_station = $data['destination_station'];
            $destination_latlong = $data['destination_latlong'];
            $pilot_in_command = $data['pilot_in_command'];
            $pilot_in_command = str_replace("CAPT", "", $pilot_in_command);
            $pilot_in_command = str_replace("PIC", "", $pilot_in_command);
            $mobile_number = $data['mobile_number'];

            $copilot = $data['copilot'];
            $copilot = str_replace("CAPT", "", $copilot);
            $copilot = str_replace("PIC", "", $copilot);

            $cabincrew = $data['cabincrew'];
            $date_of_flight = date('ymd', strtotime($data['date_of_flight']));
            $route1 = $data['route1'];
            $remarks1 = $data['remarks1'];
            $remarks = $data['remarks'];

            $get_auto_num_details = FlightPlanDetailsModel::get_auto_num_details($data);
//	    $get_auto_cancel_details = FlightPlanDetailsModel::get_auto_num_details($data, '1');
            //	    if (count($get_auto_cancel_details)) {
            //		$this->auto_cancel($data);
            //	    }

            if ($function == 'edit_page') {
                $fpl_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            } else {
                $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
            }

            $get_call_sign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);

            if (count($get_auto_num_details) && substr($aircraft_callsign, 0, 2) == 'VT') {
                $data['aircraft_callsign_count'] = count($get_auto_num_details);
                $aircraft_callsign = myFunction::get_auto_number($data);
            }

            $user_id = $this->user_id;
            $flight_rules = ($get_call_sign_details) ? $get_call_sign_details->flight_rules : '';
            $flight_type = ($get_call_sign_details) ? $get_call_sign_details->flight_type : '';
            $aircraft_type = ($get_call_sign_details) ? $get_call_sign_details->aircraft_type : '';
            $weight_category = ($get_call_sign_details) ? $get_call_sign_details->weight_category : '';
            $equipment = ($get_call_sign_details) ? $get_call_sign_details->equipment : '';
            $transponder = ($fpl_details) ? $fpl_details->transponder : '';
            $crushing_speed_indication = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
            $crushing_speed = ($fpl_details) ? $fpl_details->crushing_speed : '';
            $flight_level_indication = ($fpl_details) ? $fpl_details->flight_level_indication : '';
            $flight_level = ($fpl_details) ? $fpl_details->flight_level : '';
            $route = ($fpl_details) ? $fpl_details->route : '';
            $total_flying_hours = ($fpl_details) ? $fpl_details->total_flying_hours : '';
            $total_flying_minutes = ($fpl_details) ? $fpl_details->total_flying_minutes : '';
            $first_alternate_aerodrome = ($fpl_details) ? $fpl_details->first_alternate_aerodrome : '';
            $second_alternate_aerodrome = ($fpl_details) ? $fpl_details->second_alternate_aerodrome : '';

            $alternate_station = '';

            if ($first_alternate_aerodrome == 'ZZZZ' || $second_alternate_aerodrome == 'ZZZZ') {
                $alternate_station = 'ALL OPEN SPACES AND HELIPAD ENROUTE';
            }

            $registration = ($get_call_sign_details) ? $get_call_sign_details->registration : '';
            $endurance_hours = ($fpl_details) ? $fpl_details->endurance_hours : '';
            $endurance_minutes = ($fpl_details) ? $fpl_details->endurance_minutes : '';
            $indian = ($fpl_details) ? $fpl_details->indian : '';
            $foreigner = ($fpl_details) ? $fpl_details->foreigner : '';
            $foreigner_nationality = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
            $operator = ($get_call_sign_details) ? $get_call_sign_details->operator : '';
            $sel = ($get_call_sign_details) ? $get_call_sign_details->sel : '';
            $fir_crossing_time = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
            $pbn = ($get_call_sign_details) ? $get_call_sign_details->pbn : '';
            $nav = ($get_call_sign_details) ? $get_call_sign_details->nav : '';
            $code = ($get_call_sign_details) ? $get_call_sign_details->code : '';
            $per = ($get_call_sign_details) ? $get_call_sign_details->per : '';
            $take_off_altn = ($fpl_details) ? $fpl_details->take_off_altn : '';
            $route_altn = ($fpl_details) ? $fpl_details->route_altn : '';
            $tcas = ($get_call_sign_details) ? $get_call_sign_details->tcas : '';
            $credit = ($get_call_sign_details) ? $get_call_sign_details->credit : '';
            $no_credit = ($fpl_details) ? $fpl_details->no_credit : '';
//	    $remarks = ''; //($fpl_details) ? $fpl_details->remarks : '';
            $emergency_uhf = ($get_call_sign_details) ? $get_call_sign_details->emergency_uhf : '';
            $emergency_vhf = ($get_call_sign_details) ? $get_call_sign_details->emergency_vhf : '';
            $emergency_elba = ($get_call_sign_details) ? $get_call_sign_details->emergency_elba : '';
            $polar = ($get_call_sign_details) ? $get_call_sign_details->polar : '';
            $desert = ($get_call_sign_details) ? $get_call_sign_details->desert : '';
            $maritime = ($get_call_sign_details) ? $get_call_sign_details->maritime : '';
            $jungle = ($get_call_sign_details) ? $get_call_sign_details->jungle : '';
            $light = ($get_call_sign_details) ? $get_call_sign_details->light : '';
            $floures = ($get_call_sign_details) ? $get_call_sign_details->floures : '';
            $jacket_uhf = ($get_call_sign_details) ? $get_call_sign_details->jacket_uhf : '';
            $jacket_vhf = ($get_call_sign_details) ? $get_call_sign_details->jacket_vhf : '';
            $number = ($get_call_sign_details) ? $get_call_sign_details->number : '';
            $capacity = ($get_call_sign_details) ? $get_call_sign_details->capacity : '';
            $cover = ($get_call_sign_details) ? $get_call_sign_details->cover : '';
            $color = ($get_call_sign_details) ? $get_call_sign_details->color : '';
            $aircraft_color = ($get_call_sign_details) ? $get_call_sign_details->aircraft_color : '';
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');

            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0]);
            }

            if ($current_date == $date_of_flight) {
                $current_utc_time30 = date('Hi', strtotime("+30 minutes", strtotime($current_utc_time)));
                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
                    echo 'Min. 30 minutes from present time only accepted.';
                    die();
                }
            }

            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);
            $departure_time_hours_etd = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes_etd = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours_etd = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes_etd = ($result_dof) ? $result_dof->total_flying_minutes : '';

            if ($result_dof) {
                $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours_etd . ":" . $departure_time_minutes_etd));
                $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours_etd . ":" . $total_flying_minutes_etd));
                $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
                $total_time_after_flying = gmdate('ymdHi', strtotime($res_time1) + $secs);

                if ($date_of_flight . $departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                    echo 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_time_after_flying;
                    die();
                }
            }
            if ($function == 'edit_page') {
                $data = [
                    'user_id' => $this->user_id,
                    'aircraft_callsign' => $aircraft_callsign,
                    'flight_rules' => $flight_rules,
                    'flight_type' => $flight_type,
                    'aircraft_type' => $aircraft_type,
                    'weight_category' => $weight_category,
                    'equipment' => $equipment,
                    'transponder' => $transponder,
                    'departure_aerodrome' => $departure_aerodrome,
                    'departure_time_hours' => $departure_time_hours,
                    'departure_time_minutes' => $departure_time_minutes,
                    'crushing_speed_indication' => $crushing_speed_indication,
                    'crushing_speed' => $crushing_speed,
                    'flight_level_indication' => $flight_level_indication,
                    'flight_level' => '',
                    'route' => '',
                    'route1' => '',
                    'destination_aerodrome' => $destination_aerodrome,
                    'total_flying_hours' => '',
                    'total_flying_minutes' => '',
                    'first_alternate_aerodrome' => '',
                    'second_alternate_aerodrome' => '',
                    'departure_station' => $departure_station,
                    'departure_latlong' => $departure_latlong,
                    'destination_station' => $destination_station,
                    'destination_latlong' => $destination_latlong,
                    'alternate_station' => $alternate_station,
                    'date_of_flight' => $date_of_flight,
                    'registration' => $registration,
                    'endurance_hours' => '',
                    'endurance_minutes' => '',
                    'indian' => $indian,
                    'foreigner' => $foreigner,
                    'foreigner_nationality' => '',
                    'pilot_in_command' => $pilot_in_command,
                    'mobile_number' => $mobile_number,
                    'copilot' => $copilot,
                    'cabincrew' => $cabincrew,
                    'operator' => $operator,
                    'sel' => $sel,
                    'fir_crossing_time' => '',
                    'pbn' => $pbn,
                    'nav' => $nav,
                    'code' => $code,
                    'per' => $per,
                    'take_off_altn' => '',
                    'route_altn' => '',
                    'tcas' => $tcas,
                    'credit' => $credit,
                    'no_credit' => $no_credit,
                    'remarks' => $remarks,
                    'remarks1' => '',
                    'emergency_uhf' => $emergency_uhf,
                    'emergency_vhf' => $emergency_vhf,
                    'emergency_elba' => $emergency_elba,
                    'polar' => $polar,
                    'desert' => $desert,
                    'maritime' => $maritime,
                    'jungle' => $jungle,
                    'light' => $light,
                    'floures' => $floures,
                    'jacket_uhf' => $jacket_uhf,
                    'jacket_vhf' => $jacket_vhf,
                    'number' => $number,
                    'capacity' => $capacity,
                    'cover' => $cover,
                    'color' => $color,
                    'aircraft_color' => $aircraft_color,
                    'fic' => $fic,
                    'adc' => $adc,
                    'india_time' => $india_time,
                    'plan_status' => $plan_status,
                    'filed_date' => $filed_date,
                ];
            } else {
                $data = [
                    'user_id' => $this->user_id,
                    'aircraft_callsign' => $aircraft_callsign,
                    'flight_rules' => $flight_rules,
                    'flight_type' => $flight_type,
                    'aircraft_type' => $aircraft_type,
                    'weight_category' => $weight_category,
                    'equipment' => $equipment,
                    'transponder' => $transponder,
                    'departure_aerodrome' => $departure_aerodrome,
                    'departure_time_hours' => $departure_time_hours,
                    'departure_time_minutes' => $departure_time_minutes,
                    'crushing_speed_indication' => $crushing_speed_indication,
                    'crushing_speed' => $crushing_speed,
                    'flight_level_indication' => $flight_level_indication,
                    'flight_level' => $flight_level,
                    'route' => $route,
                    'route1' => $route1,
                    'destination_aerodrome' => $destination_aerodrome,
                    'total_flying_hours' => $total_flying_hours,
                    'total_flying_minutes' => $total_flying_minutes,
                    'first_alternate_aerodrome' => $first_alternate_aerodrome,
                    'second_alternate_aerodrome' => $second_alternate_aerodrome,
                    'departure_station' => $departure_station,
                    'departure_latlong' => $departure_latlong,
                    'destination_station' => $destination_station,
                    'destination_latlong' => $destination_latlong,
                    'alternate_station' => $alternate_station,
                    'date_of_flight' => $date_of_flight,
                    'registration' => $registration,
                    'endurance_hours' => $endurance_hours,
                    'endurance_minutes' => $endurance_minutes,
                    'indian' => $indian,
                    'foreigner' => $foreigner,
                    'foreigner_nationality' => $foreigner_nationality,
                    'pilot_in_command' => $pilot_in_command,
                    'mobile_number' => $mobile_number,
                    'copilot' => $copilot,
                    'cabincrew' => $cabincrew,
                    'operator' => $operator,
                    'sel' => $sel,
                    'fir_crossing_time' => $fir_crossing_time,
                    'pbn' => $pbn,
                    'nav' => $nav,
                    'code' => $code,
                    'per' => $per,
                    'take_off_altn' => $take_off_altn,
                    'route_altn' => $route_altn,
                    'tcas' => $tcas,
                    'credit' => $credit,
                    'no_credit' => $no_credit,
                    'remarks' => $remarks,
                    'remarks1' => $remarks1,
                    'emergency_uhf' => $emergency_uhf,
                    'emergency_vhf' => $emergency_vhf,
                    'emergency_elba' => $emergency_elba,
                    'polar' => $polar,
                    'desert' => $desert,
                    'maritime' => $maritime,
                    'jungle' => $jungle,
                    'light' => $light,
                    'floures' => $floures,
                    'jacket_uhf' => $jacket_uhf,
                    'jacket_vhf' => $jacket_vhf,
                    'number' => $number,
                    'capacity' => $capacity,
                    'cover' => $cover,
                    'color' => $color,
                    'aircraft_color' => $aircraft_color,
                    'fic' => $fic,
                    'adc' => $adc,
                    'india_time' => $india_time,
                    'plan_status' => $plan_status,
                    'filed_date' => $filed_date,
                ];
            }
            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
            $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;

            $is_watch_hour_valid = myFunction::get_watch_hours($data);

            $data['is_watch_hour_valid'] = $is_watch_hour_valid;
            if ($is_watch_hour_valid) {
                $entered_departure_time = $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes;
            } else {
                $entered_departure_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes . '</span>';
            }
            if ($is_watch_hour_valid) {
                $entered_destination_time = $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes;
            } else {
                $entered_destination_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes . '</span>';
            }

            $is_watch_enabled = \App\models\SupportMailsModel::where('id', 2)->where('is_active', 1)->count();

            if ($is_watch_enabled) {
                
            }

            $data['entered_departure_time'] = $entered_departure_time;
            $data['entered_destination_time'] = $entered_destination_time;



            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;
            $data['is_process'] = 1;

            $get_dept_watch_hours_info = myFunction::get_watch_hours_info($data, '1');
            $get_dest_watch_hours_info = myFunction::get_watch_hours_info($data);
            $get_dept_sunrise_sunset_info = myFunction::get_sunrise_sunset_info($data, '1');
            $get_dest_sunrise_sunset_info = myFunction::get_sunrise_sunset_info($data);

            $data['get_dept_watch_hours_info'] = $get_dept_watch_hours_info;
            $data['get_dest_watch_hours_info'] = $get_dest_watch_hours_info;
            $data['get_dept_sunrise_sunset_info'] = $get_dept_sunrise_sunset_info;
            $data['get_dest_sunrise_sunset_info'] = $get_dest_sunrise_sunset_info;

//            exit;
            return $data;
        } catch (\Exception $ex) {
            Log::error('Fpl Controller process_quick_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller process_quick_plan : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function on_edit_plan($data) {
        try {
            //logged user
            $user_id = $this->user_id;
            $aircraft_callsign = $data['aircraft_callsign'];
            $departure_aerodrome = $data['departure_aerodrome'];
            $departure_time_hours = $data['departure_time_hours'];
            $departure_time_minutes = $data['departure_time_minutes'];
            $destination_aerodrome = $data['destination_aerodrome'];
//            $date_of_flight = $data['date_of_flight'];
            $date_of_flight = date('ymd', strtotime($data['date_of_flight']));
            $pilot_in_command = $data['pilot_in_command'];
            $mobile_number = $data['mobile_number'];
            $copilot = $data['copilot'];
            $cabincrew = $data['cabincrew'];
            $crushing_speed_indication = $data['crushing_speed_indication'];

            $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
            $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
            $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
            $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

            $crushing_speed_indication = $data['crushing_speed_indication'];
            $crushing_speed = $data['crushing_speed'];
            $flight_level_indication = $data['flight_level_indication'];
            $flight_level = $data['flight_level'];
            $total_flying_hours = $data['total_flying_hours'];
            $total_flying_minutes = $data['total_flying_minutes'];
            $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
            $second_alternate_aerodrome = $data['second_alternate_aerodrome'];
            $route = ($data['route']) ? trim($data['route']) . trim($data['route1']) : '';
            $remarks = ($data['remarks']) ? trim($data['remarks']) . trim($data['remarks1']) : '';
            $endurance_hours = $data['endurance_hours'];
            $endurance_minutes = $data['endurance_minutes'];
            $indian = $data['indian'];
            $foreigner = $data['foreigner'];
            $foreigner_nationality = $data['foreigner_nationality'];
//	    print_r($data);exit;
            //fetching db data
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
            $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';
            $flight_type = (array_key_exists('flight_type', $data)) ? $data['flight_type'] : '';
            $aircraft_type = (array_key_exists('aircraft_type', $data)) ? $data['aircraft_type'] : '';
            $weight_category = (array_key_exists('weight_category', $data)) ? $data['weight_category'] : '';
            $equipment = (array_key_exists('equipment', $data)) ? $data['equipment'] : '';
            $transponder = (array_key_exists('transponder', $data)) ? $data['transponder'] : '';
            $alternate_station = (array_key_exists('alternate_station', $data)) ? $data['alternate_station'] : '';
            $registration = (array_key_exists('registration', $data)) ? $data['registration'] : '';
            $operator = (array_key_exists('operator', $data)) ? $data['operator'] : '';
            $sel = (array_key_exists('sel', $data)) ? $data['sel'] : '';
            $fir_crossing_time = (array_key_exists('fir_crossing_time', $data)) ? $data['fir_crossing_time'] : '';
            $pbn = (array_key_exists('pbn', $data)) ? $data['pbn'] : '';
            $nav = (array_key_exists('nav', $data)) ? $data['nav'] : '';
            $code = (array_key_exists('code', $data)) ? $data['code'] : '';
            $per = (array_key_exists('per', $data)) ? $data['per'] : '';
            $take_off_altn = (array_key_exists('take_off_altn', $data)) ? $data['take_off_altn'] : '';
            $route_altn = (array_key_exists('route_altn', $data)) ? $data['route_altn'] : '';
            $tcas = (array_key_exists('tcas', $data)) ? $data['tcas'] : '';
            $credit = (array_key_exists('credit', $data)) ? $data['credit'] : '';
            $no_credit = (array_key_exists('no_credit', $data)) ? $data['no_credit'] : '';
            $emergency_uhf = (array_key_exists('emergency_uhf', $data)) ? $data['emergency_uhf'] : '';
            $emergency_vhf = (array_key_exists('emergency_vhf', $data)) ? $data['emergency_vhf'] : '';
            $emergency_elba = (array_key_exists('emergency_elba', $data)) ? $data['emergency_elba'] : '';
            $polar = (array_key_exists('polar', $data)) ? $data['polar'] : '';
            $desert = (array_key_exists('desert', $data)) ? $data['desert'] : '';
            $maritime = (array_key_exists('maritime', $data)) ? $data['maritime'] : '';
            $jungle = (array_key_exists('jungle', $data)) ? $data['jungle'] : '';
            $light = (array_key_exists('light', $data)) ? $data['light'] : '';
            $floures = (array_key_exists('floures', $data)) ? $data['floures'] : '';
            $jacket_uhf = (array_key_exists('jacket_uhf', $data)) ? $data['jacket_uhf'] : '';
            $jacket_vhf = (array_key_exists('jacket_vhf', $data)) ? $data['jacket_vhf'] : '';
            $number = (array_key_exists('number', $data)) ? $data['number'] : '';
            $capacity = (array_key_exists('capacity', $data)) ? $data['capacity'] : '';
            $cover = (array_key_exists('cover', $data)) ? $data['cover'] : '';
            $color = (array_key_exists('color', $data)) ? $data['color'] : '';
            $aircraft_color = (array_key_exists('aircraft_color', $data)) ? $data['aircraft_color'] : '';
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');
            $data = [
                'user_id' => $this->user_id,
                'aircraft_callsign' => $aircraft_callsign,
                'flight_rules' => $flight_rules,
                'flight_type' => $flight_type,
                'aircraft_type' => $aircraft_type,
                'weight_category' => $weight_category,
                'equipment' => $equipment,
                'transponder' => $transponder,
                'departure_aerodrome' => $departure_aerodrome,
                'departure_time_hours' => $departure_time_hours,
                'departure_time_minutes' => $departure_time_minutes,
                'crushing_speed_indication' => $crushing_speed_indication,
                'crushing_speed' => $crushing_speed,
                'flight_level_indication' => $flight_level_indication,
                'flight_level' => $flight_level,
                'route' => $route,
                'destination_aerodrome' => $destination_aerodrome,
                'total_flying_hours' => $total_flying_hours,
                'total_flying_minutes' => $total_flying_minutes,
                'first_alternate_aerodrome' => $first_alternate_aerodrome,
                'second_alternate_aerodrome' => $second_alternate_aerodrome,
                'departure_station' => $departure_station,
                'departure_latlong' => $departure_latlong,
                'destination_station' => $destination_station,
                'destination_latlong' => $destination_latlong,
                'alternate_station' => $alternate_station,
                'date_of_flight' => $date_of_flight,
                'registration' => $registration,
                'endurance_hours' => $endurance_hours,
                'endurance_minutes' => $endurance_minutes,
                'indian' => $indian,
                'foreigner' => $foreigner,
                'foreigner_nationality' => $foreigner_nationality,
                'pilot_in_command' => $pilot_in_command,
                'mobile_number' => $mobile_number,
                'copilot' => $copilot,
                'cabincrew' => $cabincrew,
                'operator' => $operator,
                'sel' => $sel,
                'fir_crossing_time' => $fir_crossing_time,
                'pbn' => $pbn,
                'nav' => $nav,
                'code' => $code,
                'per' => $per,
                'take_off_altn' => $take_off_altn,
                'route_altn' => $route_altn,
                'tcas' => $tcas,
                'credit' => $credit,
                'no_credit' => $no_credit,
                'remarks' => $remarks,
                'emergency_uhf' => $emergency_uhf,
                'emergency_vhf' => $emergency_vhf,
                'emergency_elba' => $emergency_elba,
                'polar' => $polar,
                'desert' => $desert,
                'maritime' => $maritime,
                'jungle' => $jungle,
                'light' => $light,
                'floures' => $floures,
                'jacket_uhf' => $jacket_uhf,
                'jacket_vhf' => $jacket_vhf,
                'number' => $number,
                'capacity' => $capacity,
                'cover' => $cover,
                'color' => $color,
                'aircraft_color' => $aircraft_color,
                'fic' => $fic,
                'adc' => $adc,
                'india_time' => $india_time,
                'plan_status' => $plan_status,
                'filed_date' => $filed_date,
            ];
            $data['is_process'] = 1;
            return $data;
        } catch (\Exception $ex) {
            Log::error('Fpl Controller on_edit_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller on_edit_plan : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function edit_process(EditPlanRequest $request) {
        try {
//	    print_r($request->all());exit;
            $data = $request->all();
            $user_id = $this->user_id;
            $aircraft_callsign = $request->aircraft_callsign;
            $departure_aerodrome = $request->departure_aerodrome;
            $departure_time_hours = $request->departure_time_hours;
            $departure_time_minutes = $request->departure_time_minutes;
            $destination_aerodrome = $request->destination_aerodrome;
            $departure_station = $request->departure_station;
            $departure_latlong = $request->departure_latlong;
            $destination_station = $request->destination_station;
            $destination_latlong = $request->destination_latlong;
            $date_of_flight = $request->date_of_flight;
            $pilot_in_command = $request->pilot_in_command;
            $mobile_number = $request->mobile_number;
            $copilot = $request->copilot;
            $cabincrew = $request->cabincrew;
            $crushing_speed_indication = $request->crushing_speed_indication;
            $crushing_speed = $request->crushing_speed;
            $flight_level_indication = $request->flight_level_indication;
            $flight_level = $request->flight_level;
            $total_flying_hours = $request->total_flying_hours;
            $total_flying_minutes = $request->total_flying_minutes;
            $route = $request->route . ' ' . $request->route1;
            $route1 = $request->route1;
            $first_alternate_aerodrome = $request->first_alternate_aerodrome;
            $second_alternate_aerodrome = $request->second_alternate_aerodrome;
            $take_off_altn = $request->take_off_altn;
            $indian = ($request->indian == "YES") ? "YES" : "NO";
            $foreigner = ($request->indian == "NO") ? "YES" : "NO";
            $foreigner_nationality = $request->foreigner_nationality;
            $endurance_hours = $request->endurance_hours;
            $endurance_minutes = $request->endurance_minutes;
            $fir_crossing_time = $request->fir_crossing_time;
            $remarks = $request->remarks;
            $remarks1 = $request->remarks1;
            $flight_rules = ($request) ? $request->flight_rules : '';
            $route_altn = ($request) ? $request->route_altn : '';
            $alternate_station = ($request) ? $request->alternate_station : '';

            $data = $request->all();
            $fpl_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);

            $flight_type = ($fpl_details) ? $fpl_details->flight_type : '';
            $aircraft_type = ($fpl_details) ? $fpl_details->aircraft_type : '';
            $weight_category = ($fpl_details) ? $fpl_details->weight_category : '';
            $equipment = ($fpl_details) ? $fpl_details->equipment : '';
            $transponder = ($fpl_details) ? $fpl_details->transponder : '';

            $registration = ($fpl_details) ? $fpl_details->registration : '';
            $operator = ($fpl_details) ? $fpl_details->operator : '';
            $sel = ($fpl_details) ? $fpl_details->sel : '';
            $pbn = ($fpl_details) ? $fpl_details->pbn : '';
            $nav = ($fpl_details) ? $fpl_details->nav : '';
            $code = ($fpl_details) ? $fpl_details->code : '';
            $per = ($fpl_details) ? $fpl_details->per : '';

            $tcas = ($fpl_details) ? $fpl_details->tcas : '';
            $credit = ($fpl_details) ? $fpl_details->credit : '';
            $no_credit = ($fpl_details) ? $fpl_details->no_credit : '';
            $emergency_uhf = ($fpl_details) ? $fpl_details->emergency_uhf : '';
            $emergency_vhf = ($fpl_details) ? $fpl_details->emergency_vhf : '';
            $emergency_elba = ($fpl_details) ? $fpl_details->emergency_elba : '';
            $polar = ($fpl_details) ? $fpl_details->polar : '';
            $desert = ($fpl_details) ? $fpl_details->desert : '';
            $maritime = ($fpl_details) ? $fpl_details->maritime : '';
            $jungle = ($fpl_details) ? $fpl_details->jungle : '';
            $light = ($fpl_details) ? $fpl_details->light : '';
            $floures = ($fpl_details) ? $fpl_details->floures : '';
            $jacket_uhf = ($fpl_details) ? $fpl_details->jacket_uhf : '';
            $jacket_vhf = ($fpl_details) ? $fpl_details->jacket_vhf : '';
            $number = ($fpl_details) ? $fpl_details->number : '';
            $capacity = ($fpl_details) ? $fpl_details->capacity : '';
            $cover = ($fpl_details) ? $fpl_details->cover : '';
            $color = ($fpl_details) ? $fpl_details->color : '';
            $aircraft_color = ($fpl_details) ? $fpl_details->aircraft_color : '';
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');

            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);

            $rules = [];

            if ($indian == 'NO') {
                $rules['foreigner_nationality'] = 'required';
            }
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                return response()->json(['STATUS_DESC' => 'Please enter valid data', 'STATUS_CODE' => 0], 401);
            }

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0]);
            }

            if ($current_date == $date_of_flight) {
                $current_utc_time30 = date('Hi', strtotime("+30 minutes", strtotime($current_utc_time)));
                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
                    return response()->json(['STATUS_DESC' => 'Min. 30 minutes from present time only accepted.', 'STATUS_CODE' => 0]);
                }
            }

            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);
            $departure_time_hours_etd = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes_etd = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours_etd = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes_etd = ($result_dof) ? $result_dof->total_flying_minutes : '';

            if ($result_dof) {
                $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours_etd . ":" . $departure_time_minutes_etd));
                $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours_etd . ":" . $total_flying_minutes_etd));

                $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
                $total_time_after_flying = gmdate('ymdHi', strtotime($res_time1) + $secs);

                if ($date_of_flight . $departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                    return response()->json(['STATUS_DESC' => 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_time_after_flying, 'STATUS_CODE' => 0], 201);
                }
            }

            $data = [
                'user_id' => $this->user_id,
                'aircraft_callsign' => $aircraft_callsign,
                'flight_rules' => $flight_rules,
                'flight_type' => $flight_type,
                'aircraft_type' => $aircraft_type,
                'weight_category' => $weight_category,
                'equipment' => $equipment,
                'transponder' => $transponder,
                'departure_aerodrome' => $departure_aerodrome,
                'departure_time_hours' => $departure_time_hours,
                'departure_time_minutes' => $departure_time_minutes,
                'crushing_speed_indication' => $crushing_speed_indication,
                'crushing_speed' => $crushing_speed,
                'flight_level_indication' => $flight_level_indication,
                'flight_level' => $flight_level,
                'route' => $route,
                'route1' => $route1,
                'destination_aerodrome' => $destination_aerodrome,
                'total_flying_hours' => $total_flying_hours,
                'total_flying_minutes' => $total_flying_minutes,
                'first_alternate_aerodrome' => $first_alternate_aerodrome,
                'second_alternate_aerodrome' => $second_alternate_aerodrome,
                'departure_station' => $departure_station,
                'departure_latlong' => $departure_latlong,
                'destination_station' => $destination_station,
                'destination_latlong' => $destination_latlong,
                'alternate_station' => $alternate_station,
                'date_of_flight' => $date_of_flight,
                'registration' => $registration,
                'endurance_hours' => $endurance_hours,
                'endurance_minutes' => $endurance_minutes,
                'indian' => $indian,
                'foreigner' => $foreigner,
                'foreigner_nationality' => $foreigner_nationality,
                'pilot_in_command' => $pilot_in_command,
                'mobile_number' => $mobile_number,
                'copilot' => $copilot,
                'cabincrew' => $cabincrew,
                'operator' => $operator,
                'sel' => $sel,
                'fir_crossing_time' => $fir_crossing_time,
                'pbn' => $pbn,
                'nav' => $nav,
                'code' => $code,
                'per' => $per,
                'take_off_altn' => $take_off_altn,
                'route_altn' => $route_altn,
                'tcas' => $tcas,
                'credit' => $credit,
                'no_credit' => $no_credit,
                'remarks' => $remarks,
                'remarks1' => $remarks1,
                'emergency_uhf' => $emergency_uhf,
                'emergency_vhf' => $emergency_vhf,
                'emergency_elba' => $emergency_elba,
                'polar' => $polar,
                'desert' => $desert,
                'maritime' => $maritime,
                'jungle' => $jungle,
                'light' => $light,
                'floures' => $floures,
                'jacket_uhf' => $jacket_uhf,
                'jacket_vhf' => $jacket_vhf,
                'number' => $number,
                'capacity' => $capacity,
                'cover' => $cover,
                'color' => $color,
                'aircraft_color' => $aircraft_color,
                'fic' => $fic,
                'adc' => $adc,
                'india_time' => $india_time,
                'plan_status' => $plan_status,
                'filed_date' => $filed_date,
            ];
            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
            $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;
            $is_watch_hour_valid = myFunction::get_watch_hours($data);
            $data['is_watch_hour_valid'] = $is_watch_hour_valid;
            if ($is_watch_hour_valid) {
                $entered_departure_time = $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes;
            } else {
                $entered_departure_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes . '</span>';
            }
            if ($is_watch_hour_valid) {
                $entered_destination_time = $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes;
            } else {
                $entered_destination_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes . '</span>';
            }
            $data['entered_departure_time'] = $entered_departure_time;
            $data['entered_destination_time'] = $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;
            $data['is_process'] = 1;

            $get_dept_watch_hours_info = myFunction::get_watch_hours_info($data, '1');
            $get_dest_watch_hours_info = myFunction::get_watch_hours_info($data);
            $get_dept_sunrise_sunset_info = myFunction::get_sunrise_sunset_info($data, '1');
            $get_dest_sunrise_sunset_info = myFunction::get_sunrise_sunset_info($data);

            $data['get_dept_watch_hours_info'] = $get_dept_watch_hours_info;
            $data['get_dest_watch_hours_info'] = $get_dest_watch_hours_info;
            $data['get_dept_sunrise_sunset_info'] = $get_dept_sunrise_sunset_info;
            $data['get_dest_sunrise_sunset_info'] = $get_dest_sunrise_sunset_info;

            return view('fpl.new_quick_fpl', $data);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller edit_process: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller edit_process : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function new_plan(FullPlanRequest $request) {
        try {
            $inputs = $request->all();
            $data = $request->all();
            $user_id = $this->user_id;
            $aircraft_callsign = $request->aircraft_callsign;
            $flight_rules = $request->flight_rules;
            $flight_type = $request->flight_type;
            $aircraft_type = $request->aircraft_type;
            $weight_category = $request->weight_category;
            $equipment = $request->equipment;
            $transponder = $request->transponder;
            $departure_aerodrome = $request->departure_aerodrome;
            $departure_time_hours = $request->departure_time_hours;
            $departure_time_minutes = $request->departure_time_minutes;
            $crushing_speed_indication = $request->crushing_speed_indication;
            $crushing_speed = $request->crushing_speed;
            $flight_level_indication = $request->flight_level_indication;
            $flight_level = $request->flight_level;
            $route = $request->route;
            $destination_aerodrome = $request->destination_aerodrome;
            $total_flying_hours = $request->total_flying_hours;
            $total_flying_minutes = $request->total_flying_minutes;
            $first_alternate_aerodrome = $request->first_alternate_aerodrome;
            $second_alternate_aerodrome = $request->second_alternate_aerodrome;
            $departure_station = $request->departure_station;
            $departure_latlong = $request->departure_latlong;
            $destination_station = $request->destination_station;
            $destination_latlong = $request->destination_latlong;
            $alternate_station = $request->alternate_station;
            $date_of_flight = date('ymd', strtotime($request->date_of_flight));
            $registration = $request->registration;
            $endurance_hours = $request->endurance_hours;
            $endurance_minutes = $request->endurance_minutes;
            $indian = ($request->indian == "YES") ? "YES" : "NO";
            $foreigner = ($request->indian == "NO") ? "YES" : "NO";
            $foreigner_nationality = $request->foreigner_nationality;
            $pilot_in_command = $request->pilot_in_command;
            $mobile_number = $request->mobile_number;
            $copilot = $request->copilot;
            $cabincrew = $request->cabincrew;
            $operator = $request->operator;
            $sel = $request->sel;
            $fir_crossing_time = $request->fir_crossing_time;
            $pbn = $request->pbn;
            $nav = $request->nav;
            $code = $request->code;
            $per = $request->per;
            $take_off_altn = $request->take_off_altn;
            $route_altn = $request->route_altn;
            $tcas = ($request->tcas == "tcas") ? "YES" : "NO";
            $credit = ($request->credit == "YES") ? "YES" : "NO";
            $no_credit = ($request->credit == "YES") ? "NO" : "YES";
            $remarks = $request->remarks;
            $emergency_uhf = ($request->emergency_uhf == "uhf") ? "YES" : "NO";
            $emergency_vhf = ($request->emergency_vhf == "vhf") ? "YES" : "NO";
            $emergency_elba = ($request->emergency_elba == "elba") ? "YES" : "NO";
            $polar = ($request->polar == "polar") ? "YES" : "NO";
            $desert = ($request->desert == "desert") ? "YES" : "NO";
            $maritime = ($request->maritime == "maritime") ? "YES" : "NO";
            $jungle = ($request->jungle == "jungle") ? "YES" : "NO";
            $light = ($request->light == "light") ? "YES" : "NO";
            $floures = ($request->floures == "floures") ? "YES" : "NO";
            $jacket_uhf = ($request->jacket_uhf == "jacket_uhf") ? "YES" : "NO";
            $jacket_vhf = ($request->jacket_vhf == "jacket_vhf") ? "YES" : "NO";
            $number = $request->number;
            $capacity = $request->capacity;
            $cover = ($request->cover == "cover") ? "YES" : "NO";
            $color = $request->color;
            $aircraft_color = $request->aircraft_color;
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');
            $date = $request->date_of_flight;
            $signature = '';
            $remarks_value = $request->remarks;
            $filing_date = $request->filing_date;
            $filing_time = $request->filed_date;

            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);

            $rules = [];
            if ($departure_aerodrome == 'ZZZZ') {
                $rules['departure_station'] = 'required';
                $rules['departure_latlong'] = 'required';
            }
            if ($destination_aerodrome == 'ZZZZ') {
                $rules['destination_station'] = 'required';
                $rules['destination_latlong'] = 'required';
            }
            if ($number) {
                $rules['capacity'] = 'required';
            }
            if ($indian == 'NO') {
                $rules['foreigner_nationality'] = 'required';
            }
            $validation = Validator::make($inputs, $rules);

            if ($validation->fails()) {
                return response()->json(['STATUS_DESC' => 'Please enter valid data', 'STATUS_CODE' => 0]);
            }
            if ($emergency_uhf == 'NO' && $emergency_vhf == 'NO' && $emergency_elba == 'NO') {
                return response()->json(['STATUS_DESC' => 'Please enter valid data', 'STATUS_CODE' => 0]);
            }

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0]);
            }

            if ($current_date == $date_of_flight && !$request->is_myaccount) {
                $current_utc_time30 = date('Hi', strtotime("+30 minutes", strtotime($current_utc_time)));
                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
                    return response()->json(['STATUS_DESC' => 'Min. 30 minutes from present time only accepted.', 'STATUS_CODE' => 0]);
                }
            }
            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);

            $departure_time_hours_etd = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes_etd = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours_etd = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes_etd = ($result_dof) ? $result_dof->total_flying_minutes : '';

            if ($result_dof) {
                $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours_etd . ":" . $departure_time_minutes_etd));
                $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours_etd . ":" . $total_flying_minutes_etd));

                $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
                $total_time_after_flying = gmdate('ymdHi', strtotime($res_time1) + $secs);

                if ($date_of_flight . $departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                    return response()->json(['STATUS_DESC' => 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_time_after_flying, 'STATUS_CODE' => 0], 201);
                }
            }

            $data = [
                'user_id' => $this->user_id,
                'email' => $this->user_email,
                'aircraft_callsign' => $aircraft_callsign,
                'flight_rules' => $flight_rules,
                'flight_type' => $flight_type,
                'aircraft_type' => $aircraft_type,
                'weight_category' => $weight_category,
                'equipment' => $equipment,
                'transponder' => $transponder,
                'departure_aerodrome' => $departure_aerodrome,
                'departure_time_hours' => $departure_time_hours,
                'departure_time_minutes' => $departure_time_minutes,
                'crushing_speed_indication' => $crushing_speed_indication,
                'crushing_speed' => $crushing_speed,
                'flight_level_indication' => $flight_level_indication,
                'flight_level' => $flight_level,
                'route' => $route,
                'route1' => '',
                'destination_aerodrome' => $destination_aerodrome,
                'total_flying_hours' => $total_flying_hours,
                'total_flying_minutes' => $total_flying_minutes,
                'first_alternate_aerodrome' => $first_alternate_aerodrome,
                'second_alternate_aerodrome' => $second_alternate_aerodrome,
                'departure_station' => $departure_station,
                'departure_latlong' => $departure_latlong,
                'destination_station' => $destination_station,
                'destination_latlong' => $destination_latlong,
                'alternate_station' => $alternate_station,
                'date_of_flight' => $date_of_flight,
                'registration' => $registration,
                'endurance_hours' => $endurance_hours,
                'endurance_minutes' => $endurance_minutes,
                'indian' => $indian,
                'foreigner' => $foreigner,
                'foreigner_nationality' => $foreigner_nationality,
                'pilot_in_command' => $pilot_in_command,
                'mobile_number' => $mobile_number,
                'copilot' => $copilot,
                'cabincrew' => $cabincrew,
                'operator' => $operator,
                'sel' => $sel,
                'fir_crossing_time' => $fir_crossing_time,
                'pbn' => $pbn,
                'nav' => $nav,
                'code' => $code,
                'per' => $per,
                'take_off_altn' => $take_off_altn,
                'route_altn' => $route_altn,
                'tcas' => $tcas,
                'credit' => $credit,
                'no_credit' => $no_credit,
                'remarks' => $remarks,
                'remarks1' => '',
                'emergency_uhf' => $emergency_uhf,
                'emergency_vhf' => $emergency_vhf,
                'emergency_elba' => $emergency_elba,
                'polar' => $polar,
                'desert' => $desert,
                'maritime' => $maritime,
                'jungle' => $jungle,
                'light' => $light,
                'floures' => $floures,
                'jacket_uhf' => $jacket_uhf,
                'jacket_vhf' => $jacket_vhf,
                'number' => $number,
                'capacity' => $capacity,
                'cover' => $cover,
                'color' => $color,
                'aircraft_color' => $aircraft_color,
                'fic' => $fic,
                'adc' => $adc,
                'india_time' => $india_time,
                'plan_status' => $plan_status,
                'filed_date' => $filed_date,
                'tbn' => "TBN",
                'date' => $date,
                'signature' => $signature,
                'remarks_value' => $remarks_value,
                'filing_time' => $filing_time,
                'filing_date' => $filing_date,
                'station_addresses_data' => '',
                'originator' => '',
                'is_new_plan' => $request->is_new_plan,
            ];
//            echo '<pre>'; print_r($data);

            if ($request->is_myaccount) {
                $data['is_id'] = $request->is_id;

                $flight_rule_change = $this->flight_rule_change($data);

                $speed_change = $this->speed_change($data);
                $equipments_change = $this->equipments_change($data);
                $flying_time_change = $this->flying_time_change($data);
                $other_changes = $this->other_changes($data);

                $data_change = [];
                $data_change['equipment'] = (array_key_exists('equipment', $data)) ? $data['equipment'] : '';
                $data_change['transponder'] = (array_key_exists('transponder', $data)) ? $data['transponder'] : '';
                $data_change['nav'] = (array_key_exists('nav', $data)) ? $data['nav'] : '';
                $data_change['sel'] = (array_key_exists('sel', $data)) ? $data['sel'] : '';
                $data_change['code'] = (array_key_exists('code', $data)) ? $data['code'] : '';
//                $data_change['operator'] = (array_key_exists('operator', $data)) ? $data['operator'] : '';
                $data_change['per'] = (array_key_exists('per', $data)) ? $data['per'] : '';
                $data_change['credit'] = (array_key_exists('credit', $data)) ? $data['credit'] : '';
                $data_change['tcas'] = (array_key_exists('tcas', $data)) ? $data['tcas'] : '';

                $data_change['emergency_uhf'] = (array_key_exists('emergency_uhf', $data)) ? $data['emergency_uhf'] : '';
                $data_change['emergency_vhf'] = (array_key_exists('emergency_vhf', $data)) ? $data['emergency_vhf'] : '';
                $data_change['emergency_elba'] = (array_key_exists('emergency_elba', $data)) ? $data['emergency_elba'] : '';
                $data_change['polar'] = (array_key_exists('polar', $data)) ? $data['polar'] : '';
                $data_change['desert'] = (array_key_exists('desert', $data)) ? $data['desert'] : '';
                $data_change['maritime'] = (array_key_exists('maritime', $data)) ? $data['maritime'] : '';
                $data_change['jungle'] = (array_key_exists('jungle', $data)) ? $data['jungle'] : '';
                $data_change['light'] = (array_key_exists('light', $data)) ? $data['light'] : '';
                $data_change['floures'] = (array_key_exists('floures', $data)) ? $data['floures'] : '';
                $data_change['jacket_uhf'] = (array_key_exists('jacket_uhf', $data)) ? $data['jacket_uhf'] : '';
                $data_change['jacket_vhf'] = (array_key_exists('jacket_vhf', $data)) ? $data['jacket_vhf'] : '';
                $data_change['number'] = (array_key_exists('number', $data)) ? $data['number'] : '';
                $data_change['capacity'] = (array_key_exists('capacity', $data)) ? $data['capacity'] : '';
                $data_change['cover'] = (array_key_exists('cover', $data)) ? $data['cover'] : '';
                $data_change['color'] = (array_key_exists('color', $data)) ? $data['color'] : '';
                $data_change['aircraft_color'] = (array_key_exists('aircraft_color', $data)) ? $data['aircraft_color'] : '';

                unset($data['route1']);
                unset($data['remarks1']);
                unset($data['tbn']);
                unset($data['date']);
                unset($data['signature']);
                unset($data['remarks_value']);
                unset($data['filing_time']);
                unset($data['filing_date']);
                unset($data['station_addresses_data']);
                unset($data['originator']);
                unset($data['is_new_plan']);
                unset($data['is_id']);
                unset($data['email']);

                unset($data['equipment']);
                unset($data['transponder']);
                unset($data['nav']);
                unset($data['sel']);
                unset($data['code']);
                unset($data['operator']);
                unset($data['per']);
                unset($data['credit']);
                unset($data['tcas']);

                unset($data['emergency_uhf']);
                unset($data['emergency_vhf']);
                unset($data['emergency_elba']);
                unset($data['polar']);
                unset($data['desert']);
                unset($data['maritime']);
                unset($data['jungle']);
                unset($data['light']);
                unset($data['floures']);
                unset($data['jacket_uhf']);
                unset($data['jacket_vhf']);
                unset($data['number']);
                unset($data['capacity']);
                unset($data['cover']);
                unset($data['color']);
                unset($data['aircraft_color']);

                unset($data['fic']);
                unset($data['adc']);

                $aircraft_callsign_without_num = substr($aircraft_callsign, 0, 5);

                $result_update = FlightPlanDetailsModel::where('id', $request->is_id)->update($data);
//		$update_aircraft_callsign_data = FlightPlanDetailsModel::where('aircraft_callsign','=',$aircraft_callsign_without_num)
                //			->toSql();
                $update_aircraft_callsign_data = FlightPlanDetailsModel::
                        where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign_without_num . '%')
                        ->update($data_change);

                if ($request->is_id) {
                    //Notifiacations And FPL stats
                    $notification_data = ['user_id' => $this->user_id, 'action' => 5, 'unique_id' => $request->is_id,
                        'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Changed successfully',
                        'is_active' => 1];

                    WebNotificationsModel::create($notification_data);

                    $changed_time = gmdate('Y-m-d H:i:s');
                    $fpl_stats_data = ['changed_by' => $this->user_id, 'changed_time' => $changed_time];

                    FPLStatsModel::where('fpl_id', $request->is_id)->update($fpl_stats_data);
                }
//
                //		DB::enableQueryLog();
                //                dd($update_aircraft_callsign_data);
                if ($flight_rule_change || $speed_change || $equipments_change || $flying_time_change || $other_changes) {
                    return Redirect::to('fpl')->with('success', $aircraft_callsign . ' FLIGHT PLAN DETAILS CHANGED SUCCESSFULLY');
                } else {
                    return Redirect::to('fpl')->with('success', '');
                }
            }

            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
            $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;
            $is_watch_hour_valid = myFunction::get_watch_hours($data);
            $data['is_watch_hour_valid'] = $is_watch_hour_valid;
            if ($is_watch_hour_valid) {
                $entered_departure_time = $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes;
            } else {
                $entered_departure_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes . '</span>';
            }
            if ($is_watch_hour_valid) {
                $entered_destination_time = $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes;
            } else {
                $entered_destination_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes . '</span>';
            }
            $data['entered_departure_time'] = $entered_departure_time;
            $data['entered_destination_time'] = $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;

            $get_dept_watch_hours_info = myFunction::get_watch_hours_info($data, '1');
            $get_dest_watch_hours_info = myFunction::get_watch_hours_info($data);
            $get_dept_sunrise_sunset_info = myFunction::get_sunrise_sunset_info($data, '1');
            $get_dest_sunrise_sunset_info = myFunction::get_sunrise_sunset_info($data);

            $data['get_dept_watch_hours_info'] = $get_dept_watch_hours_info;
            $data['get_dest_watch_hours_info'] = $get_dest_watch_hours_info;
            $data['get_dept_sunrise_sunset_info'] = $get_dept_sunrise_sunset_info;
            $data['get_dest_sunrise_sunset_info'] = $get_dest_sunrise_sunset_info;

            $data['filed_by'] = "<span style=color:#404040;>Filed By:</span> <span style=color:#404040;>" . $this->user_name . "</span>";
            $data['filed_date'] = "<span style=margin-left:18px;color:#404040;>Filed Date:</span> <span style=color:#404040;>" . date('d-M-Y') . "</span>";
            date_default_timezone_set('Asia/Calcutta');
            $data['filed_time'] = " <span style=color:#404040;>Filed Time: </span><span style=color:#404040;>" . date('h:i:s') . "  IST" . "</span>";
            $data['filed_via'] = "<span style=margin-left:10px></span>Filed Via: " . $_SERVER['HTTP_HOST'];
            $data['date_info'] = $data['filed_by'] . ' ' . $data['filed_date'] . ' ' . $data['filed_time'];
            $subject = "FPL " . $aircraft_callsign . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes
                    . "-" . $destination_aerodrome . " // " . date('d-M-Y', strtotime($date_of_flight));
            $data['subject'] = $subject;
            return view('fpl.new_quick_fpl', $data);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller new_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller new_plan : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function file_the_process($data) {
        try {
            $user_id = $this->user_id;
            //            print_r($data);exit;
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
            $aircraft_callsign = $data['aircraft_callsign'];
            $departure_aerodrome = $data['departure_aerodrome'];
            $departure_time_hours = $data['departure_time_hours'];
            $departure_time_minutes = $data['departure_time_minutes'];
            $destination_aerodrome = $data['destination_aerodrome'];
            $date_of_flight = $data['date_of_flight'];
            $pilot_in_command = $data['pilot_in_command'];
            $mobile_number = $data['mobile_number'];
            $copilot = $data['copilot'];
            $cabincrew = $data['cabincrew'];
            $crushing_speed_indication = $data['crushing_speed_indication'];
            $crushing_speed = $data['crushing_speed'];
            $flight_level_indication = $data['flight_level_indication'];
            $flight_level = $data['flight_level'];
            $total_flying_hours = $data['total_flying_hours'];
            $total_flying_minutes = $data['total_flying_minutes'];
            $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
            $second_alternate_aerodrome = $data['second_alternate_aerodrome'];
            $route = $data['route'] . ' ' . $data['route1'];
            $remarks = $data['remarks'] . ' ' . $data['remarks1'];
            $endurance_hours = $data['endurance_hours'];
            $endurance_minutes = $data['endurance_minutes'];
            $indian = $data['indian'];
            $foreigner = $data['foreigner'];
            $foreigner_nationality = $data['foreigner_nationality'];
            $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
            $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
            $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
            $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
            $get_auto_num_details = FlightPlanDetailsModel::get_auto_num_details($data);
            $get_auto_cancel_details = FlightPlanDetailsModel::get_auto_num_details($data, '1');
            if (count($get_auto_cancel_details)) {
                $this->auto_cancel($data);
            }
            if (count($get_auto_num_details) && substr($aircraft_callsign, 0, 2) == 'VT') {
                $data['aircraft_callsign_count'] = count($get_auto_num_details);
                $aircraft_callsign = myFunction::get_auto_number($data);
            } else {
                $aircraft_callsign = substr($aircraft_callsign, 0, 5);
            }
            $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';
            $flight_type = (array_key_exists('flight_type', $data)) ? $data['flight_type'] : '';
            $aircraft_type = (array_key_exists('aircraft_type', $data)) ? $data['aircraft_type'] : '';
            $weight_category = (array_key_exists('weight_category', $data)) ? $data['weight_category'] : '';
            $equipment = (array_key_exists('equipment', $data)) ? $data['equipment'] : '';
            $transponder = (array_key_exists('transponder', $data)) ? $data['transponder'] : '';
            $alternate_station = (array_key_exists('alternate_station', $data)) ? $data['alternate_station'] : '';
            $registration = (array_key_exists('registration', $data)) ? $data['registration'] : '';
            $operator = (array_key_exists('operator', $data)) ? $data['operator'] : '';
            $sel = (array_key_exists('sel', $data)) ? $data['sel'] : '';
            $fir_crossing_time = (array_key_exists('fir_crossing_time', $data)) ? $data['fir_crossing_time'] : '';
            $pbn = (array_key_exists('pbn', $data)) ? $data['pbn'] : '';
            $nav = (array_key_exists('nav', $data)) ? $data['nav'] : '';
            $code = (array_key_exists('code', $data)) ? $data['code'] : '';
            $per = (array_key_exists('per', $data)) ? $data['per'] : '';
            $take_off_altn = (array_key_exists('take_off_altn', $data)) ? $data['take_off_altn'] : '';
            $route_altn = (array_key_exists('route_altn', $data)) ? $data['route_altn'] : '';
            $tcas = (array_key_exists('tcas', $data)) ? $data['tcas'] : '';
            $credit = (array_key_exists('credit', $data)) ? $data['credit'] : '';
            $no_credit = (array_key_exists('no_credit', $data)) ? $data['no_credit'] : '';
            $emergency_uhf = (array_key_exists('emergency_uhf', $data)) ? $data['emergency_uhf'] : '';
            $emergency_vhf = (array_key_exists('emergency_vhf', $data)) ? $data['emergency_vhf'] : '';
            $emergency_elba = (array_key_exists('emergency_elba', $data)) ? $data['emergency_elba'] : '';
            $polar = (array_key_exists('polar', $data)) ? $data['polar'] : '';
            $desert = (array_key_exists('desert', $data)) ? $data['desert'] : '';
            $maritime = (array_key_exists('maritime', $data)) ? $data['maritime'] : '';
            $jungle = (array_key_exists('jungle', $data)) ? $data['jungle'] : '';
            $light = (array_key_exists('light', $data)) ? $data['light'] : '';
            $floures = (array_key_exists('floures', $data)) ? $data['floures'] : '';
            $jacket_uhf = (array_key_exists('jacket_uhf', $data)) ? $data['jacket_uhf'] : '';
            $jacket_vhf = (array_key_exists('jacket_vhf', $data)) ? $data['jacket_vhf'] : '';
            $number = (array_key_exists('number', $data)) ? $data['number'] : '';
            $capacity = (array_key_exists('capacity', $data)) ? $data['capacity'] : '';
            $cover = (array_key_exists('cover', $data)) ? $data['cover'] : '';
            $color = (array_key_exists('color', $data)) ? $data['color'] : '';
            $aircraft_color = (array_key_exists('aircraft_color', $data)) ? $data['aircraft_color'] : '';
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');
            $date = "";
            $signature = "";
            $remarks_value = "";
            $filing_time = $filed_date;
            $station_addresses_data = myFunction::station_addresses($departure_aerodrome, $destination_aerodrome);
            $originator = "KINDXAAI";
            $data = [
                'user_id' => $this->user_id,
                'aircraft_callsign' => $aircraft_callsign,
                'flight_rules' => $flight_rules,
                'flight_type' => $flight_type,
                'aircraft_type' => $aircraft_type,
                'weight_category' => $weight_category,
                'equipment' => $equipment,
                'transponder' => $transponder,
                'departure_aerodrome' => $departure_aerodrome,
                'departure_time_hours' => $departure_time_hours,
                'departure_time_minutes' => $departure_time_minutes,
                'crushing_speed_indication' => $crushing_speed_indication,
                'crushing_speed' => $crushing_speed,
                'flight_level_indication' => $flight_level_indication,
                'flight_level' => $flight_level,
                'route' => $route,
                'route1' => '',
                'destination_aerodrome' => $destination_aerodrome,
                'total_flying_hours' => $total_flying_hours,
                'total_flying_minutes' => $total_flying_minutes,
                'first_alternate_aerodrome' => $first_alternate_aerodrome,
                'second_alternate_aerodrome' => $second_alternate_aerodrome,
                'departure_station' => $departure_station,
                'departure_latlong' => $departure_latlong,
                'destination_station' => $destination_station,
                'destination_latlong' => $destination_latlong,
                'alternate_station' => $alternate_station,
                'date_of_flight' => $date_of_flight,
                'registration' => $registration,
                'endurance_hours' => $endurance_hours,
                'endurance_minutes' => $endurance_minutes,
                'indian' => $indian,
                'foreigner' => $foreigner,
                'foreigner_nationality' => $foreigner_nationality,
                'pilot_in_command' => $pilot_in_command,
                'mobile_number' => $mobile_number,
                'copilot' => $copilot,
                'cabincrew' => $cabincrew,
                'operator' => $operator,
                'sel' => $sel,
                'fir_crossing_time' => $fir_crossing_time,
                'pbn' => $pbn,
                'nav' => $nav,
                'code' => $code,
                'per' => $per,
                'take_off_altn' => $take_off_altn,
                'route_altn' => $route_altn,
                'tcas' => $tcas,
                'credit' => $credit,
                'no_credit' => $no_credit,
                'remarks' => $remarks,
                'remarks1' => '',
                'emergency_uhf' => $emergency_uhf,
                'emergency_vhf' => $emergency_vhf,
                'emergency_elba' => $emergency_elba,
                'polar' => $polar,
                'desert' => $desert,
                'maritime' => $maritime,
                'jungle' => $jungle,
                'light' => $light,
                'floures' => $floures,
                'jacket_uhf' => $jacket_uhf,
                'jacket_vhf' => $jacket_vhf,
                'number' => $number,
                'capacity' => $capacity,
                'cover' => $cover,
                'color' => $color,
                'aircraft_color' => $aircraft_color,
                'fic' => $fic,
                'adc' => $adc,
                'india_time' => $india_time,
                'plan_status' => $plan_status,
                'filed_date' => $filed_date,
                'tbn' => "TBN",
                'date' => $date,
                'signature' => $signature,
                'remarks_value' => $remarks_value,
                'filing_time' => $filing_time,
                'station_addresses_data' => $station_addresses_data,
                'originator' => $originator,
            ];

            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
            $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;
            $is_watch_hour_valid = myFunction::get_watch_hours($data);
            $data['is_watch_hour_valid'] = $is_watch_hour_valid;
            if ($is_watch_hour_valid) {
                $entered_departure_time = $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes;
            } else {
                $entered_departure_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes . '</span>';
            }
            if ($is_watch_hour_valid) {
                $entered_destination_time = $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes;
            } else {
                $entered_destination_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes . '</span>';
            }
            $data['entered_departure_time'] = $entered_departure_time;
            $data['entered_destination_time'] = $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;

            $data['is_active'] = 1;

//	    //Notifiacations
            //	    $notification_data = ['user_id' => $this->user_id, 'action' => 1, 'unique_id' => $result->id,
            //		'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Processed successfully',
            //		'is_active' => 1];

            $result = FlightPlanDetailsModel::create($data);

            $data['fpl_id'] = $result->id;

            LoadtrimModel::update_fpl_id($data);

            //Notifiacations
            $notification_data = ['user_id' => $this->user_id, 'action' => 1, 'unique_id' => $result->id,
                'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Processed successfully',
                'is_active' => 1];

            WebNotificationsModel::create($notification_data);

            $data['filed_by'] = "<span style=color:#404040;>" . $this->user_name . "</span>";
            $data['filed_date'] = "<span style='color:#f00;'>" . date('d-M-Y') . "</span>";
            date_default_timezone_set('Asia/Calcutta');
            $data['filed_time'] = "<span style='color:#f00;'>" . date('h:i:s') . "  IST" . "</span>";
            $data['filed_via'] = "<span style='margin-left:10px;color:#404040;'></span>Filed Via: " . $_SERVER['HTTP_HOST'];
//	    $data['date_info'] = $data['filed_by'] . ' ' . $data['filed_date'] . ' ' . $data['filed_time'];
            $data['station_addresses_data'] = '<span style=color:#404040;font-weight:bold;></span>' . $station_addresses_data;

            $data['subject_type'] = 'fpl';
            $subject = myFunction::get_subject($data);

            $data['subject'] = $subject;
            $mail_headers = [
                'from' => $this->from,
                'from_name' => $this->from_name,
                'subject' => $subject,
                'to' => $this->user_email,
                //'cc' => $this->cc,
                'cc' => myFunction::get_cc_mails($data),
                'bcc' => myFunction::get_bcc_mails(),
            ];
            $mail_data = $data;
            $fileName = str_replace('/', '', $subject) . '.pdf';
            $AnnexureCopy = 'AnnexureCopy.pdf';
            $filePath = public_path('media/images/fpl/downloads/');

            $flight_plan_pdf_content = view('templates.pdf.fpl.flight_plan_pdf', $data);
            PDF::loadHTML($flight_plan_pdf_content)
                    ->setPaper('a4')
                    ->setOrientation('portrait')
                    ->save($filePath . $fileName);

            $annexure_copy_content = view('templates.pdf.fpl.annexure_copy', $data);
            PDF::loadHTML($annexure_copy_content)
                    ->setPaper('a4')
                    ->setOrientation('portrait')
                    ->save($filePath . $AnnexureCopy);

            $pdf_path = ['pathToFile' => public_path('media/images/fpl/downloads/' . $fileName), 'AnnexureCopy' => $filePath . $AnnexureCopy,
                'departure_aerodrome' => $departure_aerodrome];
            $mail = Mail::send('emails.fpl.flight_plan', $mail_data, function ($message) use ($mail_headers, $pdf_path, $fileName) {
                        $message->from($mail_headers['from'], $mail_headers['from_name']);
                        $message->subject($mail_headers['subject']);
                        $message->to($mail_headers['to']);
                        $message->cc($mail_headers['cc']);
                        $message->bcc($mail_headers['bcc']);
                        $message->attach($pdf_path['pathToFile'], array(
                            'as' => $fileName,
                            'mime' => 'application/pdf')
                        );
                        if ($pdf_path['departure_aerodrome'] == 'VABB') {
                            $message->attach($pdf_path['AnnexureCopy'], array(
                                'as' => 'Annexure Copy.pdf',
                                'mime' => 'application/pdf')
                            );
                        }
                    });
            unlink($filePath . $AnnexureCopy);
            $result['file_name'] = $fileName;
            $result['pdf_path'] = 'media/images/fpl/downloads/' . $fileName;
            if ($result) {
                return $result;
            } else {
                return '0';
            }
        } catch (\Exception $ex) {
            Log::error('Fpl Controller file_the_process: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller file_the_process : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function auto_cancel($data) {
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $cancelled_by = (array_key_exists('cancelled_by', $data)) ? $data['cancelled_by'] : 'AUTO';

        //Status update
        $update_plan_status = FlightPlanDetailsModel::where('departure_aerodrome', $departure_aerodrome)
                        ->where('destination_aerodrome', $destination_aerodrome)
                        ->where('date_of_flight', $date_of_flight)
                        ->where('departure_time_hours', $departure_time_hours)
                        ->where('departure_time_minutes', $departure_time_minutes)->update(['plan_status' => '2']);

        $subject = "AUTO CANCEL " . $aircraft_callsign . " " . $departure_aerodrome . "" . $departure_time_hours . "" . $departure_time_minutes . " " . $destination_aerodrome . " // DOF " . $date_of_flight;

        $data['cancelled_by'] = "<span style='color:#f1292b;'>Cancelled By: $cancelled_by</span>";
        $data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";

        date_default_timezone_set('Asia/Calcutta');
        $data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['cancelled_via'] = "<span style='margin-left:33px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];

        $data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";
        $data['heading_top'] = "AUTO CANCEL";
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
//	    'cc' => $this->cc,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        Mail::send('emails.fpl.fpl_cancel', $data, function ($message) use ($mail_headers) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($mail_headers['subject']);
            $message->cc($mail_headers['cc']);
            $message->bcc($mail_headers['bcc']);
        });

        return 1;
    }

    public function get_auto_number($data) {
        $aircraft_callsign = substr($data['aircraft_callsign'], 0, 5);
        $aircraft_callsign_count = $data['aircraft_callsign_count'];
        $aircraft_callsign = $aircraft_callsign . $aircraft_callsign_count;
//	echo $aircraft_callsign;exit;
        return $aircraft_callsign;
    }

    public function flight_rule_change($data) {

        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $mail_send = '';
        $id = $data['is_id'];

        $fpl_details = FlightPlanDetailsModel::find($id);

        $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';
        $flight_rules2 = ($fpl_details) ? $fpl_details->flight_rules : '';
        $flight_type = (array_key_exists('flight_type', $data)) ? $data['flight_type'] : '';

        if ($flight_rules2 != $flight_rules) {
            $mail_send = 1;
            $flight_rules = "<span  style='color:red'>" . $flight_rules . '</span>';
        }

        // (CHG-TESTX-ZZZZ1000-ZZZZ-DOF/161001-8/YG)

        $changed_by = $this->user_name;
        $subject = $aircraft_callsign . " FPL CHANGED FOR DOF/" . $date_of_flight;

        $data['changed_by'] = "Changed  By: <span style=color:#404040;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['flight_rule_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                $date_of_flight . "-8/" . $flight_rules . $flight_type . ")";

        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//	    Mail::send('emails.fpl.myaccount.flight_rule_change', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            Log::info("FlightRuleChangeEmailJob Queues Begins");
            $this->dispatch(new FlightRuleChangeEmailJob($data));
            Log::info("FlightRuleChangeEmailJob Queues ends");
        }
        return $mail_send;
    }

    public function speed_change($data) {
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $crushing_speed = $data['crushing_speed'];
        $crushing_speed_indication = $data['crushing_speed_indication'];
        $flight_level = $data['flight_level'];
        $flight_level_indication = $data['flight_level_indication'];
        $route = $data['route'];
        $mail_send = '';
        $id = $data['is_id'];
        $fpl_details = FlightPlanDetailsModel::find($id);

        $crushing_speed2 = ($fpl_details) ? $fpl_details->crushing_speed : '';
        $crushing_speed_indication2 = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
        $flight_level2 = ($fpl_details) ? $fpl_details->flight_level : '';
        $flight_level_indication2 = ($fpl_details) ? $fpl_details->flight_level_indication : '';
        $route2 = ($fpl_details) ? $fpl_details->route : '';

        if ($crushing_speed2 != $crushing_speed) {
            $mail_send = 1;
            $crushing_speed = "<span style='color:red'>" . $crushing_speed . '</span>';
        }
        if ($crushing_speed_indication2 != $crushing_speed_indication) {
            $mail_send = 1;
            $crushing_speed_indication = "<span  style='color:red'>" . $crushing_speed_indication . '</span>';
        }
        if ($flight_level2 != $flight_level) {
            $mail_send = 1;
            $flight_level = "<span  style='color:red'>" . $flight_level . '</span>';
        }
        if ($flight_level_indication2 != $flight_level_indication) {
            $mail_send = 1;
            $flight_level_indication = "<span  style='color:red'>" . $flight_level_indication . '</span>';
        }
        if ($route2 != $route) {
            $mail_send = 1;
            $route = "<span  style='color:red'>" . $route . '</span>';
        }
        $changed_by = $this->user_name;

        $subject = $aircraft_callsign . " FPL CHANGED FOR DOF/" . $date_of_flight;

        $data['changed_by'] = "Changed  By: <span style=color:#404040;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['speed_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                $date_of_flight . "-15/" . $crushing_speed_indication . $crushing_speed . $flight_level_indication . $flight_level . " " . $route . ")";

        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
//	    'cc' => $this->cc,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//	    Mail::send('emails.fpl.myaccount.speed_change', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            Log::info("SpeedChangeEmailJob Queues Begins");
            $this->dispatch(new SpeedChangeEmailJob($data));
            Log::info("FlightPlanEmailJob Queues ends");
        }
        return $mail_send;
    }

    public function equipments_change($data) {
        $id = $data['is_id'];
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $changed_by = $this->user_name;
        $equipment = $data['equipment'];
        $transponder = $data['transponder'];

        $mail_send = '';

        $fpl_details = FlightPlanDetailsModel::find($id);

        $equipment2 = ($fpl_details) ? $fpl_details->equipment : '';
        $transponder2 = ($fpl_details) ? $fpl_details->transponder : '';

        if ($equipment2 != $equipment) {
            $mail_send = 1;

            $equipment = "<span style='color:red'>" . $equipment . '</span>';
        }
        if ($transponder2 != $transponder) {
            $mail_send = 1;

            $transponder = "<span  style='color:red'>" . $transponder . '</span>';
        }

        $subject = $aircraft_callsign . " FPL CHANGED FOR DOF/" . $date_of_flight;
        $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['equipments_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . "-10/"
                . $equipment . "/" . $transponder . ")";
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//	    Mail::send('emails.fpl.myaccount.equipments_change', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            Log::info("SpeedChangeEmailJob Queues Begins");
            $this->dispatch(new EquipmentChangeEmailJob($data));
            Log::info("SpeedChangeEmailJob Queues Begins");
        }
        return $mail_send;
    }

    public function flying_time_change($data) {
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];

        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
        $second_alternate_aerodrome = $data['second_alternate_aerodrome'];

        $mail_send = '';
        $id = $data['is_id'];
        $fpl_details = FlightPlanDetailsModel::find($id);

        $total_flying_hours2 = ($fpl_details) ? $fpl_details->total_flying_hours : '';
        $total_flying_minutes2 = ($fpl_details) ? $fpl_details->total_flying_minutes : '';
        $first_alternate_aerodrome2 = ($fpl_details) ? $fpl_details->first_alternate_aerodrome : '';
        $second_alternate_aerodrome2 = ($fpl_details) ? $fpl_details->second_alternate_aerodrome : '';

        if ($total_flying_hours2 != $total_flying_hours) {
            $mail_send = 1;
            $total_flying_hours = "<span style='color:red'>" . $total_flying_hours . '</span>';
        }
        if ($total_flying_minutes2 != $total_flying_minutes) {
            $mail_send = 1;
            $total_flying_minutes = "<span  style='color:red'>" . $total_flying_minutes . '</span>';
        }
        if ($first_alternate_aerodrome2 != $first_alternate_aerodrome) {
            $mail_send = 1;
            $first_alternate_aerodrome = "<span  style='color:red'>" . $first_alternate_aerodrome . '</span>';
        }
        if ($second_alternate_aerodrome2 != $second_alternate_aerodrome) {
            $mail_send = 1;
            $second_alternate_aerodrome = "<span  style='color:red'>" . $second_alternate_aerodrome . '</span>';
        }
        $changed_by = $this->user_name;

        $subject = $aircraft_callsign . " FPL CHANGED FOR DOF/" . $date_of_flight;

        $data['changed_by'] = "Changed  By: <span style=color:#404040;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['flying_time_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight
                . "-16/" . $destination_aerodrome . $total_flying_hours . $total_flying_minutes
                . " " . $first_alternate_aerodrome . " " . $second_alternate_aerodrome . ")";
//	(CHG-CALLSIGN-DEP AERODEP TIME-DEST AERO-DOF/YYMMDD-16/DEST AEROFLYING TIME ALTERNATE1 ALTERNATE2)
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//	    Mail::send('emails.fpl.myaccount.flying_time_change', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            Log::info("SpeedChangeEmailJob Queues Begins");
            $this->dispatch(new FlyingTimeChangeEmailJob($data));
            Log::info("SpeedChangeEmailJob Queues Begins");
        }
        return $mail_send;
    }

    public function other_changes($data) {
        //Values after change
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];

        $pbn = (array_key_exists('pbn', $data)) ? $data['pbn'] : '';
        $nav = (array_key_exists('nav', $data)) ? $data['nav'] : '';
        $registration = (array_key_exists('registration', $data)) ? $data['registration'] : '';
        $fir_crossing_time = (array_key_exists('fir_crossing_time', $data)) ? $data['fir_crossing_time'] : '';
        $sel = (array_key_exists('sel', $data)) ? $data['sel'] : '';
        $code = (array_key_exists('code', $data)) ? $data['code'] : '';
        $operator = (array_key_exists('operator', $data)) ? $data['operator'] : '';
        $per = (array_key_exists('per', $data)) ? $data['per'] : '';
        $take_off_altn = (array_key_exists('take_off_altn', $data)) ? $data['take_off_altn'] : '';
        $route_altn = (array_key_exists('route_altn', $data)) ? $data['route_altn'] : '';
        $tcas = (array_key_exists('tcas', $data)) ? ($data['tcas'] == 'YES') ? 'YES' : 'NO' : 'NO';
        $credit = (array_key_exists('credit', $data)) ? $data['credit'] : '';
        $remarks = $data['remarks'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $indian = $data['indian'];
        $foreigner = $data['foreigner'];
        $foreigner_nationality = $data['foreigner_nationality'];
        $endurance_hours = $data['endurance_hours'];
        $endurance_minutes = $data['endurance_minutes'];
        $route = $data['route'] . ' ' . $data['route1'];
        $alternate_station = (array_key_exists('alternate_station', $data)) ? $data['alternate_station'] : '';
        $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';

        $mail_send = '';
        $id = $data['is_id'];
        //Values before change
        $fpl_details = FlightPlanDetailsModel::find($id);

        $pbn2 = ($fpl_details) ? $fpl_details->pbn : '';
        $nav2 = ($fpl_details) ? $fpl_details->nav : '';
        $registration2 = ($fpl_details) ? $fpl_details->registration : '';
        $fir_crossing_time2 = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
        $sel2 = ($fpl_details) ? $fpl_details->sel : '';
        $code2 = ($fpl_details) ? $fpl_details->code : '';
        $operator2 = ($fpl_details) ? $fpl_details->operator : '';
        $per2 = ($fpl_details) ? $fpl_details->per : '';
        $take_off_altn2 = ($fpl_details) ? $fpl_details->take_off_altn : '';
        $route_altn2 = ($fpl_details) ? $fpl_details->route_altn : '';
        $tcas2 = ($fpl_details) ? ($fpl_details->tcas == 'YES') ? 'YES' : 'NO' : 'NO';
        $credit2 = ($fpl_details) ? $fpl_details->credit : '';
        $remarks2 = ($fpl_details) ? $fpl_details->remarks : '';
        $indian2 = ($fpl_details) ? $fpl_details->indian : '';
        $foreigner2 = ($fpl_details) ? $fpl_details->foreigner : '';
        $foreigner_nationality2 = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
        $pilot_in_command2 = ($fpl_details) ? $fpl_details->pilot_in_command : '';
        $mobile_number2 = ($fpl_details) ? $fpl_details->mobile_number : '';
        $endurance_hours2 = ($fpl_details) ? $fpl_details->endurance_hours : '';
        $endurance_minutes2 = ($fpl_details) ? $fpl_details->endurance_minutes : '';
        $alternate_station2 = ($fpl_details) ? $fpl_details->alternate_station : '';
        $flight_rules2 = ($fpl_details) ? $fpl_details->flight_rules : '';

        if ($pbn2 != $pbn) {
            $mail_send = 1;
            $pbn = "<span style='color:red'>" . $pbn . '</span>';
        }
        if ($nav2 != $nav) {
            $mail_send = 1;

            $nav = "<span  style='color:red'>" . $nav . '</span>';
        }
        if ($registration2 != $registration) {
            $mail_send = 1;
            $registration = "<span  style='color:red'>" . $registration . '</span>';
        }
        if ($fir_crossing_time2 != $fir_crossing_time) {
            $mail_send = 1;
            $fir_crossing_time = "<span  style='color:red'>" . $fir_crossing_time . '</span>';
        }
        if ($sel2 != $sel) {
            $mail_send = 1;

            $sel = "<span  style='color:red'>" . $sel . '</span>';
        }
        if ($code2 != $code) {
            $mail_send = 1;

            $code = "<span  style='color:red'>" . $code . '</span>';
        }
        if ($operator2 != $operator) {
            $mail_send = 1;

            $operator = "<span  style='color:red'>" . $operator . '</span>';
        }
        if ($per2 != $per) {
            $mail_send = 1;

            $per = "<span  style='color:red'>" . $per . '</span>';
        }
        if ($take_off_altn2 != $take_off_altn) {
            $mail_send = 1;
            $take_off_altn = "<span  style='color:red'>" . $take_off_altn . '</span>';
        }
        if ($route_altn2 != $route_altn) {
            $mail_send = 1;
            $route_altn = "<span  style='color:red'>" . $route_altn . '</span>';
        }
        if ($tcas2 != $tcas) {
            $mail_send = 1;
            $tcas_value = ($tcas == 'YES') ? "<span  style='color:red'>TCAS EQUIPPED</span>" : '';
        } else {
            $tcas_value = ($tcas == 'YES') ? "TCAS EQUIPPED" : '';
        }
        if ($credit2 != $credit) {
            $mail_send = 1;
            $credit_value = ($credit == "YES") ? "<span style='color:red'> CREDIT FACILITY AVAILABLE WITH AAI </span>" : "<span  style='color:red'> NO CREDIT FACILITY</span>";
        } else {
            $credit_value = ($credit == "YES") ? " CREDIT FACILITY AVAILABLE WITH AAI " : ' NO CREDIT FACILITY';
        }
        if ($remarks2 != $remarks) {
            $mail_send = 1;
            $remarks = "<span  style='color:red'>" . $remarks . '</span>';
        }
        if ($indian2 != $indian) {
            $mail_send = 1;
            $indian = "<span  style='color:red'>" . $indian . '</span>';
        }
        if ($foreigner_nationality2 != $foreigner_nationality) {
            $mail_send = 1;
            $foreigner_nationality = "<span  style='color:red'>" . $foreigner_nationality . '</span>';
        }
        if ($pilot_in_command2 != $pilot_in_command) {
            $mail_send = 1;
            $pilot_in_command = "<span  style='color:red'>" . $pilot_in_command . '</span>';
        }
        if ($mobile_number2 != $mobile_number) {
            $mail_send = 1;
            $mobile_number = "<span  style='color:red'>" . $mobile_number . '</span>';
        }
        if ($endurance_hours2 != $endurance_hours) {
            $mail_send = 1;
            $endurance_hours = "<span  style='color:red'>" . $endurance_hours . '</span>';
        }
        if ($endurance_minutes2 != $endurance_minutes) {
            $mail_send = 1;
            $endurance_minutes = "<span  style='color:red'>" . $endurance_minutes . '</span>';
        }

        $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
        $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
        $fir_crossing_time_value = ($fir_crossing_time) ? " EET/" . $fir_crossing_time . " " : '';
        $code_value = ($code) ? " CODE/" . $code . "" : '';
        $sel_value = ($sel) ? " SEL/" . $sel . "" : '';
        $per_value = ($per) ? " PER/" . $per . "" : '';
        $alternate_station_value = ($alternate_station) ? " ALTN/" . $alternate_station . "" : '';
        $take_off_altn_value = ($take_off_altn) ? " TALT/" . $take_off_altn . "" : '';
        $route_altn_value = ($route_altn) ? " RALT/" . $route_altn . "" : '';

        $indian_value = ($indian == "YES") ? " ALL INDIANS ON BOARD NO FOREIGNER" : '';
        $foreigner_value = ($foreigner == "YES") ? " FOREIGNER ON BOARD " . $foreigner_nationality : '';

        $changed_by = $this->user_name;
        $subject = $aircraft_callsign . " FPL CHANGED FOR DOF/" . $date_of_flight;
        $data['changed_by'] = "Changed  By: <span style=color:#404040;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];
        $data['other_changes_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight
                . "-18/" . $pbn_value . $nav_value . " REG/" . $registration .
                $fir_crossing_time_value . $sel_value . $code_value . " OPR/" . $operator . $alternate_station_value . $take_off_altn_value .
                $route_altn . " RMK/ " . $remarks . $tcas_value . $credit_value . " PIC " .
                $pilot_in_command . " MOB " . $mobile_number . " " . $indian_value . $foreigner_value . " E" . $endurance_hours . $endurance_minutes .
                ")";

//	(CHG-CALLSIGN-DEP AERODEP TIME-DEST AERO-DATE OF FLIGHT/YYMMDD-18/PBN/
        //	NAV/  DOF/  REG/  EET/  SEL/  CODE/ OPR/  ALTN/  PER/  TALT/  RALT/  RMK/HELLO TCAS EQUIPPED CREDIT FACILITY AVAILABLE
        //		WITH AAI PIC NAME MOB 1234512345 FOREIGNER ON BOARD ITALIAN E0100)
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
//	    'cc' => $this->cc,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];

        if ($mail_send) {
//	    Mail::send('emails.fpl.myaccount.other_changes', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            Log::info("SpeedChangeEmailJob Queues Begins2");
            $this->dispatch(new OtherChangesEmailJob($data));
            Log::info("SpeedChangeEmailJob Queues Begins2");
        }
        return $mail_send;
    }

    public function quick_plan(Request $request) {
        try {

            $get_all = FlightPlanDetailsModel::fetch_fpl_records();
            $get_day_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
            $get_month_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('', '1'));
            $get_year_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
            $get_total_count_fpl = count(FlightPlanDetailsModel::get_count_fpl());
            $get_dates_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
            $get_user_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
            $input = [];
            $data = ['get_all' => $get_all,
                'get_day_count_fpl' => $get_day_count_fpl,
                'get_month_count_fpl' => $get_month_count_fpl,
                'get_year_count_fpl' => $get_year_count_fpl,
                'get_total_count_fpl' => $get_total_count_fpl,
                'get_dates_count_fpl' => $get_dates_count_fpl,
                'get_user_count_fpl' => $get_user_count_fpl,
                'input_data' => $input,
            ];

            return view('fpl.quick_myaccount', $data);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller quick_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller quick_plan : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function filter_plans(Request $request) {
        $input = $request->all();
//	print_r($input);exit;
        $get_all = FlightPlanDetailsModel::get_fpl_filter_data($input);
//	$get_all->setPath('custom/url?from_date=' . $request->from_date);
        $get_day_count_fpl = count($get_all);
        $get_month_count_fpl = count($get_all);
        $get_year_count_fpl = count($get_all);
        $get_total_count_fpl = count($get_all);
        $get_dates_count_fpl = count($get_all);
        $get_user_count_fpl = count($get_all);

        $data = ['get_all' => $get_all,
            'get_day_count_fpl' => $get_day_count_fpl,
            'get_month_count_fpl' => $get_month_count_fpl,
            'get_year_count_fpl' => $get_year_count_fpl,
            'get_total_count_fpl' => $get_total_count_fpl,
            'get_dates_count_fpl' => $get_dates_count_fpl,
            'get_user_count_fpl' => $get_user_count_fpl,
            'input_data' => $input,
        ];
//	print_r($get_filter_data);exit;
        return view('fpl.new_quick_fpl', $data);
    }

    public function new_quick(Request $request) {
        try {
            $data = [];
            return view('fpl.new_quick_fpl', $data);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller new_quick: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller new_quick : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function new_full(Request $request) {
        try {
            return view('fpl.new_full_fpl');
        } catch (\Exception $ex) {
            Log::error('Fpl Controller new_full: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller new_full : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function new_edit(Request $request) {
        try {
            return view('fpl.new_edit_fpl');
        } catch (\Exception $ex) {
            Log::error('Fpl Controller new_edit: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller new_edit : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function get_airports_list(Request $request) {
        $term = $request->term;
        $results = [];
        foreach (StationsModel::get_airport_names($term) as $airports) {
            $results[] = ['label' => $airports->aero_id . ' - ' . $airports->aero_name, 'value' => $airports->aero_id];
        }
        return response()->json($results);
    }

    public function get_plan_status(Request $request) {
        $data = $request->all();
        $check_flight_details = FlightPlanDetailsModel::get_flight_details($data, 1);

        if (!$check_flight_details) {
            return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => 1, 'success' => '1st Time Plan']);
        } else {
            $dof = date('d-M', strtotime('20' . $check_flight_details->date_of_flight));
//	    echo $check_flight_details->date_of_flight;
            return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => 1, 'success' => 'Last Plan Filed On ' . $dof]);
        }
    }

    public function fuel(Request $request) {
        try {
            $page = $request->page;
            $id = $request->id;
            $key = $request->_key;
            $cs = $request->_cs;

            return view('fpl.fuel');
        } catch (\Exception $ex) {
            Log::error('Fpl Controller Index : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller Index : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

}
