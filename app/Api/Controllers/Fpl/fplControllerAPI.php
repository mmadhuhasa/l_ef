<?php

namespace App\Api\Controllers\Fpl;

use App;
use App\Api\Requests\EditPlanRequest;
use App\Api\Requests\FullPlanRequest;
use App\Api\Requests\QuickPlanRequest;
use App\Exceptions\customException;
use App\Http\Controllers\Controller;
use App\Jobs\FlightPlanEmailJob;
use App\models\FlightPlanDetailsModel;
use App\models\PilotDetailsModel;
use App\models\StationsModel;
use App\models\WatchHoursModel;
use App\models\WebNotificationsModel;
use App\myfolder\myFunction;
use Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;
use Input;
use Log;
use Mail;
use PDF;
use Response;
use \App\User;
use App\models\FPLStatsModel;
use App\Jobs\CancelEmailJob;
use App\Jobs\FICADCEmailJob;
use App\models\CallsignInfoModel;
use App\Jobs\DelayEmailJob;
use App\models\loadtrim\LoadtrimModel;
use App\models\Navlog;
class fplControllerAPI extends Controller {

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

    public function get_callsign_details(Request $request) {
        try {
            $aircraft_callsign = $request->aircraft_callsign;
            $result = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $pilot_in_command = ($result) ? $result->pilot_in_command : '';
            $mobile_number = ($result) ? $result->mobile_number : '';
            $copilot = ($result) ? $result->copilot : '';
            $cabincrew = ($result) ? $result->cabincrew : '';
            $departure_aerodrome = ($result) ? $result->destination_aerodrome : '';
            $departure_station = ($result) ? $result->departure_station : '';
            $departure_latlong = ($result) ? $result->departure_latlong : '';
            $destination_station = ($result) ? $result->destination_station : '';
            $destination_latlong = ($result) ? $result->destination_latlong : '';

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
            ]);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller get_callsign_details: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller get_callsign_details : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {GET} /api/fpl/stations_list  Station List
     * @apiName Station List
     * @apiGroup FPL API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_CODE": "1",
      "STATUS_DESC": "success",
      "result": [
      {
      "aero_name": "ADAMPUR",
      "aero_latlong": "3126N07545E"
      }
      ]
      -
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function stations_autocomplete(Request $request) {
        try {
//	    $term = $request->station;
            $result = StationsModel::fetch_stations_and_latlong();
            return response()->json(['STATUS_CODE' => '1', 'STATUS_DESC' => 'success', 'result' => $result]);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller stations_autocomplete: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller stations_autocomplete: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
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
            Bugsnag::notifyException('Fpl Controller station_latlong: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {GET} /api/fpl/pdf_download/{id}  PDF download
     * @apiName PDF download
     * @apiGroup FPL API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "result":

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function pdf_download(Request $request) {
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
            $tcas = '';
//            $agcs = '';
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
                    . "-" . $destination_aerodrome . " " . date('d-M-Y', strtotime($date_of_flight));
            $pdf = PDF::loadView('templates.pdf.fpl.flight_plan_pdf', $data);
            return $pdf->download($subject . '.pdf');
//            //unlink($'filePath.$fileName);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller pdf download: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller pdf download: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
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
            Bugsnag::notifyException('Fpl Controller check_callsign_exist: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {GET} /api/fpl/pilots_list/{aircraft_callsign}  Pilots List
     * @apiName Pilots List
     * @apiGroup FPL API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "result":

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function get_pilots(Request $request) {
        try {
            $aircraft_callsign = $request->aircraft_callsign;
            $result = PilotDetailsModel::get_pilots($aircraft_callsign);
            return response()->json(['STATUS_DESC' => 'success', 'STATUS_CODE' => '1', 'result' => $result], 200);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller get_pilots: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller get_pilots: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function get_pilot_details(Request $request) {
        $pilot_in_command = $request->pilot_name;
        $get_pilot_details = PilotDetailsModel::get_pilot_details($pilot_in_command);
        return response::json(['mobilenum' => $get_pilot_details->mobile]);
    }

    public function copilot(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;
            $copilot = PilotDetailsModel::copilot($aircraft_callsign, $term);
            $results = '';
            foreach ($copilot as $copilot_names) {
                $results[] = ['value' => $copilot_names->copilot];
            }
            return Response::json($results);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller copilot: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller copilot: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {POST} /api/fpl/process_quick_plan  process_quick_plan
     * @apiName process_quick_plan
     * @apiGroup FPL API's
     *
     * @apiParam {String} aircraft_callsign aircraft_callsign
     * @apiParam {String} departure_aerodrome departure_aerodrome
     * @apiParam {String} destination_aerodrome destination_aerodrome
     * @apiParam {String} departure_time_hours departure_time_hours
     * @apiParam {String} departure_time_minutes departure_time_minutes
     * @apiParam {String} pilot_in_command pilot_in_command
     * @apiParam {Number} mobile_number mobile_number
     * @apiParam {String} copilot copilot
     * @apiParam {String} cabincrew cabincrew
     * @apiParam {String} date_of_flight date_of_flight
     * @apiParam {String} email email
     * @apiParam {String} departure_station departure_station
     * @apiParam {String} departure_latlong departure_latlong
     * @apiParam {String} destination_station destination_station
     * @apiParam {String} destination_latlong destination_latlong

     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {Number} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "ATC_FPL_VIEW": "(FPL-TESTA-VG<br>-GFHF/N-XCXXC/A<br>-0745<br>-K4444F455 fcgbfdgdg<br>-1049 VOPG VGGG<br>-DOF/160412 REG/HGEGE OPR/ANAND TALT/FFFF <br>RMK/dfgdfg NO CREDIT FACILITY PIC ANAND MOB 2147483647 ALL INDIANS ON BOARD E0009)"
      "SUPPLEMANTARY_INFO": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO:<br>SURVIVAL EQUIPMENT:<br>JACKETS:<br> <span style='padding-left:0px;'></span>DINGHIES COLOUR: <br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "IS_WATCH_HOUR_VALID": 0
      "DATA": {
      "customer_id": null
      "aircraft_callsign": "TESTA"
      "flight_rules": "V"
      "flight_type": "G"
      "aircraft_type": "GFHF"
      "weight_category": "N"
      "equipment": "XCXXC"
      "transponder": "A"
      "departure_aerodrome": "VOBG"
      "departure_time_hours": "07"
      "departure_time_minutes": "45"
      "crushing_speed_indication": "K"
      "crushing_speed": "4444"
      "flight_level_indication": "F"
      "flight_level": "455"
      "route": "fcgbfdgdg"
      "destination_aerodrome": "VOPC"
      "total_flying_hours": "03"
      "total_flying_minutes": "04"
      "first_alternate_aerodrome": "VOPG"
      "second_alternate_aerodrome": "VGGG"
      "departure_station": null
      "departure_latlong": null
      "destination_station": null
      "destination_latlong": null
      "alternate_station": ""
      "date_of_flight": "160412"
      "registration": "HGEGE"
      "endurance_hours": "00"
      "endurance_minutes": "09"
      "indian": "YES"
      "foreigner": ""
      "foreigner_nationality": ""
      "pilot_in_command": "ANAND"
      "mobile_number": 2147483647
      "copilot": "TEST"
      "cabincrew": "TESTING"
      "operator": "ANAND"
      "sel": ""
      "fir_crossing_time": ""
      "pbn": ""
      "nav": ""
      "code": ""
      "per": ""
      "take_off_altn": "FFFF"
      "route_altn": ""
      "tcas": ""
      "credit": ""
      "no_credit": ""
      "remarks": "dfgdfg"
      "remarks1": ""
      "emergency_uhf": ""
      "emergency_vhf": ""
      "emergency_elba": ""
      "polar": ""
      "desert": ""
      "maritime": ""
      "jungle": ""
      "light": ""
      "floures": ""
      "jacket_uhf": ""
      "jacket_vhf": ""
      "number": ""
      "capacity": ""
      "cover": ""
      "color": ""
      "aircraft_color": "BLUE"
      "fic": ""
      "adc": ""
      "india_time": "15:56:11"
      "plan_status": 1
      "filed_date": "2016-04-01 15:56:11"
      "is_watch_hour_valid": 0
      "entered_departure_time": "0745"
      "entered_destination_time": 1049
      "fpl_info": "(FPL-TESTA-VG<br>-GFHF/N-XCXXC/A<br>-0745<br>-K4444F455 fcgbfdgdg<br>-1049 VOPG VGGG<br>-DOF/160412 REG/HGEGE OPR/ANAND TALT/FFFF <br>RMK/dfgdfg NO CREDIT FACILITY PIC ANAND MOB 2147483647 ALL INDIANS ON BOARD E0009)"
      "supplementary_info": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO:<br>SURVIVAL EQUIPMENT:<br>JACKETS:<br> <span style='padding-left:0px;'></span>DINGHIES COLOUR: <br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "is_process": 1
      }-
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function process_quick_plan(QuickPlanRequest $request) {
        try {
            $aircraft_callsign = $request->aircraft_callsign;
            $departure_aerodrome = $request->departure_aerodrome;
            $departure_time_hours = $request->departure_time_hours;
            $departure_time_minutes = $request->departure_time_minutes;
            $destination_aerodrome = $request->destination_aerodrome;
            $departure_station = $request->departure_station;
            $departure_latlong = $request->departure_latlong;
            $destination_station = $request->destination_station;
            $destination_latlong = $request->destination_latlong;
//	    $pilot_in_command = $request->pilot_in_command;
            //	    $mobile_number = $request->mobile_number;
            //	    $copilot = $request->copilot;
            //	    $cabincrew = $request->cabincrew;
            $date_of_flight = $request->date_of_flight;
            $email = $request->email;
            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');

            $data = $request->all();
            $rules = [];
            if ($departure_aerodrome == 'ZZZZ') {
                $rules['departure_station'] = 'required';
                $rules['departure_latlong'] = 'required';
            }
            if ($destination_aerodrome == 'ZZZZ') {
                $rules['destination_station'] = 'required';
                $rules['destination_latlong'] = 'required';
            }

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                return response()->json(['STATUS_DESC' => 'Please enter valid data', 'STATUS_CODE' => 0], 401);
            }

            $customer_details = User::where('email', $email)->where('is_active', '1')->first();

//	    if ($function == 'edit_page') {
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $callsign_details2 = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
//	    } else {
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
//	    }

            $fpl_json_encode = json_encode($callsign_details);
            $callsign_details = json_decode($fpl_json_encode, TRUE);

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0], 200);
            }

            if ($current_date == $date_of_flight) {
                $current_utc_time30 = date('Hi', strtotime("+30 minutes", strtotime($current_utc_time)));
                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
                    return response()->json(['STATUS_DESC' => 'Min. 30 minutes from present time only accepted.', 'STATUS_CODE' => 0], 201);
                }
            }

            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);
            $departure_time_hours2 = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes2 = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours2 = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes2 = ($result_dof) ? $result_dof->total_flying_minutes : '';

            if ($result_dof) {
//		$res_time1 = date('Hi', strtotime($callsign_details['departure_time_hours'] . $callsign_details['departure_time_minutes']));
                //		$res_time2 = date('Hi', strtotime($callsign_details['total_flying_hours'] . $callsign_details['total_flying_minutes']));
                //
				//		$secs = strtotime($res_time2) - strtotime("00:00");
                //		$total_time_after_flying = date('H:i', strtotime($res_time1) + $secs);
                //
				//		if ($departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                //		    return response()->json(['STATUS_DESC' => 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_time_after_flying, 'STATUS_CODE' => 0], 201);
                //		}

                $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours2 . ":" . $departure_time_minutes2));
                $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours2 . ":" . $total_flying_minutes2));
                $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
                $total_time_after_flying = gmdate('ymdHi', strtotime($res_time1) + $secs);

                if ($date_of_flight . $departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                    $total_time_after_flying = gmdate('y-m-d H:i', strtotime($res_time1) + $secs);
                    $total_flying_time_format1 = gmdate('H:i', strtotime($res_time1) + $secs);
                    $total_flying_time_format2 = gmdate('jS M', strtotime($res_time1) + $secs);
                    return response()->json(['STATUS_DESC' => 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_flying_time_format1 . ' on ' . $total_flying_time_format2, 'STATUS_CODE' => 3], 201);
                }
            }

            if (!$customer_details) {
                return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 200);
            }
            if (!$callsign_details) {
                return response()->json(['STATUS_DESC' => 'Aircraft Callsign does not exist', 'STATUS_CODE' => 1], 200);
            }
            if (!$fpl_details) {
                $callsign_details['departure_aerodrome'] = $departure_aerodrome;
                $callsign_details['destination_aerodrome'] = $destination_aerodrome;
                $callsign_details['date_of_flight'] = $date_of_flight;
                $callsign_details['departure_station'] = $departure_station;
                $callsign_details['departure_latlong'] = $departure_latlong;
                $callsign_details['destination_station'] = $destination_station;
                $callsign_details['destination_latlong'] = $destination_latlong;
                $callsign_details['departure_time_hours'] = $departure_time_hours;
                $callsign_details['departure_time_minutes'] = $departure_time_minutes;
                return response()->json(['STATUS_DESC' => 'Plan does not exist', 'STATUS_CODE' => 2, 'redirect_to' => 'EDIT PAGE', 'DATA' => $callsign_details], 200);
            }

            $customer_id = $customer_details->customer_id;
            $flight_rules = ($callsign_details2) ? $callsign_details2->flight_rules : '';
            $flight_type = ($callsign_details2) ? $callsign_details2->flight_type : '';
            $aircraft_type = ($callsign_details2) ? $callsign_details2->aircraft_type : '';
            $weight_category = ($callsign_details2) ? $callsign_details2->weight_category : '';
            $equipment = ($callsign_details2) ? $callsign_details2->equipment : '';
            $transponder = ($callsign_details2) ? $callsign_details2->transponder : '';
            $crushing_speed_indication = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
            $crushing_speed = ($fpl_details) ? $fpl_details->crushing_speed : '';
            $flight_level_indication = ($fpl_details) ? $fpl_details->flight_level_indication : '';
            $flight_level = ($fpl_details) ? $fpl_details->flight_level : '';
            $route = ($fpl_details) ? $fpl_details->route : '';
            $total_flying_hours = ($fpl_details) ? $fpl_details->total_flying_hours : '';
            $total_flying_minutes = ($fpl_details) ? $fpl_details->total_flying_minutes : '';
            $first_alternate_aerodrome = ($fpl_details) ? $fpl_details->first_alternate_aerodrome : '';
            $second_alternate_aerodrome = ($fpl_details) ? $fpl_details->second_alternate_aerodrome : '';
            $alternate_station = ($fpl_details) ? $fpl_details->alternate_station : '';
            $registration = ($callsign_details2) ? $callsign_details2->registration : '';
            $endurance_hours = ($fpl_details) ? $fpl_details->endurance_hours : '';
            $endurance_minutes = ($fpl_details) ? $fpl_details->endurance_minutes : '';
            $indian = ($fpl_details) ? $fpl_details->indian : '';
            $foreigner = ($fpl_details) ? $fpl_details->foreigner : '';
            $foreigner_nationality = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
            $operator = ($callsign_details2) ? $callsign_details2->operator : '';
            $sel = ($callsign_details2) ? $callsign_details2->sel : '';
            $fir_crossing_time = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
            $pbn = ($callsign_details2) ? $callsign_details2->pbn : '';
            $nav = ($callsign_details2) ? $callsign_details2->nav : '';
            $code = ($callsign_details2) ? $callsign_details2->code : '';
            $per = ($callsign_details2) ? $callsign_details2->per : '';
            $take_off_altn = ($fpl_details) ? $fpl_details->take_off_altn : '';
            $route_altn = ($fpl_details) ? $fpl_details->route_altn : '';
            $tcas = ($callsign_details2) ? $callsign_details2->tcas : '';
            $credit = ($callsign_details2) ? $callsign_details2->credit : '';
            $no_credit = ($callsign_details2) ? $callsign_details2->no_credit : '';
            $remarks = ($fpl_details) ? $fpl_details->remarks : '';
            $emergency_uhf = ($callsign_details2) ? $callsign_details2->emergency_uhf : '';
            $emergency_vhf = ($callsign_details2) ? $callsign_details2->emergency_vhf : '';
            $emergency_elba = ($callsign_details2) ? $callsign_details2->emergency_elba : '';
            $polar = ($callsign_details2) ? $callsign_details2->polar : '';
            $desert = ($callsign_details2) ? $callsign_details2->desert : '';
            $maritime = ($callsign_details2) ? $callsign_details2->maritime : '';
            $jungle = ($callsign_details2) ? $callsign_details2->jungle : '';
            $light = ($callsign_details2) ? $callsign_details2->light : '';
            $floures = ($callsign_details2) ? $callsign_details2->floures : '';
            $jacket_uhf = ($callsign_details2) ? $callsign_details2->jacket_uhf : '';
            $jacket_vhf = ($callsign_details2) ? $callsign_details2->jacket_vhf : '';
            $number = ($callsign_details2) ? $callsign_details2->number : '';
            $capacity = ($callsign_details2) ? $callsign_details2->capacity : '';
            $cover = ($callsign_details2) ? $callsign_details2->cover : '';
            $color = ($callsign_details2) ? $callsign_details2->color : '';
            $aircraft_color = ($callsign_details2) ? $callsign_details2->aircraft_color : '';

            $pilot_in_command = ($fpl_details) ? $fpl_details->pilot_in_command : '';
            $mobile_number = ($fpl_details) ? $fpl_details->mobile_number : '';
            $copilot = ($fpl_details) ? $fpl_details->copilot : '';
            $cabincrew = ($fpl_details) ? $fpl_details->cabincrew : '';

            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');

            include_once 'data_of_plans.php';

            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
//	    $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $entered_destination_time = $total_flying_hours . '' . $total_flying_minutes;
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;

            $is_watch_hour_valid = myFunction::get_watch_hours($data);

            $data['is_watch_hour_valid'] = $is_watch_hour_valid;
            $data['entered_departure_time'] = $departure_aerodrome . $entered_departure_time;
            $data['entered_destination_time'] = $destination_aerodrome . $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;
            $data['is_process'] = 1;
//            exit;
            return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1',
                        'ATC_FPL_VIEW' => $fpl_info, 'SUPPLEMANTARY_INFO' => $supplementary_info,
                        'IS_WATCH_HOUR_VALID' => $is_watch_hour_valid, 'DATA' => $data], 200);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller process_quick_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller process_quick_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {POST} /api/fpl/edit_process  edit_process
     * @apiName edit_process
     * @apiGroup FPL API's
     *
     * @apiParam {String} aircraft_callsign aircraft_callsign
     * @apiParam {String} departure_aerodrome departure_aerodrome
     * @apiParam {String} destination_aerodrome destination_aerodrome
     * @apiParam {String} departure_time_hours departure_time_hours
     * @apiParam {String} departure_time_minutes departure_time_minutes
     * @apiParam {String} pilot_in_command pilot_in_command
     * @apiParam {Number} mobile_number mobile_number
     * @apiParam {String} copilot copilot
     * @apiParam {String} cabincrew cabincrew
     * @apiParam {String} date_of_flight date_of_flight
     * @apiParam {String} email email
     * @apiParam {String} departure_station departure_station
     * @apiParam {String} departure_latlong departure_latlong
     * @apiParam {String} destination_station destination_station
     * @apiParam {String} destination_latlong destination_latlong
      @apiParam {String} alternate_station alternate_station
      @apiParam {String}  date_of_flight date_of_flight
      @apiParam {String} endurance_hours endurance_hours
      @apiParam {String} endurance_minutes endurance_minutes
      @apiParam {String} indian indian
      @apiParam {String} foreigner_nationality foreigner_nationality
      @apiParam {String} pilot_in_command pilot_in_command
      @apiParam {String} mobile_number mobile_number
      @apiParam {String} copilot copilot
      @apiParam {String} cabincrew cabincrew
      @apiParam {String} fir_crossing_time fir_crossing_time
      @apiParam {String} take_off_altn take_off_altn
      @apiParam {String} route_altn route_altn
      @apiParam {String} remarks remarks
      @apiParam {String} route route
      @apiParam {String} transponder transponder
      @apiParam {String} equipment equipment

     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {Number} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "ATC_FPL_VIEW": "(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style="color:#f1292b">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style="color:#f1292b">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)"
      "SUPPLEMANTARY_INFO": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "IS_WATCH_HOUR_VALID": 0
      "DATA": {
      "customer_id": null
      "aircraft_callsign": "TESTA4"
      "flight_rules": "V"
      "flight_type": "G"
      "aircraft_type": "GFHF"
      "weight_category": "N"
      "equipment": "XCXXC"
      "transponder": "A"
      "departure_aerodrome": "VOMM"
      "departure_time_hours": "07"
      "departure_time_minutes": "45"
      "crushing_speed_indication": "K"
      "crushing_speed": "4444"
      "flight_level_indication": "F"
      "flight_level": "455"
      "route": "TEST ROUTE"
      "destination_aerodrome": "VOPC"
      "total_flying_hours": "03"
      "total_flying_minutes": "04"
      "first_alternate_aerodrome": "VOPG"
      "second_alternate_aerodrome": "VGGG"
      "departure_station": ""
      "departure_latlong": ""
      "destination_station": ""
      "destination_latlong": ""
      "alternate_station": ""
      "date_of_flight": "160414"
      "registration": "HGEGE"
      "endurance_hours": "00"
      "endurance_minutes": "09"
      "indian": "YES"
      "foreigner": ""
      "foreigner_nationality": ""
      "pilot_in_command": "ANAND"
      "mobile_number": "9889898989"
      "copilot": "TEST"
      "cabincrew": "TESTING"
      "operator": "ANAND"
      "sel": "NONE"
      "fir_crossing_time": ""
      "pbn": "PBNTEST"
      "nav": "NAVTEST"
      "code": "ABCDEF"
      "per": "C"
      "take_off_altn": "FFFF"
      "route_altn": ""
      "tcas": ""
      "credit": ""
      "no_credit": ""
      "remarks": "TEST REMARKS"
      "remarks1": ""
      "emergency_uhf": "YES"
      "emergency_vhf": "YES"
      "emergency_elba": "YES"
      "polar": "YES"
      "desert": "YES"
      "maritime": "YES"
      "jungle": "YES"
      "light": "YES"
      "floures": "YES"
      "jacket_uhf": "YES"
      "jacket_vhf": "YES"
      "number": "33"
      "capacity": "444"
      "cover": "YES"
      "color": "YELLOW"
      "aircraft_color": "BLUE"
      "fic": ""
      "adc": ""
      "india_time": "11:50:10"
      "plan_status": 1
      "filed_date": "<span style='color:#f00;'>02-Apr-2016</span>"
      "tbn": "TBN"
      "date": ""
      "signature": ""
      "remarks_value": ""
      "filing_time": "2016-04-02 11:50:10"
      "station_addresses_data": "<span>VOMMZTZX&nbsp;</span><span>VOMMZPZX&nbsp;</span><span>VOPCZTZX&nbsp;</span><span>VOMFZQZX&nbsp;</span><span></span><span></span><span></span>"
      "originator": "KINDXAAI"
      "is_watch_hour_valid": 0
      "entered_departure_time": "<span style="color:#f1292b">VOMM0745</span>"
      "entered_destination_time": "<span style="color:#f1292b">VOPC0304</span>"
      "fpl_info": "(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style="color:#f1292b">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style="color:#f1292b">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)"
      "supplementary_info": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "is_active": 1
      "filed_by": "<span style=color:#404040;>Anand</span>"
      "filed_time": "<span style='color:#f00;'>11:50:10 IST</span>"
      "filed_via": "<span style='margin-left:10px;color:#404040;'></span>Filed Via: privateflight.in"
      "subject_type": "fpl"
      "subject": "FPL TESTA4 VOMM 0745 - VOPC // 14-Apr-2016"
      }-
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function edit_process(EditPlanRequest $request) {
        try {
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
            $route = $request->route;
            $route1 = '';
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
            $equipment = $request->equipment;
            $transponder = $request->transponder;
            $remarks1 = '';
            $data = $request->all();

            $email = $request->email;
            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');

            $customer_details = User::where('email', $email)->where('is_active', '1')->first();

//	    if ($function == 'edit_page') {
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
//	    } else {
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
//	    }

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0], 401);
            }

            if ($current_date == $date_of_flight) {
                $current_utc_time30 = date('Hi', strtotime("+30 minutes", strtotime($current_utc_time)));
                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
                    return response()->json(['STATUS_DESC' => 'Min. 30 minutes from present time only accepted.', 'STATUS_CODE' => 0], 201);
                }
            }

            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);
            $departure_time_hours2 = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes2 = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours2 = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes2 = ($result_dof) ? $result_dof->total_flying_minutes : '';

            if ($result_dof) {
                $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours2 . ":" . $departure_time_minutes2));
                $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours2 . ":" . $total_flying_minutes2));
                $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
                $total_time_after_flying = gmdate('ymdHi', strtotime($res_time1) + $secs);

                if ($date_of_flight . $departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                    $total_time_after_flying = gmdate('y-m-d H:i', strtotime($res_time1) + $secs);
                    $total_flying_time_format1 = gmdate('H:i', strtotime($res_time1) + $secs);
                    $total_flying_time_format2 = gmdate('jS M', strtotime($res_time1) + $secs);
                    return response()->json(['STATUS_DESC' => 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_flying_time_format1 . ' on ' . $total_flying_time_format2, 'STATUS_CODE' => 3], 201);
                }
            }

            if (!$customer_details) {
                return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 401);
            }
            if (!$callsign_details) {
                return response()->json(['STATUS_DESC' => 'Aircraft Callsign does not exist', 'STATUS_CODE' => 0], 401);
            }
//	    if (!$fpl_details) {
            //		return response()->json(['STATUS_DESC' => 'Plan does not exist', 'STATUS_CODE' => 0], 401);
            //	    }
            //  $fpl_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $flight_rules = ($callsign_details) ? $callsign_details->flight_rules : '';
            $flight_type = ($callsign_details) ? $callsign_details->flight_type : '';
            $aircraft_type = ($callsign_details) ? $callsign_details->aircraft_type : '';
            $weight_category = ($callsign_details) ? $callsign_details->weight_category : '';

            $alternate_station = ($fpl_details) ? $fpl_details->alternate_station : '';
            $registration = ($callsign_details) ? $callsign_details->registration : '';
            $operator = ($callsign_details) ? $callsign_details->operator : '';
            $sel = ($callsign_details) ? $callsign_details->sel : '';
            $pbn = ($callsign_details) ? $callsign_details->pbn : '';
            $nav = ($callsign_details) ? $callsign_details->nav : '';
            $code = ($callsign_details) ? $callsign_details->code : '';
            $per = ($callsign_details) ? $callsign_details->per : '';
            $route_altn = ($fpl_details) ? $fpl_details->route_altn : '';
            $tcas = ($callsign_details) ? $callsign_details->tcas : '';
            $credit = ($callsign_details) ? $callsign_details->credit : '';
            $no_credit = ($callsign_details) ? $callsign_details->no_credit : '';
            $emergency_uhf = ($callsign_details) ? $callsign_details->emergency_uhf : '';
            $emergency_vhf = ($callsign_details) ? $callsign_details->emergency_vhf : '';
            $emergency_elba = ($callsign_details) ? $callsign_details->emergency_elba : '';
            $polar = ($callsign_details) ? $callsign_details->polar : '';
            $desert = ($callsign_details) ? $callsign_details->desert : '';
            $maritime = ($callsign_details) ? $callsign_details->maritime : '';
            $jungle = ($callsign_details) ? $callsign_details->jungle : '';
            $light = ($callsign_details) ? $callsign_details->light : '';
            $floures = ($callsign_details) ? $callsign_details->floures : '';
            $jacket_uhf = ($callsign_details) ? $callsign_details->jacket_uhf : '';
            $jacket_vhf = ($callsign_details) ? $callsign_details->jacket_vhf : '';
            $number = ($callsign_details) ? $callsign_details->number : '';
            $capacity = ($callsign_details) ? $callsign_details->capacity : '';
            $cover = ($callsign_details) ? $callsign_details->cover : '';
            $color = ($callsign_details) ? $callsign_details->color : '';
            $aircraft_color = ($callsign_details) ? $callsign_details->aircraft_color : '';
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');

            include_once 'data_of_plans.php';

            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
//	    $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $entered_destination_time = $total_flying_hours . '' . $total_flying_minutes;
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;

            $is_watch_hour_valid = myFunction::get_watch_hours($data);

            $data['is_watch_hour_valid'] = $is_watch_hour_valid;

            $data['entered_departure_time'] = $departure_aerodrome . $entered_departure_time;
            $data['entered_destination_time'] = $destination_aerodrome . $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1',
                        'ATC_FPL_VIEW' => $fpl_info, 'SUPPLEMANTARY_INFO' => $supplementary_info,
                        'IS_WATCH_HOUR_VALID' => $is_watch_hour_valid, 'DATA' => $data], 200);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller edit_process: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller edit_process: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function new_plan(FullPlanRequest $request) {
        try {
            $inputs = $request->all();
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
            $date_of_flight = $request->date_of_flight;
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

            $email = $request->email;
            $user_mobile = $request->user_mobile;
            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');
            $data = $request->all();

            // print_r($data);exit;

            $customer_details = User::where('email', $email)->where('is_active', '1')->first();

//	    if ($function == 'edit_page') {
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
//	    } else {
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
//	    }

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0], 401);
            }

            if (!$customer_details) {
                return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 401);
            }

            include_once 'data_of_plans.php';

            if ($request->is_myaccount) {
                $data['is_id'] = $request->is_id;
                $data['email'] = $email;
                $data['user_mobile'] = $user_mobile;

                $flight_rule_change = myFunction::Fpl_change2($data);

//                $speed_change = myFunction::speed_change2($data);
//                $equipments_change = myFunction::equipments_change2($data);
//                $flying_time_change = myFunction::flying_time_change2($data);
//                $other_changes = myFunction::other_changes2($data);

                $data_change = [];
                $data_change['equipment'] = (array_key_exists('equipment', $data)) ? $data['equipment'] : '';
                $data_change['transponder'] = (array_key_exists('transponder', $data)) ? ($data['transponder'] != "Transponder Mode") ? $data['transponder'] : "" : '';
                $data_change['nav'] = (array_key_exists('nav', $data)) ? $data['nav'] : '';
                $data_change['sel'] = (array_key_exists('sel', $data)) ? $data['sel'] : '';
                $data_change['code'] = (array_key_exists('code', $data)) ? $data['code'] : '';
                $data_change['per'] = (array_key_exists('per', $data)) ? $data['per'] : '';
                $data_change['credit'] = (array_key_exists('credit', $data)) ? $data['credit'] : '';
                $data_change['tcas'] = (array_key_exists('tcas', $data)) ? $data['tcas'] : '';

                $data_change['operator'] = (array_key_exists('operator', $data)) ? $data['operator'] : '';

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
                unset($data['user_mobile']);
                unset($data['operator']);
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
                $update_aircraft_callsign_data = FlightPlanDetailsModel::
                        where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign_without_num . '%')
                        ->update($data_change);
                $customer_details = User::where('email', $email)->where('is_active', '1')->first();
                $user_id = ($customer_details) ? $customer_details->id : 0;
                if ($request->is_id) {
                    //Notifiacations And FPL stats
                    $notification_data = ['user_id' => $user_id, 'action' => 5, 'unique_id' => $request->is_id,
                        'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Changed successfully',
                        'is_active' => 1];

                    WebNotificationsModel::create($notification_data);

                    $changed_time = gmdate('Y-m-d H:i:s');
                    $fpl_stats_data = ['changed_by' => $user_id, 'changed_time' => $changed_time];

                    FPLStatsModel::where('fpl_id', $request->is_id)->update($fpl_stats_data);
                }

                if ($flight_rule_change) {
                    return response()->json(['success' => $aircraft_callsign . ' FLIGHT PLAN DETAILS CHANGED SUCCESSFULLY'
                                , 'id' => $request->is_id, 'STATUS_DESC' => 'Success', 'STATUS_CODE' => 1]);
                } else {
                    return response()->json(['success' => '']);
                }
            }

            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
//	    $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $entered_destination_time = $total_flying_hours . '' . $total_flying_minutes;
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;
            $is_watch_hour_valid = myFunction::get_watch_hours($data);
            $data['is_watch_hour_valid'] = $is_watch_hour_valid;

            $data['entered_departure_time'] = $departure_aerodrome . $entered_departure_time;
            $data['entered_destination_time'] = $destination_aerodrome . $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;

            $subject = "FPL " . $aircraft_callsign . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes
                    . "-" . $destination_aerodrome . " // " . date('d-M-Y', strtotime($date_of_flight));
            $data['subject'] = $subject;
            return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1',
                        'ATC_FPL_VIEW' => $fpl_info, 'SUPPLEMANTARY_INFO' => $supplementary_info,
                        'IS_WATCH_HOUR_VALID' => $is_watch_hour_valid, 'DATA' => $data], 200);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller api new_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller api new_plan: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {POST} /api/fpl/file_the_process  file_the_process
     * @apiName file_the_process
     * @apiGroup FPL API's
     *
     * @apiParam {String} aircraft_callsign aircraft_callsign
     * @apiParam {String} departure_aerodrome departure_aerodrome
     * @apiParam {String} destination_aerodrome destination_aerodrome
     * @apiParam {String} departure_time_hours departure_time_hours
     * @apiParam {String} departure_time_minutes departure_time_minutes
     * @apiParam {String} pilot_in_command pilot_in_command
     * @apiParam {Number} mobile_number mobile_number
     * @apiParam {String} copilot copilot
     * @apiParam {String} cabincrew cabincrew
     * @apiParam {String} date_of_flight date_of_flight
     * @apiParam {String} email email
     * @apiParam {String} departure_station departure_station
     * @apiParam {String} departure_latlong departure_latlong
     * @apiParam {String} destination_station destination_station
     * @apiParam {String} destination_latlong destination_latlong
      @apiParam {String} alternate_station alternate_station
      @apiParam {String}  date_of_flight date_of_flight
      @apiParam {String} registration registration
      @apiParam {String} endurance_hours endurance_hours
      @apiParam {String} endurance_minutes endurance_minutes
      @apiParam {String} indian indian
      @apiParam {String} foreigner foreigner
      @apiParam {String} foreigner_nationality foreigner_nationality
      @apiParam {String} pilot_in_command pilot_in_command
      @apiParam {String} mobile_number mobile_number
      @apiParam {String} copilot copilot
      @apiParam {String} cabincrew cabincrew
      @apiParam {String} operator operator
      @apiParam {String} sel sel
      @apiParam {String} fir_crossing_time fir_crossing_time
      @apiParam {String} pbn pbn
      @apiParam {String} nav nav
      @apiParam {String} code code
      @apiParam {String} per per
      @apiParam {String} take_off_altn take_off_altn
      @apiParam {String} route_altn route_altn
      @apiParam {String} tcas tcas
      @apiParam {String} credit credit
      @apiParam {String} no_credit no_credit
      @apiParam {String} remarks remarks
      @apiParam {String} emergency_uhf emergency_uhf
      @apiParam {String} emergency_vhf emergency_vhf
      @apiParam {String} emergency_elba emergency_elba
      @apiParam {String} polar polar
      @apiParam {String} desert desert
      @apiParam {String} maritime maritime
      @apiParam {String} jungle jungle
      @apiParam {String} light light
      @apiParam {String} floures floures
      @apiParam {String} jacket_uhf jacket_uhf
      @apiParam {String} jacket_vhf jacket_vhf
      @apiParam {String} number number
      @apiParam {String} capacity capacity
      @apiParam {String} cover cover
      @apiParam {String} color color
      @apiParam {String} aircraft_color aircraft_color
      @apiParam {String} tbn": "TBN"
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {Number} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "ATC_FPL_VIEW": "(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style="color:#f1292b">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style="color:#f1292b">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)"
      "SUPPLEMANTARY_INFO": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "IS_WATCH_HOUR_VALID": 0
      "DATA": {
      "customer_id": null
      "aircraft_callsign": "TESTA4"
      "flight_rules": "V"
      "flight_type": "G"
      "aircraft_type": "GFHF"
      "weight_category": "N"
      "equipment": "XCXXC"
      "transponder": "A"
      "departure_aerodrome": "VOMM"
      "departure_time_hours": "07"
      "departure_time_minutes": "45"
      "crushing_speed_indication": "K"
      "crushing_speed": "4444"
      "flight_level_indication": "F"
      "flight_level": "455"
      "route": "TEST ROUTE"
      "destination_aerodrome": "VOPC"
      "total_flying_hours": "03"
      "total_flying_minutes": "04"
      "first_alternate_aerodrome": "VOPG"
      "second_alternate_aerodrome": "VGGG"
      "departure_station": ""
      "departure_latlong": ""
      "destination_station": ""
      "destination_latlong": ""
      "alternate_station": ""
      "date_of_flight": "160414"
      "registration": "HGEGE"
      "endurance_hours": "00"
      "endurance_minutes": "09"
      "indian": "YES"
      "foreigner": ""
      "foreigner_nationality": ""
      "pilot_in_command": "ANAND"
      "mobile_number": "9889898989"
      "copilot": "TEST"
      "cabincrew": "TESTING"
      "operator": "ANAND"
      "sel": "NONE"
      "fir_crossing_time": ""
      "pbn": "PBNTEST"
      "nav": "NAVTEST"
      "code": "ABCDEF"
      "per": "C"
      "take_off_altn": "FFFF"
      "route_altn": ""
      "tcas": ""
      "credit": ""
      "no_credit": ""
      "remarks": "TEST REMARKS"
      "remarks1": ""
      "emergency_uhf": "YES"
      "emergency_vhf": "YES"
      "emergency_elba": "YES"
      "polar": "YES"
      "desert": "YES"
      "maritime": "YES"
      "jungle": "YES"
      "light": "YES"
      "floures": "YES"
      "jacket_uhf": "YES"
      "jacket_vhf": "YES"
      "number": "33"
      "capacity": "444"
      "cover": "YES"
      "color": "YELLOW"
      "aircraft_color": "BLUE"
      "fic": ""
      "adc": ""
      "india_time": "11:50:10"
      "plan_status": 1
      "filed_date": "<span style='color:#f00;'>02-Apr-2016</span>"
      "tbn": "TBN"
      "date": ""
      "signature": ""
      "remarks_value": ""
      "filing_time": "2016-04-02 11:50:10"
      "station_addresses_data": "<span>VOMMZTZX&nbsp;</span><span>VOMMZPZX&nbsp;</span><span>VOPCZTZX&nbsp;</span><span>VOMFZQZX&nbsp;</span><span></span><span></span><span></span>"
      "originator": "KINDXAAI"
      "is_watch_hour_valid": 0
      "entered_departure_time": "<span style="color:#f1292b">VOMM0745</span>"
      "entered_destination_time": "<span style="color:#f1292b">VOPC0304</span>"
      "fpl_info": "(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style="color:#f1292b">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style="color:#f1292b">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)"
      "supplementary_info": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "is_active": 1
      "filed_by": "<span style=color:#404040;>Anand</span>"
      "filed_time": "<span style='color:#f00;'>11:50:10 IST</span>"
      "filed_via": "<span style='margin-left:10px;color:#404040;'></span>Filed Via: privateflight.in"
      "subject_type": "fpl"
      "subject": "FPL TESTA4 VOMM 0745 - VOPC // 14-Apr-2016"
      }-
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function file_the_process(FullPlanRequest $request) {
        try {
            $data = $request->all();
            $email = $request->email;
            $user_mobile = $request->user_mobile;
            $is_new_plan = $request->is_new_plan;
            $aircraft_callsign = strtoupper($data['aircraft_callsign']);
            $departure_aerodrome = strtoupper($data['departure_aerodrome']);
            $departure_time_hours = $data['departure_time_hours'];
            $departure_time_minutes = $data['departure_time_minutes'];
            $destination_aerodrome = strtoupper($data['destination_aerodrome']);
            $date_of_flight = date('ymd', strtotime($data['date_of_flight']));
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
            $route = $data['route'];
            $remarks = $data['remarks'];
            $endurance_hours = $data['endurance_hours'];
            $endurance_minutes = $data['endurance_minutes'];
            $indian = $data['indian'];
            $foreigner = (array_key_exists('foreigner', $data)) ? $data['foreigner'] : '';
            $foreigner_nationality = (array_key_exists('foreigner_nationality', $data)) ? $data['foreigner_nationality'] : '';
            $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
            $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
            $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
            $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');
            $next_fourth_date = date('ymd', strtotime("+4 days"));

            $customer_details = User::get_user_name($user_mobile);
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);
            $get_auto_num_details = FlightPlanDetailsModel::get_auto_num_details($data);
            $get_auto_cancel_details = FlightPlanDetailsModel::get_auto_num_details($data, '1');
            $rules = [];

            if (!$customer_details) {
                return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 401);
            }
//            if (!$callsign_details && !$is_new_plan) {
//                return response()->json(['STATUS_DESC' => 'Callsign does not exist', 'STATUS_CODE' => 0], 401);
//            }

            if ($departure_aerodrome == 'ZZZZ') {
                $rules['departure_station'] = 'required|min:2';
                $rules['departure_latlong'] = 'required|min:2';
            }
            if ($destination_aerodrome == 'ZZZZ') {
                $rules['destination_station'] = 'required|min:2';
                $rules['destination_latlong'] = 'required|min:2';
            }
//	    if ($number) {
            //		$rules['capacity'] = 'required';
            //	    }
            if ($indian == 'NO') {
                $rules['foreigner_nationality'] = 'required';
            }
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                return response()->json(['STATUS_DESC' => 'Please enter valid data', 'STATUS_CODE' => 0], 401);
            }

            if ($departure_aerodrome == 'ZZZZ') {
                if (!$departure_station && $departure_latlong) {
                    return response()->json(['STATUS_DESC' => 'Please enter departure station && departure latlong data', 'STATUS_CODE' => 0], 401);
                }
            }
            if ($destination_aerodrome == 'ZZZZ') {
                if (!$destination_station && $destination_latlong) {
                    return response()->json(['STATUS_DESC' => 'Please enter destination station && destination latlong data', 'STATUS_CODE' => 0], 401);
                }
            }
//	    if ($emergency_uhf == 'NO' && $emergency_vhf == 'NO' && $emergency_elba == 'NO') {
            //		return response()->json(['STATUS_DESC' => 'Please enter valid data', 'STATUS_CODE' => 0], 401);
            //	    }
//            if ($current_date > $date_of_flight) {
//                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0], 201);
//            }
//            if ($date_of_flight > $next_fourth_date) {
//                return response()->json(['STATUS_DESC' => 'Date of flight should not exceed next 4 days', 'STATUS_CODE' => 0], 201);
//            }
//            if ($current_date == $date_of_flight) {
//                $current_utc_time30 = date('Hi', strtotime("+30 minutes", strtotime($current_utc_time)));
//                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
//                    return response()->json(['STATUS_DESC' => 'Min. 30 minutes from present time only accepted.', 'STATUS_CODE' => 0], 201);
//                }
//            }

            $result_dof = FlightPlanDetailsModel::get_call_sign_details_by_dof($data);
            $departure_time_hours2 = ($result_dof) ? $result_dof->departure_time_hours : '';
            $departure_time_minutes2 = ($result_dof) ? $result_dof->departure_time_minutes : '';
            $total_flying_hours2 = ($result_dof) ? $result_dof->total_flying_hours : '';
            $total_flying_minutes2 = ($result_dof) ? $result_dof->total_flying_minutes : '';

            if ($result_dof) {
                $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $departure_time_hours2 . ":" . $departure_time_minutes2));
                $res_time2 = gmdate('y-m-d H:i', strtotime('20' . $date_of_flight . " " . $total_flying_hours2 . ":" . $total_flying_minutes2));
                $secs = strtotime($res_time2) - strtotime('20' . $date_of_flight . " 00:00");
                $total_time_after_flying = gmdate('ymdHi', strtotime($res_time1) + $secs);

                if ($date_of_flight . $departure_time_hours . $departure_time_minutes < $total_time_after_flying) {
                    $total_time_after_flying = gmdate('y-m-d H:i', strtotime($res_time1) + $secs);
                    $total_flying_time_format1 = gmdate('H:i', strtotime($res_time1) + $secs);
                    $total_flying_time_format2 = gmdate('jS M', strtotime($res_time1) + $secs);
                    return response()->json(['STATUS_DESC' => 'Dep Time selected is less than previous Flight Arrival Time of ' . $total_flying_time_format1 . ' on ' . $total_flying_time_format2, 'STATUS_CODE' => 3], 201);
                }
            }

            if (count($get_auto_cancel_details)) {
                $this->auto_cancel($data);
            }
            if (count($get_auto_num_details) && substr($aircraft_callsign, 0, 2) == 'VT') {
                $data['aircraft_callsign_count'] = count($get_auto_num_details);
                $aircraft_callsign = myFunction::get_auto_number($data);
            }

            $user_name = $customer_details->name;
            $user_id = $customer_details->id;

            $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';
            $flight_type = (array_key_exists('flight_type', $data)) ? $data['flight_type'] : '';
            $aircraft_type = (array_key_exists('aircraft_type', $data)) ? $data['aircraft_type'] : '';
            $weight_category = (array_key_exists('weight_category', $data)) ? $data['weight_category'] : '';
            $equipment = (array_key_exists('equipment', $data)) ? $data['equipment'] : '';
            $transponder = (array_key_exists('transponder', $data)) ? ($data['transponder'] != "Transponder Mode") ? $data['transponder'] : "" : '';
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

            if ($callsign_details) {
                $emergency_uhf = $callsign_details->emergency_uhf; //(array_key_exists('emergency_uhf', $data)) ? ($data['emergency_uhf'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $emergency_vhf = $callsign_details->emergency_vhf; //(array_key_exists('emergency_vhf', $data)) ? ($data['emergency_vhf'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $emergency_elba = $callsign_details->emergency_elba; //(array_key_exists('emergency_elba', $data)) ? ($data['emergency_elba'] == 'YES') ? 'YES' : 'NO' : 'NO';

                $polar = $callsign_details->polar; //(array_key_exists('polar', $data)) ? ($data['polar'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $desert = $callsign_details->desert; //(array_key_exists('desert', $data)) ? ($data['desert'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $maritime = $callsign_details->maritime; //(array_key_exists('maritime', $data)) ? ($data['maritime'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $jungle = $callsign_details->jungle; //(array_key_exists('jungle', $data)) ? ($data['jungle'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $light = $callsign_details->light; //(array_key_exists('light', $data)) ? ($data['light'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $floures = $callsign_details->floures; //(array_key_exists('floures', $data)) ? ($data['floures'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $jacket_uhf = $callsign_details->jacket_uhf; //(array_key_exists('jacket_uhf', $data)) ? ($data['jacket_uhf'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $jacket_vhf = $callsign_details->jacket_vhf; //(array_key_exists('jacket_vhf', $data)) ? ($data['jacket_vhf'] == 'YES') ? 'YES' : 'NO' : 'NO';

                $number = $callsign_details->number; //(array_key_exists('number', $data)) ? $data['number'] : '';
                $capacity = $callsign_details->capacity; //(array_key_exists('capacity', $data)) ? $data['capacity'] : '';

                $cover = $callsign_details->cover; //(array_key_exists('cover', $data)) ? $data['cover'] : '';
                $color = $callsign_details->color; //(array_key_exists('color', $data)) ? $data['color'] : '';
                $aircraft_color = $callsign_details->aircraft_color; //(array_key_exists('aircraft_color', $data)) ? $data['aircraft_color'] : '';
            } else {
                $emergency_uhf = (array_key_exists('emergency_uhf', $data)) ? ($data['emergency_uhf'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $emergency_vhf = (array_key_exists('emergency_vhf', $data)) ? ($data['emergency_vhf'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $emergency_elba = (array_key_exists('emergency_elba', $data)) ? ($data['emergency_elba'] == 'YES') ? 'YES' : 'NO' : 'NO';

                $polar = (array_key_exists('polar', $data)) ? ($data['polar'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $desert = (array_key_exists('desert', $data)) ? ($data['desert'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $maritime = (array_key_exists('maritime', $data)) ? ($data['maritime'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $jungle = (array_key_exists('jungle', $data)) ? ($data['jungle'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $light = (array_key_exists('light', $data)) ? ($data['light'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $floures = (array_key_exists('floures', $data)) ? ($data['floures'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $jacket_uhf = (array_key_exists('jacket_uhf', $data)) ? ($data['jacket_uhf'] == 'YES') ? 'YES' : 'NO' : 'NO';
                $jacket_vhf = (array_key_exists('jacket_vhf', $data)) ? ($data['jacket_vhf'] == 'YES') ? 'YES' : 'NO' : 'NO';

                $number = (array_key_exists('number', $data)) ? $data['number'] : '';
                $capacity = (array_key_exists('capacity', $data)) ? $data['capacity'] : '';
                $cover = (array_key_exists('cover', $data)) ? $data['cover'] : '';
                $color = (array_key_exists('color', $data)) ? $data['color'] : '';
                $aircraft_color = (array_key_exists('aircraft_color', $data)) ? $data['aircraft_color'] : '';
            }
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
            include_once 'data_of_plans.php';
            $data['tbn'] = "TBN";
            $data['date'] = $date;
            $data['signature'] = $signature;
            $data['remarks_value'] = $remarks_value;
            $data['filing_time'] = $filing_time;
            $data['station_addresses_data'] = $station_addresses_data;
            $data['originator'] = $originator;
            $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
            $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
            $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
//	    $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
            $entered_destination_time = $total_flying_hours . '' . $total_flying_minutes;
            $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
            $get_day_of_flight = date("l", strtotime($get_day_of_flight));
            $is_watch_hour_valid = 1;
            $is_watch_hour_valid = myFunction::get_watch_hours($data);
            $data['is_watch_hour_valid'] = $is_watch_hour_valid;

            if ($is_watch_hour_valid) {
                $entered_departure_time = "" . $departure_time_hours . '' . $departure_time_minutes;
            } else {
                $entered_departure_time = '<span style="color:#f1292b">' . $departure_time_hours . '' . $departure_time_minutes . '</span>';
            }
            if ($is_watch_hour_valid) {
                $entered_destination_time = $total_flying_hours . "" . $total_flying_minutes;
            } else {
                $entered_destination_time = '<span style="color:#f1292b">' . $total_flying_hours . "" . $total_flying_minutes . '</span>';
            }

            $data['entered_departure_time'] = $departure_aerodrome . $entered_departure_time;
            $data['entered_destination_time'] = $destination_aerodrome . $entered_destination_time;
            $fpl_info = myFunction::fpl_atc_info($data);
            $supplementary_info = myFunction::supplementary_info($data);
            $data['fpl_info'] = $fpl_info;
            $data['supplementary_info'] = $supplementary_info;
            $data['is_active'] = 1;
            $data['user_id'] = $customer_details->id;
            $data['is_app'] = ($request->is_app) ? 1 : 0;
            $data['via'] = '<span style="margin-left:27px;"></span>Via: <span style="color:#404040;">Mobile APP</span>';

            //check pilot exist If not insert into db
            $aircraft_callsign_2 = substr($aircraft_callsign, 0, 5);
            $is_pilot_exist = App\models\CallsignInfoModel::get_pilot_data($aircraft_callsign_2, $pilot_in_command);
            $is_copilot_exist = App\models\CallsignInfoModel::get_pilot_data($aircraft_callsign_2, $copilot);
            $is_cabin_crew_exist = App\models\CallsignInfoModel::get_pilot_data($aircraft_callsign_2, $cabincrew);

            $callsign_info_count = App\models\CallsignInfoModel::callsign_info_count($aircraft_callsign_2);


            if (!$is_pilot_exist && $callsign_info_count < 10) {
                $data_pilot_create = [
                    'name' => $pilot_in_command,
                    'mobile_number' => $mobile_number,
                    'is_pilot' => 1,
                    'is_from_fpl' => 1,
                    'is_active' => 1];
                $pilot_master_result = App\models\PilotMasterModel::where('name', $pilot_in_command)
                                ->where('mobile_number', $mobile_number)->first(['id']);
                if (!$pilot_master_result) {
                    $pilot_master_result = App\models\PilotMasterModel::create($data_pilot_create);
                }
                $data_create = ['aircraft_callsign' => $aircraft_callsign_2,
                    'designation' => 1,
                    'pilot_master_id' => ($pilot_master_result) ? $pilot_master_result->id : 1,
                    'is_active' => 1
                ];
                $callsign_info_result = App\models\CallsignInfoModel::create($data_create);
            }
            $callsign_info_count = App\models\CallsignInfoModel::callsign_info_count($aircraft_callsign_2);

            if (!$is_copilot_exist && $copilot != 'NA' && $callsign_info_count < 10) {
                $data_pilot_create = [
                    'name' => $copilot,
                    'mobile_number' => 0,
                    'is_copilot' => 1,
                    'is_from_fpl' => 1,
                    'is_active' => 1];
                $pilot_master_result = App\models\PilotMasterModel::where('name', $copilot)->first(['id']);
                if (!$pilot_master_result) {
                    $pilot_master_result = App\models\PilotMasterModel::create($data_pilot_create);
                }
                $data_create = ['aircraft_callsign' => $aircraft_callsign_2,
                    'designation' => 2,
                    'pilot_master_id' => ($pilot_master_result) ? $pilot_master_result->id : 1,
                    'is_active' => 1
                ];
                $callsign_info_result = App\models\CallsignInfoModel::create($data_create);
            }
            $callsign_info_count = App\models\CallsignInfoModel::callsign_info_count($aircraft_callsign_2);

            if (!$is_cabin_crew_exist && $cabincrew != 'NA' && $cabincrew != '' && $callsign_info_count < 10) {
                $data_pilot_create = [
                    'name' => $cabincrew,
                    'mobile_number' => 0,
                    'is_cabin_crew' => 1,
                    'is_from_fpl' => 1,
                    'is_active' => 1];
                $pilot_master_result = App\models\PilotMasterModel::where('name', $cabincrew)->first(['id']);
                if (!$pilot_master_result) {
                    $pilot_master_result = App\models\PilotMasterModel::create($data_pilot_create);
                }
                $data_create = ['aircraft_callsign' => $aircraft_callsign_2,
                    'designation' => 3,
                    'pilot_master_id' => ($pilot_master_result) ? $pilot_master_result->id : 1,
                    'is_active' => 1
                ];
                $callsign_info_result = App\models\CallsignInfoModel::create($data_create);
            }

            if ($departure_aerodrome == 'ZZZZ') {
                $station_exists = StationsModel::get_aerodrome_details($departure_aerodrome, $departure_station);
                if (!$station_exists) {
                    $station_create_data = ['aero_id' => 'ZZZZ', 'aero_name' => $departure_station, 'aero_latlong' => $departure_latlong, 'is_active' => 1];
                    $station_create = StationsModel::create($station_create_data);
                }
            }

            if ($destination_aerodrome == 'ZZZZ') {
                $station_exists = StationsModel::get_aerodrome_details($destination_aerodrome, $destination_station);
                if (!$station_exists) {
                    $station_create_data = ['aero_id' => 'ZZZZ', 'aero_name' => $destination_station, 'aero_latlong' => $destination_latlong, 'is_active' => 1];
                    $station_create = StationsModel::create($station_create_data);
                }
            }
            $environment = env('APP_ENV');
            //Insert data in DB
            $result = '';
            $result2 = '';
//            if ($environment == 'eflightproduction' || $environment == 'local') {
            $result = FlightPlanDetailsModel::create($data);
            $result_id = $result->id;
//            } else {
//                $result2 = FlightPlanDetailsModel::create($data);
//                $result_id = $result2->id;
//            }
            $navlog_details=Navlog::where('callsign',$aircraft_callsign)->where('departure',$departure_aerodrome)->where('destination',$destination_aerodrome)->where('dep_time',$departure_time_hours.$departure_time_minutes)->where('plan_status',1)->where('flight_date','20'.$date_of_flight)->first();
            if(isset($navlog_details)) {
                Navlog::find($navlog_details->id)->update(['fpl_id'=> $result->id]);
            }
            $is_ltrim = $request->is_ltrim;
            $data['fpl_id'] = $result_id;

//            if ($is_ltrim) {
                LoadtrimModel::update_fpl_id($data);
//            }

            //Notifiacations & FPL stats
            $notification_data = ['user_id' => $user_id, 'action' => 1, 'unique_id' => $result_id,
                'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Filed successfully',
                'is_active' => 1];
            WebNotificationsModel::create($notification_data);

            $filed_time = gmdate('Y-m-d H:i:s');
            $fpl_stats_data = ['fpl_id' => $result_id, 'user_id' => $user_id, 'date_of_flight' => $date_of_flight, 'filed_time' => $filed_time, 'is_active' => 1];

            FPLStatsModel::create($fpl_stats_data);


            $data['filed_by'] = "<span style=color:#404040;>" . $user_name . "</span>";
            $data['filed_date'] = "<span style='color:#f00;'>" . date('d-M-Y') . "</span>";
            date_default_timezone_set('Asia/Calcutta');
            $data['filed_time'] = "<span style='color:#f00;'>" . date('H:i:s') . "  IST" . "</span>";
            $data['filed_via'] = "<span style='margin-left:10px;color:#404040;'></span>Filed Via: " . $_SERVER['HTTP_HOST'];
            $data['station_addresses_data'] = $station_addresses_data;
            $data['subject_type'] = 'fpl';
            $subject = myFunction::get_subject($data);
            $data['subject'] = $subject;

            $mail_headers = [
                'from' => $this->from,
                'from_name' => $this->from_name,
                'subject' => $subject,
                'to' => $email,
                'cc' => myFunction::get_cc_mails($data),
                'bcc' => myFunction::get_bcc_mails(),
            ];

            $mail_data = $data;
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


            $mail_data['fileName'] = $fileName;
            $mail_data['email'] = $email;

//            if ($environment == 'eflcoin2') {
////                $pdf_path = ['pathToFile' => public_path('media/images/fpl/downloads/' . $fileName), 'AnnexureCopy' => $filePath . $AnnexureCopy,
////                    'departure_aerodrome' => $departure_aerodrome, 'merge_path' => $merge_path];
////                $mail_data['pdf_path'] = $pdf_path;
////                Log::info("FlightPlanEmailJob Queues Begins " . $environment);
////                $this->dispatch((new FlightPlanEmailJob($mail_data))->delay(20));
////                Log::info("FlightPlanEmailJob Queues Ends " . $email);
//            } else if ($environment == 'eflightproduction') {
//                $pdf_path = ['pathToFile' => public_path('media/images/fpl/downloads/' . $fileName), 'AnnexureCopy' => $filePath . $AnnexureCopy,
//                    'departure_aerodrome' => $departure_aerodrome, 'merge_path' => $merge_path];
//                $mail_data['pdf_path'] = $pdf_path;
//                Log::info("FlightPlanEmailJob Queues Begins " . $environment);
//                $this->dispatch((new FlightPlanEmailJob($mail_data))->delay(20));
//                Log::info("FlightPlanEmailJob Queues Ends " . $email);
//            } else if ($environment == 'local') {
//                $pdf_path = ['pathToFile' => public_path('media/images/fpl/downloads/' . $fileName), 'AnnexureCopy' => $filePath . $AnnexureCopy,
//                    'departure_aerodrome' => $departure_aerodrome, 'merge_path' => $merge_path];
//                $mail_data['pdf_path'] = $pdf_path;
//                Log::info("FlightPlanEmailJob Queues Begins " . $environment);
//                $this->dispatch((new FlightPlanEmailJob($mail_data))->delay(20));
//                Log::info("FlightPlanEmailJob Queues Ends " . $email);
//            } else {
            $pdf_path = ['pathToFile' => public_path('media/images/fpl/downloads/' . $fileName), 'AnnexureCopy' => $filePath . $AnnexureCopy,
                'departure_aerodrome' => $departure_aerodrome, 'merge_path' => $merge_path];
            $mail_data['pdf_path'] = $pdf_path;
            Log::info("FlightPlanEmailJob Queues Begins " . $environment);
            $this->dispatch((new FlightPlanEmailJob($mail_data))->delay(20));
            Log::info("FlightPlanEmailJob Queues Ends " . $email);
//            }
//            if ($environment == 'eflcoin2' || $environment == 'eflightproduction2') {
//                $app_host = env('APP_HOST');
//                $filePath = $app_host . '/media/images/fpl/downloads/';
//
//                $app_pdf_path = $app_host . '/media/images/fpl/downloads/' . $fileName;
//                $pdf_path = ['pathToFile' => $app_pdf_path, 'AnnexureCopy' => $filePath . $AnnexureCopy,
//                    'departure_aerodrome' => $departure_aerodrome, 'merge_path' => $merge_path];
//            }
//	    $mail = Mail::send('emails.fpl.flight_plan', $mail_data, function($message) use($mail_headers, $pdf_path, $fileName) {
            //			$message->from($mail_headers['from'], $mail_headers['from_name']);
            //			$message->subject($mail_headers['subject']);
            //			$message->to($mail_headers['to']);
            //			$message->cc($mail_headers['cc']);
            //			$message->bcc($mail_headers['bcc']);
            //			$message->attach($pdf_path['pathToFile'], array(
            //			    'as' => $fileName,
            //			    'mime' => 'application/pdf')
            //			);
            //			if ($pdf_path['departure_aerodrome'] == 'VABB') {
            //			    $message->attach($pdf_path['AnnexureCopy'], array(
            //				'as' => 'AnnexureCopy.pdf',
            //				'mime' => 'application/pdf')
            //			    );
            //			}
            //			if ($pdf_path['departure_aerodrome'] == 'TTTT') {
            //			    $message->attach($pdf_path['AnnexureCopy'], array(
            //				'as' => 'AnnexureCopy.pdf',
            //				'mime' => 'application/pdf')
            //			    );
            //			}
            //		    });
//            if ($environment == 'local' || $environment == 'eflightproduction' || $environment == 'pvtcoin') {
//                Log::info("FlightPlanEmailJob Queues Begins " . $environment);
//                $this->dispatch((new FlightPlanEmailJob($mail_data))->delay(20));
//                Log::info("FlightPlanEmailJob Queues Ends " . $email);
//            }
            //	    unlink($filePath . $AnnexureCopy);
            $result['file_name'] = $fileName;
            $result['pdf_path'] = 'media/images/fpl/downloads/' . $fileName;
            if ($result) {
                return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1',
                            'ATC_FPL_VIEW' => $fpl_info, 'SUPPLEMANTARY_INFO' => $supplementary_info,
                            'IS_WATCH_HOUR_VALID' => $is_watch_hour_valid, 'DATA' => $data, 'id' => $result_id], 200);
            } else {
                return '0';
            }
        } catch (\Exception $ex) {
            Log::error('Fpl Controller API file_the_process: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller API file_the_process: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
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
        $email = $data['email'];
        //Status update
        $update_plan_status = FlightPlanDetailsModel::where('aircraft_callsign', $aircraft_callsign)
                        ->where('departure_aerodrome', $departure_aerodrome)
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
        $data['is_app'] = 1;
        $data['via'] = '<span style="margin-left:27px;"></span>Via: <span style="color:#404040;">Mobile APP</span>';
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $email,
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

    /**
     * @api {GET} /api/fpl/get_fpl_list?email=anand.vuppu@pravahya.com&page=2  FPL List
     * @apiName FPL List
     * @apiGroup My Account API's
     *
     * @apiParam {String} email email
     * @apiParam {String} page page No
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_CODE": "1",
      "STATUS_DESC": "success",
      {
      "STATUS_CODE": 0
      "STATUS_DESC": "Success"
      "result": [1]
      0:  {
      "id": 29711
      "user_id": "26"
      "aircraft_callsign": "TESTA"
      "departure_aerodrome": "VOBG"
      "destination_aerodrome": "VOPC"
      "departure_time_hours": "16"
      "departure_time_minutes": "30"
      "date_of_flight": 160413
      "departure_station": ""
      "destination_station": ""
      "pilot_in_command": "ANAND"
      "mobile_number": 2147483647
      "copilot": "TEST"
      "cabincrew": "TESTING"
      "operator": "ANAND"
      "departure_latlong": ""
      "destination_latlong": ""
      "flight_rules": "V"
      "flight_type": "G"
      "aircraft_type": "GFHF"
      "weight_category": "N"
      "equipment": "XCXXC"
      "transponder": "A"
      "crushing_speed_indication": "K"
      "crushing_speed": "4444"
      "flight_level_indication": "F"
      "flight_level": "455"
      "route": "FCGBFDGDG "
      "total_flying_hours": "03"
      "total_flying_minutes": "04"
      "first_alternate_aerodrome": "VOPG"
      "second_alternate_aerodrome": "VGGG"
      "alternate_station": ""
      "registration": "HGEGE"
      "endurance_hours": "00"
      "endurance_minutes": "09"
      "indian": "YES"
      "foreigner": "NO"
      "foreigner_nationality": ""
      "sel": "ERTE"
      "fir_crossing_time": ""
      "pbn": ""
      "nav": ""
      "code": "DRTGDR"
      "per": "D"
      "take_off_altn": "FFFF"
      "route_altn": "DFGD"
      "tcas": "YES"
      "credit": "YES"
      "no_credit": "NO"
      "remarks": "DFGDFG "
      "emergency_uhf": "YES"
      "emergency_vhf": "YES"
      "emergency_elba": "YES"
      "polar": "YES"
      "desert": "YES"
      "maritime": "YES"
      "jungle": "YES"
      "light": "YES"
      "floures": "YES"
      "jacket_uhf": "YES"
      "jacket_vhf": "YES"
      "number": "34"
      "capacity": "454"
      "cover": "NO"
      "color": "FGSDGDSG"
      "aircraft_color": "BLUEDFGDFG"
      "fic": ""
      "adc": ""
      "india_time": "16:47:49"
      "plan_status": "1"
      "filed_date": "2016-04-13 16:47:49"
      "is_active": 1
      "created_at": "2016-04-13 16:42:11"
      "updated_at": "2016-04-13 16:47:55"
      }-
      -
      }
      -
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function get_fpl_list(Request $request) {
        try {
            $email = $request->email;
            $user_details = User::where('is_active', 1)->where('email', $email)->first();
            $page = Input::get('page');
            $current_date = date('ymd');
            $yesterday = date('ymd', strtotime("-1 day"));
            $fourth_day = date('ymd', strtotime("+4 days"));
            $current_utc_time = gmdate('Hi');
            if ($page > 1) {
                $take = 10;
                $skip = $take * ($page - 1);
            } else {
                $take = 10;
                $skip = 0;
            }
            if (!$user_details) {
                return response()->json(['STATUS_CODE' => 0, 'STATUS_DESC' => 'User does not exist']);
            } else {
                $user_id = ($user_details) ? $user_details->id : '';
                $is_admin = ($user_details) ? $user_details->is_admin : '';
                $result = FlightPlanDetailsModel::where('is_active', 1)
                        ->where(function ($query) use ($is_admin, $user_id) {
                            if (!$is_admin) {
                                $query->where('user_id', $user_id);
                            }
                        })
                        ->whereBetween('date_of_flight', [$yesterday, $fourth_day])
                        ->orderBy('date_of_flight', 'desc')
                        ->orderBy('departure_time_hours', 'desc')
                        ->orderBy('departure_time_minutes', 'desc');
                if ($skip) {
                    $result = $result->skip($skip)->take($take)->get();
                } else {
                    $result = $result->take($take)->get();
                }

                foreach ($result as $key => $fpl_list) {
                    $departure_time = $fpl_list->departure_time_hours . $fpl_list->departure_time_minutes;
                    if ($fpl_list->date_of_flight == $yesterday) {
                        $result[$key]['is_yesterday'] = 1;
                    } else {
                        $result[$key]['is_yesterday'] = 0;
                    }
                    if ($departure_time < $current_utc_time && $fpl_list->date_of_flight >= $current_date) {
                        $result[$key]['is_past'] = 1;
                    } else {
                        $result[$key]['is_past'] = 0;
                    }
                }
                return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'result' => $result], 200);
            }
        } catch (\Exception $ex) {
            Log::error('get_fpl_list' . $ex->getMessage() . $ex->getLine());
            throw new customException($ex->getMessage() . $ex->getLine());
            Bugsnag::notifyException('Fpl Controller get_fpl_list: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {POST} /api/fpl/fpl_cancel/{id}  Cancel Plan
     * @apiName Cancel Plan
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_CODE": "1",
      "STATUS_DESC": "success",
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
//    public function fpl_cancel2(Request $request) {
//        try {
//            $id = $request->id;
//            $email = $request->email;
//            $user_details = User::get_user_details($email);
//            $user_name = ($user_details) ? $user_details->name : '';
//            $user_id = ($user_details) ? $user_details->id : '';
//            $fpl_details = FlightPlanDetailsModel::find($id);
//            $fpl_json_encode = json_encode($fpl_details);
//            $data = json_decode($fpl_json_encode, TRUE);
//            $aircraft_callsign = $data['aircraft_callsign'];
//            $departure_aerodrome = $data['departure_aerodrome'];
//            $departure_time_hours = $data['departure_time_hours'];
//            $departure_time_minutes = $data['departure_time_minutes'];
//            $destination_aerodrome = $data['destination_aerodrome'];
//            $date_of_flight = $data['date_of_flight'];
//            $pilot_in_command = $data['pilot_in_command'];
//            $mobile_number = $data['mobile_number'];
//            $copilot = $data['copilot'];
//            $total_flying_hours = $data['total_flying_hours'];
//            $total_flying_minutes = $data['total_flying_minutes'];
//            $cancelled_by = $user_name;
//            $current_date = date('ymd');
//            if ($date_of_flight < $current_date) {
//                return response()->json(['STATUS_DESC' => 'Old Plans can not be able to Cancel', 'STATUS_CODE' => 0], 201);
//            }
//
//            //Status update
//            $update_plan_status = FlightPlanDetailsModel::where('departure_aerodrome', $departure_aerodrome)
//                            ->where('destination_aerodrome', $destination_aerodrome)
//                            ->where('date_of_flight', $date_of_flight)
//                            ->where('departure_time_hours', $departure_time_hours)
//                            ->where('departure_time_minutes', $departure_time_minutes)->update(['plan_status' => '2']);
//
//            //Notifiacations
//            $notification_data = ['user_id' => $user_id, 'action' => 2, 'unique_id' => $id,
//                'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Cancelled successfully',
//                'is_active' => 1];
//
//            WebNotificationsModel::create($notification_data);
//
//            $data['subject_type'] = 'cancel';
//            $subject = myFunction::get_subject($data);
//            $data['cancelled_by'] = " <span style='color:red;'> Cancelled By: $cancelled_by</span>";
//            $data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
//            date_default_timezone_set('Asia/Calcutta');
//            $data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
//            $data['cancelled_via'] = "<span style='margin-left:38px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];
//            $data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
//                    $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";
//            $data['heading_top'] = "CANCEL";
//            $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
//
//            $mail_headers = [
//                'from' => $this->from,
//                'from_name' => $this->from_name,
//                'subject' => $subject,
//                'to' => $email,
//                'cc' => myFunction::get_cc_mails($data, '1'),
//                'bcc' => myFunction::get_bcc_mails(),
//            ];
//            $data['is_app'] = 1;
//            $data['via'] = '<span style="margin-left:27px;"></span>Via: <span style="color:#404040;">Mobile APP</span>';
//            Mail::send('emails.fpl.fpl_cancel', $data, function ($message) use ($mail_headers) {
//                $message->from($mail_headers['from'], $mail_headers['from_name']);
//                $message->to($mail_headers['to']);
//                $message->subject($mail_headers['subject']);
//                $message->cc($mail_headers['cc']);
//                $message->bcc($mail_headers['bcc']);
//            });
//            return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success'], 200);
////	return back()->with('success',' Plan cancelled successfully');
//        } catch (\Exception $ex) {
//            Log::error('fpl_cancel' . $ex->getMessage() . $ex->getLine());
//            throw new customException($ex->getMessage() . $ex->getLine());
//            Bugsnag::notifyException('Fpl Controller fpl_cancel: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
//        }
//    }

    public function fpl_cancel(Request $request) {

        $email = $request->email;
        $user_mobile = $request->user_mobile;
        $user_details = User::get_user_details('', $user_mobile);
        $user_name = ($user_details) ? $user_details->name : '';
        $user_id = ($user_details) ? $user_details->id : '';

        $id = $request->id;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);

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
        $cancelled_by = $user_name;
        //Status update
        $update_plan_status = FlightPlanDetailsModel::where('aircraft_callsign', $aircraft_callsign)
                        ->where('departure_aerodrome', $departure_aerodrome)
                        ->where('destination_aerodrome', $destination_aerodrome)
                        ->where('date_of_flight', $date_of_flight)
                        ->where('departure_time_hours', $departure_time_hours)
                        ->where('departure_time_minutes', $departure_time_minutes)->update(['plan_status' => '2']);

//        $update_plan_status = FlightPlanDetailsModel::where('id', $id)->update(['plan_status' => '2']);
        //Notifiacations & FPL stats
        $notification_data = ['user_id' => $user_id, 'action' => 2, 'unique_id' => $id,
            'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Cancelled successfully',
            'is_active' => 1];
        WebNotificationsModel::create($notification_data);

        $cancelled_time = gmdate('Y-m-d H:i:s');
        $fpl_stats_data = ['cancelled_by' => $data['user_id'], 'cancelled_time' => $cancelled_time];
        FPLStatsModel::where('fpl_id', $id)->update($fpl_stats_data);

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome = $departure_station;
        }

        if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
            $destination_aerodrome = $destination_station;
        }

        $data['subject_type'] = 'cancel';
        $subject = myFunction::get_subject($data);
        $data['cancelled_by'] = " <span style='color:red;'> Cancelled By: $cancelled_by</span>";
        $data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['cancelled_via'] = "<span style='margin-left:38px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];
        $data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";
        $data['heading_top'] = "CANCEL";
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['email'] = $email;
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails([]),
            'bcc' => myFunction::get_bcc_mails()
        ];
        $environment = env('APP_ENV'); //app()->environment();
//        if ($environment == 'local' || $environment == 'eflightproduction' || $environment == 'pvtcoin') {
        $this->dispatch(new CancelEmailJob($data));
//        }

        return Response::json(['success' => $aircraft_callsign . ' Plan cancelled successfully']);
    }

    /**
     * @api {GET} /api/fpl/fpl_atc_info/{id}?email=anand.vuppu@pravahya.com  Preview of Plan
     * @apiName Preview of Plan
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_CODE": "1",
      "STATUS_DESC": "success",
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public static function fpl_atc_info(Request $request) {
        $id = $request->id;
        $email = $request->email;
        $user_details = User::where('is_active', 1)->where('email', $email)->first();
        $get_data = FlightPlanDetailsModel::where('is_active', '1')->where('id', $id)->first();
        $json_encode = json_encode($get_data);
        $data = json_decode($json_encode, TRUE);

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
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $crushing_speed_indication = $data['crushing_speed_indication'];
        $crushing_speed = $data['crushing_speed'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $flight_level_indication = $data['flight_level_indication'];
        $flight_level = $data['flight_level'];
        $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
        $second_alternate_aerodrome = $data['second_alternate_aerodrome'];
        $route = $data['route'];
        $remarks = $data['remarks'];
        $endurance_hours = $data['endurance_hours'];
        $endurance_minutes = $data['endurance_minutes'];
        $flight_rules = $data['flight_rules'];
        $flight_type = $data['flight_type'];
        $aircraft_type = $data['aircraft_type'];
        $weight_category = $data['weight_category'];
        $equipment = $data['equipment'];
        $transponder = $data['transponder'];
        $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
        $entered_destination_time = $total_flying_hours . '' . $total_flying_minutes;
        $pbn = $data['pbn'];
        $nav = $data['nav'];
        $registration = $data['registration'];
        $fir_crossing_time = $data['fir_crossing_time'];
        $code = $data['code'];
        $sel = $data['sel'];
        $operator = $data['operator'];
        $per = $data['per'];
        $alternate_station = $data['alternate_station'];
        if ($first_alternate_aerodrome == 'ZZZZ' || $second_alternate_aerodrome == 'ZZZZ') {
            $alternate_station = 'ALL OPEN SPACES AND HELIPAD ENROUTE';
        }
        $take_off_altn = $data['take_off_altn'];
        $route_altn = $data['route_altn'];
        $tcas = $data['tcas'];
        $credit = $data['credit'];
        $indian = $data['indian'];
        $foreigner = $data['foreigner'];
        $foreigner_nationality = $data['foreigner_nationality'];
        $emergency_uhf = $data['emergency_uhf'];
        $emergency_vhf = $data['emergency_vhf'];
        $emergency_elba = $data['emergency_elba'];
        $polar = $data['polar'];
        $desert = $data['desert'];
        $maritime = $data['maritime'];
        $jungle = $data['jungle'];
        $light = $data['light'];
        $floures = $data['floures'];
        $jacket_uhf = $data['jacket_uhf'];
        $jacket_vhf = $data['jacket_vhf'];
        $number = $data['number'];
        $capacity = $data['capacity'];
        $cover = $data['cover'];
        $color = $data['color'];
        $aircraft_color = $data['aircraft_color'];
        $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
        $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
        $dep_station_details = ($departure_aerodrome == "ZZZZ") ? "DEP/" . $departure_latlong . " " . $departure_station . "<br>" : '';
        $dest_station_details = ($destination_aerodrome == "ZZZZ") ? "DEST/" . $destination_latlong . " " . $destination_station . " " : "";
        $fir_crossing_time_value = ($fir_crossing_time) ? "<br>EET/" . $fir_crossing_time . " " : '';
        $code_value = ($code) ? " CODE/" . $code . "" : '';
        $sel_value = ($sel) ? " SEL/" . $sel . "" : '';
        $per_value = ($per) ? " PER/" . $per . "" : '';
        $alternate_station_value = ($alternate_station) ? " ALTN/" . $alternate_station . "" : '';
        $take_off_altn_value = ($take_off_altn) ? " TALT/" . $take_off_altn . "" : '';
        $route_altn_value = ($route_altn) ? " RALT/" . $route_altn . "" : '';
        $tcas_value = ($tcas) ? " TCAS EQUIPPED" : '';
        $credit_value = ($credit == "YES") ? " CREDIT FACILITY AVAILABLE WITH AAI" : ' NO CREDIT FACILITY';
        $indian_value = ($indian == "YES") ? " ALL INDIANS ON BOARD" : '';
        $foreigner_value = ($foreigner == "YES") ? " FOREIGNER ON BOARD " . $foreigner_nationality : '';
        $cabin_value = ($cabincrew) ? "CABIN CREW: " . $cabincrew . "<br>" : '';
        $uhf_value = ($emergency_uhf == "NO") ? "UHF, " : '';
        $vhf_value = ($emergency_vhf == "NO") ? "VHF, " : '';
        $elba_value = ($emergency_elba == "NO") ? "ELBA" : '';
        $emergency_values = "EMERGENCY RADIO: " . $uhf_value . "" . $vhf_value . "" . $elba_value;
        $emergency_values = trim($emergency_values, ' , ');
        $polar_value = ($polar == "NO") ? "POLAR, " : '';
        $desert_value = ($desert == "NO") ? "DESERT, " : '';
        $maritime_value = ($maritime == "NO") ? "MARITIME, " : '';
        $jungle_value = ($jungle == "NO") ? "JUNGLE" : '';
        $survival_equipment_values = "SURVIVAL EQUIPMENT: " . $polar_value . "" . $desert_value . "" . $maritime_value . "" . $jungle_value;
        $survival_equipment_values = trim($survival_equipment_values, ' , ');
        $jacket_uhf_value = ($jacket_uhf == "NO") ? "UHF, " : '';
        $jacket_vhf_value = ($jacket_vhf == "NO") ? "VHF, " : '';
        $light_value = ($light == "NO") ? "LIGHT," : '';
        $floures_value = ($floures == "NO") ? "FLUORES" : '';
        $jacket_values = $jacket_uhf_value . "" . $jacket_vhf_value . "" . $light_value . "" . $floures_value;
        $jacket_values = trim($jacket_values, ' , ');
        $number_val = ($number) ? "DINGHIES: " . $number : '';
        $capacity_val = ($capacity) ? "<span style='padding-left:10px'>CAPACITY:</span> " . $capacity . "<br>" : '';
        $cover_val = ($cover == "NO") ? "COVER: " . $cover : '';
        $color_val = ($color) ? "DINGHIES COLOUR: " . $color : '';
        $aircraft_color_val = ($aircraft_color) ? "AIRCRAFT COLOUR & MARKINGS: " . $aircraft_color : '';

        $fpl_info = "(FPL-" . $aircraft_callsign . "-" . $flight_rules . "" . $flight_type .
                "<br>-" . $aircraft_type . "/" . $weight_category . "-" . $equipment . "/" . $transponder .
                "<br>-" . $departure_aerodrome . $entered_departure_time .
                "<br>-" . $crushing_speed_indication . "" . $crushing_speed . $flight_level_indication . "" . $flight_level . " " . $route .
                "<br>-" . $destination_aerodrome . $entered_destination_time . " " . $first_alternate_aerodrome . " " . $second_alternate_aerodrome .
                "<br>-" . $pbn_value . "" . $nav_value . "" . $dep_station_details . "" . $dest_station_details . "DOF/" . $date_of_flight . " REG/" . $registration . "" .
                $fir_crossing_time_value . "" . $code_value . "" . $sel_value . " OPR/" . $operator . "" . $alternate_station_value . $per_value . "" .
                "" . $take_off_altn_value . "" . $route_altn_value . " <br>RMK/" . $remarks . "" . $tcas_value . "" . $credit_value . " PIC " . $pilot_in_command . "" .
                " MOB " . $mobile_number . " " . $indian_value . "" . $foreigner_value . " E" . $endurance_hours . "" . $endurance_minutes . ")";

        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'atc_info' => $fpl_info], 200);
    }

    /**
     * @api {POST} /api/fpl/revise_time/{id} Revise Departure Time
     * @apiName Revise Departure Time
     * @apiGroup My Account API's

     * @apiParam {String} email email
     * @apiParam {String} departure_time departure_time

     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_CODE": "1",
      "STATUS_DESC": "success",
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function revise_time(Request $request) {
//	print_r($request->all());exit;
        $id = $request->id;
        $email = $request->email;
        $user_details = User::where('is_active', 1)->where('email', $email)->first();
        $user_name = ($user_details) ? $user_details->name : '';

        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);

        $is_update = '';
        if ($data['departure_time_hours'] . $data['departure_time_minutes'] != $request->departure_time) {
            $is_update = 1;
        }

        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = substr($request->departure_time, 0, 2);
        $departure_time_minutes = substr($request->departure_time, 2, 2);
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $revised_by = $user_name;
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $get_zzzz_value = myFunction::get_zzzz_value($data);

        //Status update
        $update_plan_status = FlightPlanDetailsModel::where('id', $id)->update(['departure_time_hours' => $departure_time_hours, 'departure_time_minutes' => $departure_time_minutes]);

        //Notifiacations
        $notification_data = ['user_id' => $data['user_id'], 'action' => 3, 'unique_id' => $id,
            'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Revised successfully',
            'is_active' => 1];
        WebNotificationsModel::create($notification_data);

        $revised_time = gmdate('Y-m-d H:i:s');
        $fpl_stats_data = ['revised_by' => $data['user_id'], 'revised_time' => $revised_time];

        FPLStatsModel::where('fpl_id', $id)->update($fpl_stats_data);

        $subject = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome2 = $departure_station;
        }else{
            $departure_aerodrome2 =  $departure_aerodrome;
        }

        if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
            $destination_aerodrome2 = $destination_station;
        }else{
            $destination_aerodrome2 = $destination_aerodrome;
        }

        $subject = "NEW ETD " . $departure_time_hours . $departure_time_minutes . ' ' . $aircraft_callsign . ' ' . $departure_aerodrome2 . '-' . $destination_aerodrome2 . " // DOF " . $date_of_flight;
        $data['revised_by'] = "Revised By: <span style=color:#f00;>$revised_by</span>";
        $data['revised_date'] = "<span style='margin-left:27px;color:#404040;'></span>Revised Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";

        date_default_timezone_set('Asia/Calcutta');
        $data['revised_time'] = "<span style='margin-left:27px;color:#404040;'></span> Revised Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['revised_via'] = "<span style='margin-left:33px;color:#404040;'></span>Revised Via: " . $_SERVER['HTTP_HOST'];

        $data['revice_time_heading'] = "(DLA-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";

        $data['get_zzzz_value'] = $get_zzzz_value;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails([]),
            'bcc' => myFunction::get_bcc_mails()
        ];
        $data['email'] = $email;
        $data['subject'] = $subject;
        if ($is_update) {
//	    Mail::send('emails.fpl.myaccount.revice_time', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            $environment = env('APP_ENV'); //app()->environment();
//            if ($environment == 'local' || $environment == 'eflightproduction' || $environment == 'pvtcoin') {
            Log::info('Delay Email job starts');
            $this->dispatch(new DelayEmailJob($data));
            Log::info('Delay Email job ends');
//            }
        }
//	if($is_update){
        return Response::json(['success' => $aircraft_callsign . ' Departure Time Revised Successfully']);
//	}else{
        //	   return Response::json(['success' => ' Departure Time not changed!']);
        //	}
    }

    public function revise_time2(Request $request) {
        $id = $request->id;
        $email = $request->email;
        $user_details = User::where('is_active', 1)->where('email', $email)->first();
        $user_name = ($user_details) ? $user_details->name : '';
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);
        $is_update = '';
        if ($data['departure_time_hours'] . $data['departure_time_minutes'] != $request->departure_time) {
            $is_update = 1;
        }
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = substr($request->departure_time, 0, 2);
        $departure_time_minutes = substr($request->departure_time, 2, 2);
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $revised_by = $user_name;
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $get_zzzz_value = myFunction::get_zzzz_value($data);
        $current_date = date('ymd');

        $rules = ['departure_time' => 'required|min:4|max:4'];
        $request_array['departure_time'] = $request->departure_time;

        $validation = \Validator::make($request_array, $rules);

        if ($validation->fails()) {
            return response()->json(['STATUS_DESC' => 'Please enter departure time', 'STATUS_CODE' => 0], 201);
        }

        if ($date_of_flight < $current_date) {
            return response()->json(['STATUS_DESC' => 'Old Plans can not be able to Revise', 'STATUS_CODE' => 0], 201);
        }

        //Status update
        $update_plan_status = FlightPlanDetailsModel::where('id', $id)->update(['departure_time_hours' => $departure_time_hours, 'departure_time_minutes' => $departure_time_minutes]);

        //Notifiacations
        $notification_data = ['user_id' => $data['user_id'], 'action' => 3, 'unique_id' => $id,
            'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Revised successfully',
            'is_active' => 1, 'is_app' => 1];
        WebNotificationsModel::create($notification_data);

        $subject = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;

        $subject = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;
        $data['revised_by'] = "Revised By: <span style=color:#f00;>$revised_by</span>";
        $data['revised_date'] = "<span style='margin-left:27px;color:#404040;'></span>Revised Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";

        date_default_timezone_set('Asia/Calcutta');
        $data['revised_time'] = "<span style='margin-left:27px;color:#404040;'></span> Revised Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['revised_via'] = "<span style='margin-left:33px;color:#404040;'></span>Revised Via: " . $_SERVER['HTTP_HOST'];

        $data['revice_time_heading'] = "(DLA-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";

        $data['get_zzzz_value'] = $get_zzzz_value;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails($data, '1'),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        $data['is_app'] = 1;
        $data['via'] = '<span style="margin-left:27px;"></span>Via: <span style="color:#404040;">Mobile APP</span>';
        if ($is_update) {
            Mail::send('emails.fpl.myaccount.revice_time', $data, function ($message) use ($mail_headers) {
                $message->from($mail_headers['from'], $mail_headers['from_name']);
                $message->to($mail_headers['to']);
                $message->subject($mail_headers['subject']);
                $message->cc($mail_headers['cc']);
                $message->bcc($mail_headers['bcc']);
            });
        }
        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success'], 200);
    }

    /**
     * @api {GET} /api/fpl/get_dep_zzzz_name/id/29712/email/anand.vuppu@pravahya.com  get_dep_zzzz_name
     * @apiName get_dep_zzzz_name
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      {
      "STATUS_CODE": 0
      "STATUS_DESC": "success"
      "departure_station": "AHMEDABAD"
      }
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
      "STATUS_CODE": 0
      "STATUS_DESC": "Not Found"
      "departure_station": ""
      }
     *
     */
    public static function get_dep_zzzz_name(Request $request) {
        $id = $request->id;
        $email = $request->email;
        $json_encode = json_encode(FlightPlanDetailsModel::find($id));
        $data = json_decode($json_encode, TRUE);
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $result = '';
        if ($departure_aerodrome == 'ZZZZ') {
            return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'success', 'departure_station' => $departure_station], 200);
        } else {
            return response()->json(['STATUS_CODE' => 0, 'STATUS_DESC' => 'Not Found', 'departure_station' => ''], 203);
        }
    }

    /**
     * @api {GET} /api/fpl/get_dest_zzzz_name/id/29712/email/anand.vuppu@pravahya.com  get_dest_zzzz_name
     * @apiName get_dest_zzzz_name
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      {
      "STATUS_CODE": 0
      "STATUS_DESC": "success"
      "destination_station": "AHMEDABAD"
      }
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
      "STATUS_CODE": 0
      "STATUS_DESC": "Not Found"
      "destination_station": ""
      }
     *
     */
    public static function get_dest_zzzz_name(Request $request) {
        $id = $request->id;
        $email = $request->email;
        $json_encode = json_encode(FlightPlanDetailsModel::find($id));
        $data = json_decode($json_encode, TRUE);
        $destination_aerodrome = $data['destination_aerodrome'];
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $result = '';
        if ($destination_aerodrome == 'ZZZZ') {
            return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'success', 'destination_station' => $destination_station], 200);
        } else {
            return response()->json(['STATUS_CODE' => 0, 'STATUS_DESC' => 'Not Found', 'destination_station' => ''], 203);
        }
        return $result;
    }

    /**
     * @api {GET} /api/fpl/pdf_download/{id}  PDF download
     * @apiName PDF download
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "result":

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */

    /**
     * @api {GET} /api/fpl/get_airports_list  Airports List
     * @apiName Airports List
     * @apiGroup FPL API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "result":{
      "STATUS_DESC": "success",
      "STATUS_CODE": "1",
      "result": [
      {
      "aero_id": "VIAX",
      "aero_name": "ADAMPUR"
      },
      {
      "aero_id": "VEAT",
      "aero_name": "AGARTALA"
      },
      {
      "aero_id": "VOAT",
      "aero_name": "AGATTI"
      },
      {
      "aero_id": "VIAG",
      "aero_name": "AGRA"
      },
      {
      "aero_id": "VAAH",
      "aero_name": "AHMEDABAD"
      },
      {
      "aero_id": "VELP",
      "aero_name": "AIZAWL"
      },
      {
      "aero_id": "VAAK",
      "aero_name": "AKOLA"
      }]

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function get_airports_list(Request $request) {
        $result = StationsModel::get_airport_names_app();
        return response()->json(['STATUS_DESC' => 'success', 'STATUS_CODE' => '1', 'result' => $result], 200);
    }

    /**
     * @api {POST} /api/fpl/change_fpl/{id}  change_fpl
     * @apiName change_fpl
     * @apiGroup My Account API's
     *
      @apiParam {String} aircraft_callsign aircraft_callsign
      @apiParam {String} departure_aerodrome departure_aerodrome
      @apiParam {String} destination_aerodrome destination_aerodrome
      @apiParam {String} departure_time_hours departure_time_hours
      @apiParam {String} departure_time_minutes departure_time_minutes
      @apiParam {String} pilot_in_command pilot_in_command
      @apiParam {Number} mobile_number mobile_number
      @apiParam {String} copilot copilot
      @apiParam {String} cabincrew cabincrew
      @apiParam {String} date_of_flight date_of_flight
      @apiParam {String} email email
      @apiParam {String} departure_station departure_station
      @apiParam {String} departure_latlong departure_latlong
      @apiParam {String} destination_station destination_station
      @apiParam {String} destination_latlong destination_latlong
      @apiParam {String} alternate_station alternate_station
      @apiParam {String}  date_of_flight date_of_flight
      @apiParam {String} endurance_hours endurance_hours
      @apiParam {String} endurance_minutes endurance_minutes
      @apiParam {String} indian indian
      @apiParam {String} foreigner_nationality foreigner_nationality
      @apiParam {String} pilot_in_command pilot_in_command
      @apiParam {String} mobile_number mobile_number
      @apiParam {String} copilot copilot
      @apiParam {String} cabincrew cabincrew
      @apiParam {String} fir_crossing_time fir_crossing_time
      @apiParam {String} take_off_altn take_off_altn
      @apiParam {String} route_altn route_altn
      @apiParam {String} remarks remarks
      @apiParam {String} route route
      @apiParam {String} pbn pbn
      @apiParam {String} nav nav
      @apiParam {String} flight_rules flight_rules
      @apiParam {String} transponder transponder
      @apiParam {String} equipment equipment


     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {Number} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": "1"
      "ATC_FPL_VIEW": "(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style="color:#f1292b">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style="color:#f1292b">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)"
      "SUPPLEMANTARY_INFO": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "IS_WATCH_HOUR_VALID": 0
      "DATA": {
      "customer_id": null
      "aircraft_callsign": "TESTA4"
      "flight_rules": "V"
      "flight_type": "G"
      "aircraft_type": "GFHF"
      "weight_category": "N"
      "equipment": "XCXXC"
      "transponder": "A"
      "departure_aerodrome": "VOMM"
      "departure_time_hours": "07"
      "departure_time_minutes": "45"
      "crushing_speed_indication": "K"
      "crushing_speed": "4444"
      "flight_level_indication": "F"
      "flight_level": "455"
      "route": "TEST ROUTE"
      "destination_aerodrome": "VOPC"
      "total_flying_hours": "03"
      "total_flying_minutes": "04"
      "first_alternate_aerodrome": "VOPG"
      "second_alternate_aerodrome": "VGGG"
      "departure_station": ""
      "departure_latlong": ""
      "destination_station": ""
      "destination_latlong": ""
      "alternate_station": ""
      "date_of_flight": "160414"
      "registration": "HGEGE"
      "endurance_hours": "00"
      "endurance_minutes": "09"
      "indian": "YES"
      "foreigner": ""
      "foreigner_nationality": ""
      "pilot_in_command": "ANAND"
      "mobile_number": "9889898989"
      "copilot": "TEST"
      "cabincrew": "TESTING"
      "operator": "ANAND"
      "sel": "NONE"
      "fir_crossing_time": ""
      "pbn": "PBNTEST"
      "nav": "NAVTEST"
      "code": "ABCDEF"
      "per": "C"
      "take_off_altn": "FFFF"
      "route_altn": ""
      "tcas": ""
      "credit": ""
      "no_credit": ""
      "remarks": "TEST REMARKS"
      "remarks1": ""
      "emergency_uhf": "YES"
      "emergency_vhf": "YES"
      "emergency_elba": "YES"
      "polar": "YES"
      "desert": "YES"
      "maritime": "YES"
      "jungle": "YES"
      "light": "YES"
      "floures": "YES"
      "jacket_uhf": "YES"
      "jacket_vhf": "YES"
      "number": "33"
      "capacity": "444"
      "cover": "YES"
      "color": "YELLOW"
      "aircraft_color": "BLUE"
      "fic": ""
      "adc": ""
      "india_time": "11:50:10"
      "plan_status": 1
      "filed_date": "<span style='color:#f00;'>02-Apr-2016</span>"
      "tbn": "TBN"
      "date": ""
      "signature": ""
      "remarks_value": ""
      "filing_time": "2016-04-02 11:50:10"
      "station_addresses_data": "<span>VOMMZTZX&nbsp;</span><span>VOMMZPZX&nbsp;</span><span>VOPCZTZX&nbsp;</span><span>VOMFZQZX&nbsp;</span><span></span><span></span><span></span>"
      "originator": "KINDXAAI"
      "is_watch_hour_valid": 0
      "entered_departure_time": "<span style="color:#f1292b">VOMM0745</span>"
      "entered_destination_time": "<span style="color:#f1292b">VOPC0304</span>"
      "fpl_info": "(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style="color:#f1292b">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style="color:#f1292b">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)"
      "supplementary_info": "CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE"
      "is_active": 1
      "filed_by": "<span style=color:#404040;>Anand</span>"
      "filed_time": "<span style='color:#f00;'>11:50:10 IST</span>"
      "filed_via": "<span style='margin-left:10px;color:#404040;'></span>Filed Via: privateflight.in"
      "subject_type": "fpl"
      "subject": "FPL TESTA4 VOMM 0745 - VOPC // 14-Apr-2016"
      }-
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function change_fpl(EditPlanRequest $request) {
        try {
            $email = $request->email;
            $id = $request->id;
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
            $pilot_in_command = strtoupper($request->pilot_in_command);
            $mobile_number = $request->mobile_number;
            $copilot = strtoupper($request->copilot);
            $cabincrew = strtoupper($request->cabincrew);
            $crushing_speed_indication = $request->crushing_speed_indication;
            $crushing_speed = $request->crushing_speed;
            $flight_level_indication = $request->flight_level_indication;
            $flight_level = $request->flight_level;
            $total_flying_hours = $request->total_flying_hours;
            $total_flying_minutes = $request->total_flying_minutes;
            $route = strtoupper($request->route);
            $route1 = '';
            $first_alternate_aerodrome = strtoupper($request->first_alternate_aerodrome);
            $second_alternate_aerodrome = strtoupper($request->second_alternate_aerodrome);
            $take_off_altn = $request->take_off_altn;
            $indian = ($request->indian == "YES") ? "YES" : "NO";
            $foreigner = ($request->indian == "NO") ? "YES" : "NO";
            $foreigner_nationality = $request->foreigner_nationality;
            $endurance_hours = $request->endurance_hours;
            $endurance_minutes = $request->endurance_minutes;
            $fir_crossing_time = $request->fir_crossing_time;
            $remarks = strtoupper($request->remarks);
            $pbn = strtoupper($request->pbn);
            $nav = strtoupper($request->nav);
            $flight_rules = strtoupper($request->flight_rules);
            $equipment = $request->equipment;
            $transponder = $request->transponder;
            $remarks1 = '';
            $data = $request->all();
            $is_myaccount = 1;
            $current_date = gmdate('ymd');
            $current_utc_time = gmdate('Hi');

            $customer_details = User::where('email', $email)->where('is_active', '1')->first();
            $callsign_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $fpl_details = FlightPlanDetailsModel::get_flight_details($data);

            if ($date_of_flight < $current_date) {
                return response()->json(['STATUS_DESC' => 'Old Plans can not be able to Change', 'STATUS_CODE' => 0], 201);
            }

            if ($current_date > $date_of_flight) {
                return response()->json(['STATUS_DESC' => 'Date of flight should not less than current date', 'STATUS_CODE' => 0], 401);
            }
            if ($current_date == $date_of_flight) {
                $current_utc_time30 = date('Hi', strtotime("+1 minute", strtotime($current_utc_time)));
                if ($departure_time_hours . $departure_time_minutes < $current_utc_time30) {
                    return response()->json(['STATUS_DESC' => 'Min. 1 minute from present time only accepted.', 'STATUS_CODE' => 0], 201);
                }
            }
            if (!$customer_details) {
                return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 201);
            }
            if (!$callsign_details) {
                return response()->json(['STATUS_DESC' => 'Aircraft Callsign does not exist', 'STATUS_CODE' => 0], 202);
            }

//	    $fpl_details = FlightPlanDetailsModel::get_call_sign_details($aircraft_callsign);
            $flight_type = ($callsign_details) ? $callsign_details->flight_type : '';
            $aircraft_type = ($callsign_details) ? $callsign_details->aircraft_type : '';
            $weight_category = ($callsign_details) ? $callsign_details->weight_category : '';
            $alternate_station = ($fpl_details) ? $fpl_details->alternate_station : '';
            $registration = ($callsign_details) ? $callsign_details->registration : '';
            $operator = ($callsign_details) ? $callsign_details->operator : '';
            $sel = ($callsign_details) ? $callsign_details->sel : '';
            $code = ($callsign_details) ? $callsign_details->code : '';
            $per = ($callsign_details) ? $callsign_details->per : '';
            $route_altn = ($fpl_details) ? $fpl_details->route_altn : '';
            $tcas = ($callsign_details) ? $callsign_details->tcas : '';
            $credit = ($callsign_details) ? $callsign_details->credit : '';
            $no_credit = ($callsign_details) ? $callsign_details->no_credit : '';
            $emergency_uhf = ($callsign_details) ? $callsign_details->emergency_uhf : '';
            $emergency_vhf = ($callsign_details) ? $callsign_details->emergency_vhf : '';
            $emergency_elba = ($callsign_details) ? $callsign_details->emergency_elba : '';
            $polar = ($callsign_details) ? $callsign_details->polar : '';
            $desert = ($callsign_details) ? $callsign_details->desert : '';
            $maritime = ($callsign_details) ? $callsign_details->maritime : '';
            $jungle = ($callsign_details) ? $callsign_details->jungle : '';
            $light = ($callsign_details) ? $callsign_details->light : '';
            $floures = ($callsign_details) ? $callsign_details->floures : '';
            $jacket_uhf = ($callsign_details) ? $callsign_details->jacket_uhf : '';
            $jacket_vhf = ($callsign_details) ? $callsign_details->jacket_vhf : '';
            $number = ($callsign_details) ? $callsign_details->number : '';
            $capacity = ($callsign_details) ? $callsign_details->capacity : '';
            $cover = ($callsign_details) ? $callsign_details->cover : '';
            $color = ($callsign_details) ? $callsign_details->color : '';
            $aircraft_color = ($callsign_details) ? $callsign_details->aircraft_color : '';
            $fic = "";
            $adc = "";
            date_default_timezone_set('Asia/Kolkata');
            $india_time = date('H:i:s');
            $plan_status = 1;
            $filed_date = date('Y-m-d H:i:s');

            include_once 'data_of_plans.php';
            unset($data['remarks1']);
            $data['is_id'] = $id;
            $data['email'] = $email;
            $data['is_app'] = 1;
            $data['via'] = '<span style="margin-left:27px;"></span>Via: <span style="color:#404040;">Mobile APP</span>';
            myFunction::speed_change($data);
            myFunction::equipments_change($data);
            myFunction::flying_time_change($data);
            myFunction::other_changes($data);
            unset($data['is_id']);
            unset($data['email']);
            unset($data['is_app']);
            unset($data['via']);

            $update_fpl = FlightPlanDetailsModel::where('id', $id)->update($data);
            $fpl_data = FlightPlanDetailsModel::find($id);
            return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1', 'DATA' => $fpl_data], 200);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller change_fpl: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller change_fpl: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    /**
     * @api {GET} /api/fpl/get_fpl_record/{id}  get fpl record
     * @apiName Get Fpl Record
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK

      {
      "STATUS_CODE": 1
      "STATUS_DESC": "Success"
      "result": {
      "id": 29735
      "user_id": 89
      "aircraft_callsign": "TESTA"
      "departure_aerodrome": "VOBG"
      "destination_aerodrome": "VOPC"
      "departure_time_hours": "07"
      "departure_time_minutes": "45"
      "date_of_flight": "160520"
      "departure_station": null
      "destination_station": null
      "pilot_in_command": "ANAND"
      "mobile_number": 2147483647
      "copilot": "TEST"
      "cabincrew": "TESTING"
      "operator": "ANAND"
      "departure_latlong": null
      "destination_latlong": null
      "flight_rules": ""
      "flight_type": "G"
      "aircraft_type": "GFHF"
      "weight_category": "N"
      "equipment": "XCXXC"
      "transponder": "H"
      "crushing_speed_indication": "K"
      "crushing_speed": "4444"
      "flight_level_indication": "F"
      "flight_level": "455"
      "route": "FCGBFDGDG"
      "total_flying_hours": "03"
      "total_flying_minutes": "04"
      "first_alternate_aerodrome": "VOPG"
      "second_alternate_aerodrome": "VGGG"
      "alternate_station": ""
      "registration": "HGEGE"
      "endurance_hours": "00"
      "endurance_minutes": "09"
      "indian": "NO"
      "foreigner": "NO"
      "foreigner_nationality": ""
      "sel": "NONE"
      "fir_crossing_time": null
      "pbn": ""
      "nav": ""
      "code": "ABCDEF"
      "per": "C"
      "take_off_altn": "FFFF"
      "route_altn": ""
      "tcas": "NO"
      "credit": "YES"
      "no_credit": "NO"
      "remarks": "DFGDFG"
      "emergency_uhf": "YES"
      "emergency_vhf": "YES"
      "emergency_elba": "NO"
      "polar": "NO"
      "desert": "YES"
      "maritime": "YES"
      "jungle": "YES"
      "light": "NO"
      "floures": "YES"
      "jacket_uhf": "YES"
      "jacket_vhf": "YES"
      "number": "34"
      "capacity": "45"
      "cover": "YES"
      "color": "GFGFG"
      "aircraft_color": "WHITE"
      "fic": ""
      "adc": ""
      "india_time": "14:53:16"
      "plan_status": "1"
      "filed_date": "2016-05-18 14:53:16"
      "is_active": 1
      "is_delete": 0
      "is_app": 0
      "is_old_record": 0
      "updated_by": 0
      "adc_updated_by": 0
      "adc_updated_time": "0000-00-00 00:00:00"
      "created_at": "2016-04-22 16:35:04"
      "updated_at": "2016-05-18 14:53:16"
      }-
      }



     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function get_fpl_record(Request $request) {
        $id = $request->id;
        $get_fpl_record = FlightPlanDetailsModel::findorFail($id);
        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'result' => $get_fpl_record]);
    }

    /**
     * @api {GET} /api/fpl/get_count_fpl  Count of FPL
     * @apiName Count of FPL
     * @apiGroup My Account API's
     *
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     *
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK

      {
      "STATUS_CODE": 1
      "STATUS_DESC": "Success"
      "result":{"day_count":4,"month_count":33,"total_count":74}
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *
     */
    public function get_count_fpl(Request $request) {
        $day = 1;
        $month = 1;
        $total = 1;
        $get_day_count_fpl = FlightPlanDetailsModel::get_count_fpl($day);
        $get_month_count_fpl = FlightPlanDetailsModel::get_count_fpl('', $month);
        $get_total_count_fpl = FlightPlanDetailsModel::get_count_fpl();
        $day_count = count($get_day_count_fpl);
        $month_count = count($get_month_count_fpl);
        $total_count = $get_total_count_fpl;

        $data = ['day_count' => $day_count, 'month_count' => $month_count, 'total_count' => $total_count];

        return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => 1, 'result' => $data]);
    }

    public function get_adc_count(Request $request) {
        $date_of_flight = date('ymd');
        $adc = $request->adc;
        $id = $request->id;
        $fic= $request->fic;
        $from=substr($request->from,0,2);
        $dof=date('ymd',strtotime($request->dof));
        /*if ($date_of_flight && $adc) {
            $adc_data = FlightPlanDetailsModel::where('date_of_flight', $date_of_flight)->where('adc', $adc)->first(['id']);
            $adc_data_id = ($adc_data) ? $adc_data->id : '';
            if ($adc_data && ($adc_data_id == $id)) {
                return 0;
            } else if (!$adc_data) {
                return 0;
            } else {
                return 1;
            }
        }
        return 0;
        */
        if((strlen($request->from)>4)||($fic==0000))
            $fic_data=0;
        else
         $fic_data = FlightPlanDetailsModel::where('date_of_flight',$dof)->where('departure_aerodrome','like',$from.'%')
         ->where('fic',$fic)->where('plan_status',1)->where('id','!=',$id)->count(); 
        if ($date_of_flight && $adc) {
            $adc_data = FlightPlanDetailsModel::where('date_of_flight', $date_of_flight)->where('adc', $adc)->first(['id']);
            $adc_data_id = ($adc_data) ? $adc_data->id : '';
            if ($adc_data && ($adc_data_id == $id)) {
                return ['fic'=>$fic_data,'adc'=>0];
            } else if (!$adc_data) {
                return ['fic'=>$fic_data,'adc'=>0];
            } else {
                return ['fic'=>$fic_data,'adc'=>1];
            }
        }
       return ['fic'=>$fic_data,'adc'=>0];
    }

    public function change_fic_adc(Request $request) {
        $email = $request->email;
        $user_mobile = $request->user_mobile;
        $user_details = User::get_user_details('', $user_mobile);
        $user_name = ($user_details) ? $user_details->name : '';
        $user_id = ($user_details) ? $user_details->id : '';

        $id = $request->id;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);


        $aircraft_callsign = $data['aircraft_callsign'];

//        if (substr($aircraft_callsign, 0, 2) == 'VT') {
//            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
//        }

        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome = $departure_station;
        }

        if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
            $destination_aerodrome = $destination_station;
        }

        $entered_by = $user_name;
        $adc_updated_by = $user_id;
        $adc_updated_time = date('y-m-d H:i:s');

        $fic = $request->fic;
        $adc = strtoupper($request->adc);

        $is_update = '';
        if ($data['fic'] . $data['adc'] != $fic . $adc) {
            $is_update = 1;
        }
        $fic_update = ['fic' => $fic, 'adc' => $adc, 'adc_updated_by' => $adc_updated_by, 'adc_updated_time' => $adc_updated_time];
        //Update FIC and ADC
        $update_plan_status = FlightPlanDetailsModel::where('id', $id)
                ->update($fic_update);


//        $update_plan_status = FlightPlanDetailsModel::where('aircraft_callsign', $aircraft_callsign)
//                ->where(function ($query) use ($departure_station, $departure_aerodrome) {
//                    if ($departure_station && $departure_aerodrome == 'ZZZZ') {
//                        $query->where('departure_station', $departure_station);
//                    }else{
//                        $query->where('departure_aerodrome', $departure_aerodrome);
//                    }
//                })
//                ->where(function ($query) use ($destination_station, $destination_aerodrome) {
//                    if ($destination_station && $destination_aerodrome == 'ZZZZ') {
//                        $query->where('destination_station', $destination_station);
//                    }else{
//                        $query->where('destination_aerodrome', $destination_aerodrome);
//                    }
//                })        
//                ->where('date_of_flight', $date_of_flight)
//                ->where('departure_time_hours', $departure_time_hours)
//                ->where('departure_time_minutes', $departure_time_minutes)
//                ->update($fic_update);
        //Notifiacations
        $notification_data = ['user_id' => $data['user_id'], 'action' => 4, 'unique_id' => $id,
            'subject' => $aircraft_callsign . " FIC " . $fic . " & ADC " . $adc,
            'is_active' => 1];
        WebNotificationsModel::create($notification_data);

        $adc_updated_time = gmdate('Y-m-d H:i:s');
        $fpl_stats_data = ['adc_updated_by' => $user_id, 'adc_updated_time' => $adc_updated_time];
        FPLStatsModel::where('fpl_id', $id)->update($fpl_stats_data);

        $date_format = date('d-M-Y', strtotime('20' . $date_of_flight));

        $subject = $aircraft_callsign. " " . $departure_aerodrome. " " .
                $departure_time_hours. "" . $departure_time_minutes . " - " . $destination_aerodrome. " FIC " . $fic . " & ADC " . $adc    .  ' (' . $date_format . ')';

        $data['entered_by'] = "Entered  By: <span style='color:red;'>$entered_by</span>";
        $data['entered_date'] = "<span style='margin-left:27px;color:#404040;'></span>Entered  Date: <span style='color:red;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['entered_time'] = "<span style='margin-left:27px;color:#404040;'></span> Entered  Time: <span style='color:red;'>" . date('H:i') . "  IST" . "</span>";
        $data['entered_via'] = "<span style='margin-left:33px;color:#404040;'></span>Entered  Via: " . $_SERVER['HTTP_HOST'];

        $data['fic_adc_heading'] = $subject;
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails([]),
            'bcc' => myFunction::get_bcc_mails()
        ];
        $data['email'] = $email;
        $data['subject'] = $subject;

        $environment = env('APP_ENV'); //app()->environment();
//        if ($environment == 'local' || $environment == 'eflightproduction' || $environment == 'pvtcoin') {
        Log::info('FICADC Email Job Starts ' . $subject);
        $this->dispatch(new FICADCEmailJob($data));
        Log::info('FICADC Email Job Ends ' . $email);
        //SMS
        $message = "" . $aircraft_callsign . " FIC " . $fic . " ADC " . $adc . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome . ". Call +91 8861660160 for Support. HAVE A NICE FLIGHT:)";
        $user = "eflight";
        $password = "PCpl2016";

        $to = CallsignInfoModel::get_mobile_numbers($data);

        $text = urlencode($message);
        $url = "https://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=$user&password=$password&msisdn=$to&sid=EFLYTE&msg=$text&fl=0&gwid=2";
        $ret = file($url);
        $MessageData = $ret['0'];
        $abc = json_decode($MessageData)->MessageData;

        foreach ($abc as $value) {
            $mob = $value->Number;
            $MessageParts = $value->MessageParts;
            foreach ($MessageParts as $Msg_value) {
                $msg_id = $Msg_value->MsgId;
                $def = "https://cloud.smsindiahub.in/vendorsms/checkdelivery.aspx?user=$user&password=$password&messageid=$msg_id";
            }
        }
        //SMS
//        }
        return Response::json(['success' => $aircraft_callsign . ' FIC ADC Updated Successfully']);
    }

}
