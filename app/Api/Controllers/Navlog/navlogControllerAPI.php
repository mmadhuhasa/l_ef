<?php
namespace App\Api\Controllers\Navlog;
use App;
use App\Exceptions\customException;
use App\Http\Controllers\Controller;
use Bugsnag;
use Illuminate\Http\Request;
use Input;
use Log;
use Mail;
use PDF;
use Response;
use Validator;
use \App\User;
use App\models\Navlog;
use App\models\Navlogmaster;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use App\models\PilotMasterModel;
use App\models\CallsignInfoModel;
use App\models\StationsModel;
use App\myfolder\myFunction;
use App\Jobs\CancelEmailJob;
use App\Jobs\DelayEmailJob;
use App\Jobs\FICADCEmailJob;
use App\Jobs\Navlog\NavlogSpeedChangeEmailJob;
use App\Jobs\Navlog\NavlogALTChangeEmailJob;
use App\Jobs\Navlog\NavlogOtherChangeEmailJob;
class navlogControllerAPI extends Controller {
    
    public function __construct() {
        // $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        // $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
        $this->user_id =  JWTAuth::parseToken()->authenticate()->id;
        $this->user_name =  $id=JWTAuth::parseToken()->authenticate()->name;
        $this->user_email =  $id=JWTAuth::parseToken()->authenticate()->email;
        $this->is_admin =  $id=JWTAuth::parseToken()->authenticate()->is_admin;
        $this->user_callsigns =  $id=JWTAuth::parseToken()->authenticate()->user_callsigns;
    }
    public function store(Request $request){
    	/* 1. ALT1,ALT2,TAKEOFF ALT cant be same(pending)
           2. IST TIME API is PENDING
        */
        $validation = Validator::make($request->all(),[ 
                'no_of_flight' => 'required|numeric',
                'callsign' => 'required|alpha_num|min:5|max:7',
                'registration' => 'required|alpha_num|min:5|max:7',
                'departure' => 'required|alpha|min:4|max:4',
                'destination' => 'required|alpha|min:4|max:4',
                'flight_date' => 'required',
                'pax' => 'required|numeric',
                'load' => 'required|numeric|digits_between:2,4',
                'pilot'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:2|max:25',
                'co_pilot'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:2|max:25',
                'mobile'=>'required|numeric|digits_between:10,10',  
                'level1'=>'numeric|digits_between:3,3',
                'level2'=>'numeric|digits_between:3,3',
                'level3'=>'numeric|digits_between:3,3',
                'level4'=>'numeric|digits_between:3,3',
                'main_route' => 'regex:/(^[A-Za-z0-9 ]+$)+/|min:3',
                'alternate1route' => 'regex:/(^[A-Za-z0-9 ]+$)+/|min:3',
                'alternate2route' => 'regex:/(^[A-Za-z0-9 ]+$)+/|min:3',
                'take_off_alternate_route' => 'regex:/(^[A-Za-z0-9 ]+$)+/|min:3',
                'alternate1' => 'alpha|min:4|max:4',
                'alternate2' => 'alpha|min:4|max:4',
                'take_off_alternate' => 'alpha|min:4|max:4',
                'remarks' =>'regex:/(^[A-Za-z0-9 ]+$)+/|min:3|max:150',
            ]);
         if($validation->fails()){
             $errors = $validation->errors();
             return $errors->toJson();
         } 
    	$data=$request->all();
    	$callsign=$request->callsign;
    	$current_month_year=strtoupper(date('My'));
    	$navlog_count=Navlog::where('live_test_mode',1)->where('callsign',$callsign)->where('filed_date',$current_month_year)->count();
    	$navlog_count++;
    	if(strlen($navlog_count)==1)
    	  $prefix='00';
    	else if(strlen($navlog_count)==2)
    	  $prefix='0';
    	else 
    	  $prefix='';
    	$navlog_serial_no=strtoupper(substr($callsign,2)).'-'.$current_month_year.'-L'.$prefix.$navlog_count;
    	$data['navlog_no']=$navlog_serial_no;
        $data['live_test_mode']=1;
        $data['dep_time']=substr($request->dep_time,0,2).substr($request->dep_time,5,2);
        $data['user_id']=JWTAuth::parseToken()->authenticate()->id;
    	$navlog_master=NavlogMaster::create();
    	Navlog::create(array_merge($data,['navlog_masterid' =>$navlog_master->id,'filed_date'=>$current_month_year]));
    	return response()->json(['SUCCESS' => true, 'STATUS_CODE' => '200',
                        'MESSAGE' =>'DATA INSERTED SUCCESSFULLY'], 200);
    }

    public function SpeedList(Request $request)
    {
       $callsign=$request->callsign;
       $speedlist=DB::table('aircraft_speed')->where('callsign',$callsign)->first();
       if(count((array)$speedlist) > 0){
         foreach ($speedlist as $key=>$value) {
           if($key=='id'||$key=='callsign')
            continue;
            if(isset($value) && $value!="NULL")
             $data[]=$value;
         }
      }
      else
         $data=array();
       return response()->json(['SUCCESS' =>true, 'STATUS_CODE' => '200','DATA' =>$data], 200);
    }  

    public function AirportName(Request $request){
       $airport_code=$request->airport_code; 
       $airport= DB::table('airport_list')->where('airport_code',$airport_code)->first();
       if(isset($airport))
         $city=$airport->airport_city;
       else
         $city='';
       return response()->json(['SUCCESS' => true, 'STATUS_CODE' => '200','DATA' =>$city], 200);
    }

    public function NoOfPax(Request $request)
    {
       $callsign=$request->callsign;
       $paxs=DB::table('maxfuel_maxpax')->where('callsign',$callsign)->first();
       if(count((array)$paxs)>0)
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$paxs),200);
       else 
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>array('max_pax'=>14)),200);
    } 

    public function pilot_in_command(Request $request) 
    {
        try {
                $term = $request->term;
                $aircraft_callsign = $request->aircraft_callsign;
                $pilotnames = CallsignInfoModel::pilot_in_command($aircraft_callsign, $term);
                foreach ($pilotnames as $pilot_names) {
                    $results[] = $pilot_names->name;
                }
                return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$results),200);
            } 
            catch (\Exception $ex) {
                Log::error('Fpl Controller pilot_in_command: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
                throw new customException($ex->getMessage());
                Bugsnag::notifyException('Navlog Controller pilot_in_command : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            }
    } 

    public function copilot(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;

            $pilotnames = CallsignInfoModel::pilot_in_command($aircraft_callsign, $term);
            $copilot = CallsignInfoModel::copilot($aircraft_callsign, $term);
            foreach ($pilotnames as $pilot_names) {
                $pilot_results[] = $pilot_names->name;
                $pilotnames_array[] = $pilot_names->name;
            }
            foreach ($copilot as $copilot_names) {
                if (!in_array($copilot_names->name, $pilotnames_array)) {
                    $copilot_results[] = $copilot_names->name;
                }
            }
            $results = array_values(array_merge($pilot_results, $copilot_results));
            return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$results),200);
            //return Response::json($results);
           
        } catch (\Exception $ex) {
            Log::error('Fpl Controller copilot: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Navlog Controller copilot : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function LastDestination(Request $request)
    {
       $callsign=$request->callsign;
       $date_of_flight=date('Ymd');
       $result=FlightPlanDetailsModel::where('aircraft_callsign',$callsign)->where('date_of_flight','<=',$date_of_flight)->orderBy('date_of_flight', 'desc')->first();
       if(count((array)$result)>0)
          $destination=$result->destination_aerodrome;
        else
          $destination='';
      return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','destination'=>$destination),200);
    }

    public function Maxfuel(Request $request)
    {
       $callsign=$request->callsign;
       $maxfuel=DB::table('maxfuel_maxpax')->where('callsign',$callsign)->first();
       if(count((array)$maxfuel)>0)
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$maxfuel),200);
       else 
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>999999999),200);
    }  

    public function get_pilot_details(Request $request) {
        $pilot_in_command = $request->pilot_name;
        $get_pilot_details = PilotMasterModel::get_pilot_details('', $pilot_in_command);
        $mobile_number = ($get_pilot_details) ? $get_pilot_details->mobile_number : '';
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$mobile_number),200);
    }
    
    public function stations_autocomplete(Request $request) {
        try {
            $results = array();
            $term = $request->term;
            $queries = StationsModel::fetch_stations($term);
            foreach ($queries as $query) {
                $results[] = $query->aero_name;
            }
           return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$results),200);
        } catch (\Exception $ex) {
            Log::error('Navlog Controller stations_autocomplete: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Navlog Controller stations_autocomplete : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function station_latlong(Request $request) {
        try {
            $station_name = $request->station_name;
            $station_latlong = StationsModel::get_station_latlong($station_name);
            return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$station_latlong->aero_latlong),200);
        } catch (\Exception $ex) {
            Log::error('Navlog Controller station_latlong: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Navlog Controller station_latlong : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }
    public function pending_cancelled_count(Request $request){ 
       $id=JWTAuth::parseToken()->authenticate()->id;
       $pending=Navlog::where('flight_date',date('Ymd'))->where('plan_status',1)->where('live_test_mode',1)->where('user_id',$id)->count();
        $cancelled=Navlog::where('flight_date',date('Ymd'))->where('plan_status',2)->where('live_test_mode',1)->where('user_id',$id)->count();
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','pending'=>$pending,'cancelled'=>$cancelled),200);
    }
    public function PendingNavlog(Request $request){ 
       $user_id=JWTAuth::parseToken()->authenticate()->id;
       $pending=Navlog::where('flight_date',date('Ymd'))->where('plan_status',1)->where('live_test_mode',1)->where('user_id',$user_id)->get();
       return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$pending),200);
    }
    public function CancelledNavlog(Request $request){ 
       $id=JWTAuth::parseToken()->authenticate()->id;
       $cancelled=Navlog::where('flight_date',date('Ymd'))->where('plan_status',2)->where('live_test_mode',1)->where('user_id',$user_id)->get();
      return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$cancelled),200);
    }
    public function EditNavlog(Request $request)
    {
       $id=$request->id;  
       $result=Navlog::find($id);
       $callsign=$result->callsign;
       $flight_date=date('d-M-Y',strtotime($result->flight_date)); 
       $res=(object) array(
          'id'=>$result->id,
          'navlog_masterid'=>$result->navlog_masterid,
          'navlog_no'=>$result->navlog_no,
          'user_id'=>$result->user_id,
          'no_of_flight'=>$result->no_of_flight,
          'flight_date'=>$flight_date,
          'callsign'=>$result->callsign,
          'registration'=>$result->registration,
          'departure'=>$result->departure,
          'dep_airport_name'=>$result->dep_airport_name,
          'destination'=>$result->destination,
          'dest_airport_name'=>$result->dest_airport_name,
          'dep_time'=>$result->dep_time,
          'deptime_ist'=>$result->deptime_ist,
          'pax'=>$result->pax,
          'load'=>$result->load,
          'fuel'=>$result->fuel,
          'min_max'=>$result->min_max,
          'pilot'=>$result->pilot,
          'mobile'=>$result->mobile,
          'co_pilot'=>$result->co_pilot,
          'cabin'=>$result->cabin,
          'remarks'=>$result->remarks,
          'dept_place'=>$result->dept_place,
          'dept_lat'=>$result->dept_lat,
          'dest_place'=>$result->dest_place,
          'dest_lat'=>$result->dest_lat,
          'speed'=>$result->speed,
          'txtspeed'=>$result->txtspeed,
          'level1'=>$result->level1,
          'main_route'=>$result->main_route,
          'alternate1'=>$result->alternate1,
          'alt1_airport_name'=>$result->alt1_airport_name,
          'level2'=>$result->level2,
          'alternate1route'=>$result->alternate1route,
          'alternate2'=>$result->alternate2,
          'alt2_airport_name'=>$result->alt2_airport_name,
          'level3'=>$result->level3,
          'alternate2route'=>$result->alternate2route,
          'take_off_alternate'=>$result->take_off_alternate,
          'toff_airport_name'=>$result->toff_airport_name,
          'take_off_alternate_route'=>$result->take_off_alternate_route,
          'level4'=>$result->level4,
          'fic'=>$result->fic,
          'adc'=>$result->adc,
          );
       $paxs=DB::table('maxfuel_maxpax')->where('callsign',$callsign)->first();
       $speedlist=DB::table('aircraft_speed')->where('callsign',$callsign)->first();
        if(count((array)$speedlist) > 0){
          foreach ($speedlist as $key=>$value) {
            if($key=='id'||$key=='callsign')
             continue;
             if(isset($value) && $value!="NULL")
              $speeds[]=$value;
          }
       }
       else
          $speeds=array();
       return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$res,'paxs'=>$paxs,'speeds'=>$speeds),200);
    }
    public function NavlogPreview(Request $request) {
        $id = $request->id;
        $modal_type = $request->modal_type;
        $data = Navlog::find($id)->toArray();
        $result['callsign'] = $data['callsign'];
        $result['navlog_no'] = $data['navlog_no'];
        $result['registration'] = $data['registration'];
        $result['departure'] = $data['departure'];
        $result['dep_time_min'] = substr($data['dep_time'], 0, 2);
        $result['dep_time_hour'] = substr($data['dep_time'], 2, 2);
        $result['destination'] = $data['destination'];
        $result['flight_date'] = date('d-M-Y', strtotime($data['flight_date']));
        $result['dep_airport_name'] = $data['dep_airport_name'];
        $result['dest_airport_name'] = $data['dest_airport_name'];
        $result['pilot'] = $data['pilot'];
        $result['mobile'] = $data['mobile'];
        $result['co_pilot'] = $data['co_pilot'];
        $result['pax'] = $data['pax'];
        $result['load'] = $data['load'];
        $result['remarks'] = $data['remarks'];
        $result['main_route'] = $data['main_route'];
        $result['cabin'] = $data['cabin'];
        $result['speed'] = $data['speed'];
        $result['level1'] = $data['level1'];
        $result['dept_place'] = $data['dept_place'];
        $result['dest_place'] = $data['dest_place'];
        $result['dept_lat'] = $data['dept_lat'];
        $result['dest_lat'] = $data['dest_lat'];
        $result['alternate1'] = $data['alternate1'];
        $result['alt1_airport_name'] = $data['alt1_airport_name'];
        $result['level2'] = $data['level2'];
        $result['alternate1route']  = $data['alternate1route'];
        $result['alternate2']  = $data['alternate2'];
        $result['alt2_airport_name'] = $data['alt2_airport_name'];
        $result['level3'] = $data['level3'];
        $result['alternate2route'] = $data['alternate2route'];
        $result['take_off_alternate'] = $data['take_off_alternate'];
        $result['level4'] = $data['level4'];
        $result['take_off_alternate_route'] = $data['take_off_alternate_route'];
        $result['toff_airport_name'] = $data['toff_airport_name'];
        if ($data['fuel'] != 0)
            $result['fuel'] = $data['fuel'];
        else if ($data['min_max'] == 2)
            $result['fuel'] = 'MAX';
        elseif ($data['min_max'] == 1)
            $result['fuel'] = 'MIN';
        elseif ($data['min_max'] == 3)
            $result['fuel']= 'NO REFUEL';
        return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$result),200);  
      }    
      public function NavlogCancel(Request $request) {
          $id = $request->id;
          $fpl_details = Navlog::find($id);
          $fpl_json_encode = json_encode($fpl_details);
          $data = json_decode($fpl_json_encode, TRUE);
          $aircraft_callsign = $data['callsign'];
          $departure_aerodrome = $data['departure'];
          $departure_time_hours = substr($data['dep_time'],0,2);
          $departure_time_minutes = substr($data['dep_time'],2,2);
          $destination_aerodrome = $data['destination'];
          $date_of_flight = $data['flight_date'];
          $pilot_in_command = $data['pilot'];
          $mobile_number = $data['mobile'];
          $copilot = $data['co_pilot'];
          $cancelled_by = $this->user_name;
          $update_plan_status = Navlog::where('id', $id)->update(['plan_status' => '2']);
          $cancelled_time = gmdate('Y-m-d H:i:s');
          if ($departure_aerodrome == 'ZZZZ') {
              $departure_aerodrome = $data['dept_place'];
          }
          if ($destination_aerodrome == 'ZZZZ') {
              $destination_aerodrome = $data['dest_place'];
          }
          $date_of_flight1 = date('ymd', strtotime($date_of_flight));
          $data['subject_type'] = 'cancel';
          $subject = myFunction::get_navlog_subject($data);
          $data['cancelled_by'] = " <span style='color:red;'> Cancelled By: $cancelled_by</span>";
          $data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
          date_default_timezone_set('Asia/Calcutta');
          $data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
          $data['cancelled_via'] = "<span style='margin-left:38px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];
          $data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                  $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight1 . ")";
          $data['heading_top'] = "CANCEL";
          $data['get_zzzz_value'] = myFunction::get_navlog_zzzz_value($data);
          $data['email'] = $this->user_email;
          $data['subject'] = $subject;
          $mail_headers = [
              'from' => $this->from,
              'from_name' => $this->from_name,
              'subject' => $subject,
              'to' => $this->user_email,
              'cc' => myFunction::get_navlog_cc_mails([]),
              'bcc' => myFunction::get_bcc_mails()
          ];
          $this->dispatch(new CancelEmailJob($data));
          return Response::json(['SUCCESS' => true,'STATUS_CODE' => '200','MESSAGE' => $aircraft_callsign . ' PLAN CANCELLED SUCCESSFULLY']);
      }      
      public function revice_time(Request $request) {
           $id = $request->id;
           $navlog_details = Navlog::find($id);
           $navlog_details_json_encode = json_encode($navlog_details);
           $data = json_decode($navlog_details_json_encode, TRUE);
           $is_update = '';
           if ($data['dep_time'] != $request->departure_time) {
               $is_update = 1;
           }
           $aircraft_callsign = $data['callsign'];
           $departure_aerodrome = $data['departure'];
           $departure_time_hours = substr($request->departure_time,0, 2);
           $departure_time_minutes = substr($request->departure_time,2, 2);
           $destination_aerodrome = $data['destination'];
           $date_of_flight = $data['flight_date'];
           $pilot_in_command = $data['pilot'];
           $mobile_number = $data['mobile'];
           $copilot = $data['co_pilot'];
           $revised_by = $this->user_name;
            $get_zzzz_value = myFunction::get_navlog_zzzz_value($data);
           //Status update
           $update_plan_status = Navlog::where('id', $id)->update(['dep_time' => $request->departure_time]);
           $revised_time = gmdate('Y-m-d H:i:s');
           if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
               $departure_aerodrome2 = $data['dept_place'];
           } else {
               $departure_aerodrome2 = $departure_aerodrome;
           }

           if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
               $destination_aerodrome2 = $data['dest_place'];
           } else {
               $destination_aerodrome2 = $destination_aerodrome;
           }
           $date_format = date('d-M-Y', strtotime($date_of_flight));
           $date_of_flight1 = date('ymd', strtotime($date_of_flight));
           $subject = "NEW ETD " . $departure_time_hours . $departure_time_minutes . ' ' . $aircraft_callsign . ' ' . $departure_aerodrome2 . '-' . $destination_aerodrome2 . " // " . $date_format;
           $data['revised_by'] = "Revised By: <span style=color:#f00;>$revised_by</span>";
           $data['revised_date'] = "<span style='margin-left:27px;color:#404040;'></span>Revised Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";

           date_default_timezone_set('Asia/Calcutta');
           $data['revised_time'] = "<span style='margin-left:27px;color:#404040;'></span> Revised Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
           $data['revised_via'] = "<span style='margin-left:33px;color:#404040;'></span>Revised Via: " . $_SERVER['HTTP_HOST'];

           $data['revice_time_heading'] = "(DLA-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                   $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight1 . ")";

           $data['get_zzzz_value'] = $get_zzzz_value;
           $mail_headers = [
               'from' => $this->from,
               'from_name' => $this->from_name,
               'subject' => $subject,
               'to' => $this->user_email,
               'cc' => myFunction::get_navlog_cc_mails([]),
               'bcc' => myFunction::get_bcc_mails()
           ];
           $data['email'] = $this->user_email;
           $data['subject'] = $subject;
           if ($is_update) {
               $this->dispatch(new DelayEmailJob($data));
           }
          return Response::json(['SUCCESS' => true,'STATUS_CODE' => '200','MESSAGE' => $aircraft_callsign . ' DEPARTURE TIME REVISED SUCCESSFULLY']);
       }
       public function change_fic_adc(Request $request) {
           $id = $request->id;
           $navlog_details = Navlog::find($id);
           $navlog_json_encode = json_encode($navlog_details);
           $data = json_decode($navlog_json_encode, TRUE);
           $aircraft_callsign = $data['callsign'];
           $departure_aerodrome = $data['departure'];
           $departure_time_hours = substr($data['dep_time'],0,2);
           $departure_time_minutes = substr($data['dep_time'],2,2);
           $destination_aerodrome = $data['destination'];
           $departure_station = $data['dept_place'];
           $departure_latlong = $data['dept_lat'];
           $destination_station = $data['dest_place'];
           $destination_latlong = $data['dest_lat'];
           $date_of_flight = $data['flight_date'];
           if ($departure_aerodrome == 'ZZZZ') {
               $departure_aerodrome = $departure_station;
           }
           if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
               $destination_aerodrome = $destination_station;
           }
           $entered_by = $this->user_name;
           $adc_updated_by = $this->user_id;
           $adc_updated_time = date('y-m-d H:i:s');
           $fic = $request->fic;
           $adc = $request->adc;
           $is_update = '';
           if ($data['fic'] . $data['adc'] != $fic . $adc) {
               $is_update = 1;
           }
           $fic_update = ['fic' => $fic, 'adc' => $adc, 'adc_updated_by' => $adc_updated_by, 'adc_updated_time' => $adc_updated_time];
           $update_plan_status = Navlog::find($id)->update($fic_update);
           $adc_updated_time = gmdate('Y-m-d H:i:s');
           $fpl_stats_data = ['adc_updated_by' => $this->user_id, 'adc_updated_time' => $adc_updated_time];
           $date_format = date('d-M-Y', strtotime($date_of_flight));
           $subject = $aircraft_callsign . " FIC " . $fic . " & ADC " . $adc . ' ' . $departure_aerodrome . ' ' .
                   $departure_time_hours . $departure_time_minutes . ' - ' . $destination_aerodrome . ' (' . $date_format . ')';
           $data['entered_by'] = "Entered  By: <span style='color:red;'>$entered_by</span>";
           $data['entered_date'] = "<span style='margin-left:27px;color:#404040;'></span>Entered  Date: <span style='color:red;'>" . date('d-M-Y') . "</span>";
           date_default_timezone_set('Asia/Calcutta');
           $data['entered_time'] = "<span style='margin-left:27px;color:#404040;'></span> Entered  Time: <span style='color:red;'>" . date('H:i') . "  IST" . "</span>";
           $data['entered_via'] = "<span style='margin-left:33px;color:#404040;'></span>Entered  Via: " . $_SERVER['HTTP_HOST'];

           $data['fic_adc_heading'] = $subject;
           $data['get_zzzz_value'] = myFunction::get_navlog_zzzz_value($data);
           $mail_headers = [
               'from' => $this->from,
               'from_name' => $this->from_name,
               'subject' => $subject,
               'to' => $this->user_email,
               'cc' => myFunction::get_navlog_cc_mails([]),
               'bcc' => myFunction::get_bcc_mails()
           ];
           $data['email'] = $this->user_email;
           $data['subject'] = $subject;
           Log::info('FICADC Email Job Starts ' . $subject);
           $this->dispatch(new FICADCEmailJob($data));
           Log::info('FICADC Email Job Ends ' . $this->user_email);
           //SMS
           $message = "" . $aircraft_callsign . " FIC " . $fic . " ADC " . $adc . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome . ". Call +91 8861660160 for Support. HAVE A NICE FLIGHT:)";
           $user = "eflight";
           $password = "PCpl2016";
           $to = CallsignInfoModel::get_navlog_mobile_numbers($data);
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
          return Response::json(['SUCCESS' => true,'STATUS_CODE' => '200','MESSAGE' => $aircraft_callsign . ' FIC ADC Updated Succesfsully']);

       }
       public function update_navlog(Request $request)
       {       
               $field=array();
               $updated=false;
               $navlog_id=$request->navlog_id;
               $navlog_data=Navlog::find($navlog_id);
               if($navlog_data->speed!=$request->speed || $navlog_data->level1!=$request->level1 || $navlog_data->main_route!=$request->main_route||$navlog_data->txtspeed!=$request->txtspeed){
                 
                   $this->speed_change($request->all()); 
               }
                if($navlog_data->alternate1!=$request->alternate1||$navlog_data->alternate2!=$request->alternate2)  {
                   $this->alt1alt2_change($request->all());  
                  } 
                if($navlog_data->min_max!=$request->min_max||$navlog_data->fuel!=$request->fuel||$navlog_data->pax!=$request->pax||$navlog_data->load!=$request->load||$navlog_data->pilot!=$request->pilot||$navlog_data->mobile!=$request->mobile||$navlog_data->co_pilot!=   $request->co_pilot||$navlog_data->cabin!=$request->cabin||$navlog_data->remarks!=$request->remarks||$navlog_data->take_off_alternate!=$request->take_off_alternate||$navlog_data->level4!=$request->level4||$navlog_data->take_off_alternate_route!=$request->take_off_alternate_route||$navlog_data->level2!=$request->level2||$navlog_data->alternate1route!=$request->alternate1route||$navlog_data->level3!=$request->level3||$navlog_data->alternate2route!=$request->alternate2route){
                   $this->other_changes($request->all());    
                } 
                elseif($request->has('registration')){
                       if($navlog_data->registration!=$request->registration)
                         $this->other_changes($request->all());    
                }

               if($navlog_data->min_max!=$request->min_max||$navlog_data->fuel!=$request->fuel||$navlog_data->pax!=$request->pax||$navlog_data->load!=$request->load||$navlog_data->pilot!=$request->pilot||$navlog_data->mobile!=$request->mobile||$navlog_data->co_pilot!=$request->co_pilot||$navlog_data->level1!=$request->level1||$navlog_data->main_route!=$request->main_route||$navlog_data->cabin!=$request->cabin||$navlog_data->speed!=$request->speed||$navlog_data->txtspeed!=$request->txtspeed||$navlog_data->remarks!=$request->remarks||$navlog_data->alternate1!=$request->alternate1||$navlog_data->level2!=$request->level2||$navlog_data->alternate1route!=$request->alternate1route||$navlog_data->alternate2!=$request->alternate2||$navlog_data->level3!=$request->level3||$navlog_data->alternate2route!=$request->alternate2route||$navlog_data->take_off_alternate!=$request->take_off_alternate||$navlog_data->level4!=$request->level4||$navlog_data->take_off_alternate_route!=$request->take_off_alternate_route||$navlog_data->registration!=$request->registration){
                  if($navlog_data->fuel!=$request->fuel && $request->fuel!=''){
                     Navlog::find($navlog_id)->update(array_merge($request->all(),['min_max' =>0])); 
                   }
                   else
                     Navlog::find($navlog_id)->update($request->all()); 
               $updated=true;          
               
               return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully"),200);  
              }
              return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully"),200);
       }
       public function speed_change($data) {
           $navlog_details = Navlog::find($data['navlog_id']);
           $data['departure']=$navlog_details->departure;
           $data['destination']=$navlog_details->destinationa;
           $data['dept_place']=$navlog_details->dept_place;
           $data['dest_place']=$navlog_details->dest_place;
           $aircraft_callsign = $navlog_details->callsign;
           $departure_aerodrome =$navlog_details->departure;
           $departure_time_hours = substr($navlog_details->dep_time,0,2);
           $departure_time_minutes=substr($navlog_details->dep_time,2,2);
           $destination_aerodrome = $navlog_details->destination;
           $date_of_flight = $navlog_details->flight_date;
           $pilot_in_command =$navlog_details->pilot;
           $mobile_number = $navlog_details->mobile;
           $copilot = $navlog_details->co_pilot;
           if(isset($data['txtspeed']))
             $txtspeed = $data['txtspeed'];
           else
             $txtspeed='';

           if(isset($data['speed']))
             $speed = $data['speed'];
           else
             $speed='';
           $flight_level = $data['level1'];
           $main_route =strtoupper($data['main_route']);
           $mail_send = '';
           $id = $data['navlog_id'];
           if ($speed != $navlog_details->speed) {
               $mail_send = 1;
               $crushing_speed = "<span style='color:red'>" . $speed . '</span>';
           }
           else{
             $mail_send = 1;
             $crushing_speed =$speed; 
           }
           if ($txtspeed != $navlog_details->txtspeed) {
               $mail_send = 1;
               $txtspeed = "<span style='color:red'>" . $txtspeed . '</span>';
           }
           else{
             $mail_send = 1;
             $txtspeed =$txtspeed; 
           }

           if($flight_level==''){
              $mail_send = 1;
              $flight_level='';
           }
           else if ($flight_level != $navlog_details->level1) {
               $mail_send = 1;
               $flight_level = "<span >F" ."<span style='color:red'>$flight_level</span>" . '</span>';
           }
           elseif($navlog_details->level1!=""){
             $mail_send = 1;
             $flight_level = "<span>".'F'.$flight_level . '</span>';
           }
           if($main_route==''){
              $mail_send = 1;
              $route='';
           }  
           elseif ($main_route != $navlog_details->main_route) {
               $mail_send = 1;
               $route = "<span style='color:red'>" .' '.$main_route.'</span>';
           }
           elseif($main_route!=""){
              $mail_send = 1;
              $route = "<span>" .' '.$main_route . '</span>';
            }
            else
             $route ='';
           $changed_by = $this->user_name;
           $subject = $aircraft_callsign . " DETAILS CHANGED // DOF ". date('d-M-Y',strtotime($date_of_flight));
           $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
           $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
           date_default_timezone_set('Asia/Calcutta');
           $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
           $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];
            $data['speed_change_heading']='';
            $data['speed_change_heading'].="(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                   $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                   date('ymd',strtotime($date_of_flight)) . "-15/";
            if ($txtspeed!='')
              $data['speed_change_heading'].=$txtspeed;
            if ($crushing_speed!='')
              $data['speed_change_heading'].=$crushing_speed;
            if ($flight_level!='')
              $data['speed_change_heading'].=$flight_level;
            if ($route!='')
              $data['speed_change_heading'].=$route;
         
           $data['speed_change_heading'].=")";     
           $data['get_zzzz_value'] = myFunction::get_navlog_zzzz_value($data);
           $data['email'] = $this->user_email;
           $data['subject'] = $subject;
           $mail_headers = [
               'from' => $this->from,
               'from_name' => $this->from_name,
               'subject' => $subject,
               'to' => $this->user_email,
               'cc' => myFunction::get_navlog_cc_mails($data),
               'bcc' => myFunction::get_bcc_mails(),
           ];
           if ($mail_send) {
               Log::info("SpeedChangeEmailJob Queues Begins");
               $this->dispatch(new NavlogSpeedChangeEmailJob($data));
               Log::info("FlightPlanEmailJob Queues ends");
           }
           return $mail_send;
       }
           public function alt1alt2_change($data) {
               $navlog_details = Navlog::find($data['navlog_id']);
               $data['departure']=$navlog_details->departure;
               $data['destination']=$navlog_details->destinationa;
               $data['dept_place']=$navlog_details->dept_place;
               $data['dest_place']=$navlog_details->dest_place;
               $aircraft_callsign = $navlog_details->callsign;
               $departure_aerodrome =$navlog_details->departure;
               $departure_time_hours = substr($navlog_details->dep_time,0,2);
               $departure_time_minutes=substr($navlog_details->dep_time,2,2);
               $destination_aerodrome = $navlog_details->destination;
               $date_of_flight = $navlog_details->flight_date;
               $pilot_in_command =$navlog_details->pilot;
               $mobile_number = $navlog_details->mobile;
               $copilot = $navlog_details->co_pilot;
               $alternate1 = strtoupper($data['alternate1']);
               $alternate2 = strtoupper($data['alternate2']);
               // $alternate1route=strtoupper($data['alternate1route']);
               // $level2=$data['level2'];
               // $alternate2route=strtoupper($data['alternate2route']);
               // $level3=$data['level3'];
               $result=FlightPlanDetailsModel::where('aircraft_callsign',$aircraft_callsign)->where('departure_aerodrome',$departure_aerodrome)->where('destination_aerodrome',$destination_aerodrome)->orderBy('id','desc')->first();
               if(count($result)>0){
                 $total_flying_hours=$result->total_flying_hours;
                 $total_flying_minutes=$result->total_flying_minutes;
               }
               else{
                 $total_flying_hours='';
                 $total_flying_minutes=''; 
                }
               $mail_send = '';
               $id = $data['navlog_id'];
               if($alternate1==''){
                   $alternate1=''; 
                   $mail_send = 1;
               } 
               elseif ($alternate1 != $navlog_details->alternate1) {
                   $mail_send = 1;
                   $alternate1 = "<span style='color:red'>".$alternate1.'</span>';
               }
               else{
                 $mail_send = 1;
                 $alternate1 = "<span>".$alternate1.'</span>'; 
               }
               // if($level2=='')
               //     $level2=''; 
               // else if ($level2 != $navlog_details->level2) 
               //     $level2 = "<span>F"."<span style='color:red'>".$level2.'</span></span>';
               // elseif($navlog_details->level2!="")
               //     $level2 = "<span>F".$level2.'</span>';  
               
               // if($alternate1route==''){
               //     $alternate1route=''; 
               // }     
               // else if ($alternate1route != $navlog_details->alternate1route) 
               //     $alternate1route = "<span  style='color:red'>" . $alternate1route.'</span>';
               // else
               //     $alternate1route = "<span>" . $alternate1route.'</span>';

               // if($level3==''){
               //     $level3=''; 
               //     $mail_send = 1;
               //  }   
               // else if ($level3 != $navlog_details->level3) {
               //     $level3 = "<span>F<span style='color:red'>".$level3 .'</span></span>';
               //     $mail_send = 1;
               // }    
               // elseif($navlog_details->level3!=""){
               //     $level3 = "<span>F".$level3 . '</span>';
               //     $mail_send = 1;  
               // }

               // if($alternate2route==''){
               //     $alternate2route=''; 
               //     $mail_send = 1;
               //  }   
               // elseif ($alternate2route != $navlog_details->alternate2route){ 
               //     $mail_send = 1;
               //     $alternate2route = "<span  style='color:red'>" . $alternate2route . '</span>';
               //   }
               // else{
               //     $mail_send = 1;
               //     $alternate2route = "<span>" . $alternate2route . '</span>';
               //   }    

               if($alternate2==''){
                   $alternate2=''; 
                   $mail_send = 1;
                }   
               elseif ($alternate2 != $navlog_details->alternate2) {
                   $mail_send = 1;
                   $alternate2 = "<span style='color:red'>" . $alternate2 . '</span>';
               }
               else{
                  $mail_send = 1;
                  $alternate2 = "<span>" . $alternate2 . '</span>';
               }
               $changed_by = $this->user_name;
               $subject = $aircraft_callsign . " DETAILS CHANGED  // DOF " . date('d-M-Y',strtotime($date_of_flight));
               $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
               $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
               date_default_timezone_set('Asia/Calcutta');
               $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
               $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];
               $data['speed_change_heading']='';
               $data['speed_change_heading'] .= "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                       $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                       date('ymd',strtotime($date_of_flight)) . "-16/$destination_aerodrome$total_flying_hours$total_flying_minutes";
                if($alternate1!='')
                   $data['speed_change_heading'].=' ';

                if ($alternate1!='')
                  $data['speed_change_heading'].=$alternate1;
                /*if ($level2!='')
                  $data['speed_change_heading'].=$level2;
                if ($alternate1route!='')
                  $data['speed_change_heading'].=" $alternate1route";

                if($alternate2!='' ||$level3!=''||$alternate2route!='')
                   $data['speed_change_heading'].=' ';*/
                if($alternate2!='')
                   $data['speed_change_heading'].=' ';
                if ($alternate2!='')
                  $data['speed_change_heading'].=$alternate2;
                /*if ($level3!='')
                  $data['speed_change_heading'].=$level3;
                if ($alternate2route!='')
                  $data['speed_change_heading'].=" $alternate2route";*/

                 $data['speed_change_heading'].=")";
                             
               $data['get_zzzz_value'] = myFunction::get_navlog_zzzz_value($data);
               $data['email'] = $this->user_email;
               $data['subject'] = $subject;
               $mail_headers = [
                   'from' => $this->from,
                   'from_name' => $this->from_name,
                   'subject' => $subject,
                   'to' => $this->user_email,
                   'cc' => myFunction::get_navlog_cc_mails($data),
                   'bcc' => myFunction::get_bcc_mails(),
               ];
               if ($mail_send) {
                   Log::info("SpeedChangeEmailJob Queues Begins");
                   $this->dispatch(new NavlogALTChangeEmailJob($data));
                   Log::info("FlightPlanEmailJob Queues ends");
               }
               return $mail_send;
           }
          public function other_changes($data) {
               
               $navlog_details = Navlog::find($data['navlog_id']);
               $aircraft_callsign =$navlog_details->callsign;
               $departure_aerodrome =$navlog_details->departure;
               $destination_aerodrome =$navlog_details->destination;
               $data['departure']=$navlog_details->departure;
               $data['destination']=$navlog_details->destination;
               $data['dept_place']=$navlog_details->dept_place;
               $data['dest_place']=$navlog_details->dest_place;
               $departure_time_hours = substr($navlog_details->dep_time,0,2);
               $departure_time_minutes=substr($navlog_details->dep_time,2,2);
               $take_off_altn=strtoupper($data['take_off_alternate']);
               $take_off_alternate_route=strtoupper($data['take_off_alternate_route']);
               if(isset($data['cabin']))
                $cabin=$data['cabin'];
               else
                 $cabin='';
               if(isset($data['speed']))
                $speed=$data['speed'];
               else
                 $speed='';
               $level4=$data['level4'];
               $date_of_flight = $navlog_details->flight_date;
               $pilot_in_command =strtoupper($data['pilot']);
               $mobile_number = $data['mobile'];
               $copilot =strtoupper($data['co_pilot']);
               $remarks=strtoupper($data['remarks']);
               $pax=$data['pax'];
               $cargo=$data['load'];
               $fuel=$data['fuel'];
               $alternate1route=strtoupper($data['alternate1route']);
               $level2=$data['level2'];
               $alternate2route=strtoupper($data['alternate2route']);
               $level3=$data['level3'];
               $fpl_details=FlightPlanDetailsModel::where('aircraft_callsign',$aircraft_callsign)->where('departure_aerodrome',$departure_aerodrome)->where('destination_aerodrome',$destination_aerodrome)->orderBy('id','desc')->first();
               if(count($fpl_details)>0){
                 $total_flying_hours = $fpl_details->total_flying_hours;
                 $total_flying_minutes = $fpl_details->total_flying_minutes;
                 $flyingtime =$total_flying_hours." ".$total_flying_minutes;
               }
               else{
                 $total_flying_hours='';
                 $total_flying_minutes=''; 
                 $flyingtime =$total_flying_hours.$total_flying_minutes;
                }
                 $pbn= ($fpl_details) ? $fpl_details->pbn : '';
                 $nav= ($fpl_details) ? $fpl_details->nav : '';
                 $sel = ($fpl_details) ? $fpl_details->sel : '';
                 $code = ($fpl_details) ? $fpl_details->code : '';
                 $fir_crossing_time = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
                 $operator = ($fpl_details) ? $fpl_details->operator : '';
                 $tcas= ($fpl_details) ? ($fpl_details->tcas == 'YES') ? 'YES' : 'NO' : 'NO';
                 $credit = ($fpl_details) ? $fpl_details->credit : '';
                 $indian= ($fpl_details) ? $fpl_details->indian : '';
                 $foreigner = ($fpl_details) ? $fpl_details->foreigner : '';
                 $foreigner_nationality = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
                 $endurance_hours = ($fpl_details) ? $fpl_details->endurance_hours : '';
                 $endurance_minutes = ($fpl_details) ? $fpl_details->endurance_minutes : '';
                 if($endurance_hours!='')    
                   $total_endurance=" E" . $endurance_hours . $endurance_minutes; 
                 else
                   $total_endurance='';
                 $pbn = "<span>" . $pbn . '</span>';
                 $nav = "<span>" . $nav . '</span>';
                 if(isset($data['registration']))
                 {
                   $reg=strtoupper($data['registration']);
                  if (strtoupper($data['registration']) !=$navlog_details->registration) 
                      $registration = "<span>" ." REG/"."<span style='color:red'>$reg</span>" . '</span>';
                  else
                     $registration = "<span>"." REG/".$navlog_details->registration . '</span>'; 
                  }
                 else
                   $registration = "<span>"." REG/".$navlog_details->registration . '</span>'; 

                 $fir_crossing_time_value = ($fir_crossing_time) ? " EET/" . $fir_crossing_time . " " : ''; 
                if ($sel !='') 
                    $sel = "<span>" . $sel . '</span>';
                
                if ($code !='') 
                    $code = "<span>" . $code . '</span>';

                if ($operator !='') 
                    $operator = "<span>" . $operator . '</span>';
                
                if ($take_off_altn != $navlog_details->take_off_alternate) 
                    $take_off_altn = "<span  style='color:red'>" . $take_off_altn . '</span>';
                else
                    $take_off_altn = "<span>" . $navlog_details->take_off_alternate . '</span>';
                
                if($cabin=='')
                    $cabin ='';
                else if ($cabin != $navlog_details->cabin) 
                    $cabin = "<span> CABIN NO " . "<span style='color:red'>".$cabin."</span>" . '</span>';
                else
                    $cabin = "<span> CABIN NO " . $cabin . '</span>';

                if ($pax != $navlog_details->pax) 
                    $pax = "<span><span style='color:red'> PAX </span>" . "<span style='color:red'>".$pax."</span>" . '</span>';
                else
                    $pax = "<span> PAX " . $pax . ' </span>';

                if ($cargo != $navlog_details->load) 
                    $cargo = "<span><span style='color:red'> CARGO </span>" . "<span style='color:red'>".$cargo."</span>" . '</span>';
                else
                    $cargo = "<span> CARGO " . $cargo . '</span>';
                
                if($level2=='')
                    $level2=''; 
                else if ($level2 != $navlog_details->level2) 
                    $level2 = "<span style='color:red'> ALT1 LEVEL </span>"."<span style='color:red'>".$level2.'</span>';
                elseif($navlog_details->level2!="")
                    $level2 = "<span> ALT1 LEVEL ".$level2.'</span>';  
                
                if($alternate1route==''){
                    $alternate1route=''; 
                }     
                else if ($alternate1route != $navlog_details->alternate1route) 
                    $alternate1route = "<span style='color:red'> ALT1 ROUTE </span>"."<span  style='color:red'>" . $alternate1route.'</span>';
                else
                    $alternate1route = "<span> ALT1 ROUTE </span>"."<span>" . $alternate1route.'</span>';

                if($level3==''){
                    $level3=''; 
                    $mail_send = 1;
                 }   
                else if ($level3 != $navlog_details->level3) {
                    $level3 = "<span style='color:red'> ALT2 LEVEL </span><span style='color:red'>".$level3 .'</span>';
                    $mail_send = 1;
                }    
                elseif($navlog_details->level3!=""){
                    $level3 = "<span> ALT2 LEVEL ".$level3 . '</span>';
                    $mail_send = 1;  
                }

                if($alternate2route==''){
                    $alternate2route=''; 
                    $mail_send = 1;
                 }   
                elseif ($alternate2route != $navlog_details->alternate2route){ 
                    $mail_send = 1;
                    $alternate2route = "<span style='color:red'>ALT2 ROUTE </span><span  style='color:red'>" . $alternate2route . '</span>';
                  }
                else{
                    $mail_send = 1;
                    $alternate2route = "<span>ALT2 ROUTE </span><span>" . $alternate2route . '</span>';
                  }    

                
                if($fuel!='')
                 {
                      if ($fuel != $navlog_details->fuel) 
                          $fuel = "<span><span style='color:red'> FUEL </span> " . "<span style='color:red'>".$fuel."</span>" . '</span>';
                      else
                          $fuel = "<span> FUEL " . $fuel . '</span>';
                 }
                else
                 {
                         $min_max=$data['min_max'];
                         if($min_max==1)
                           $min_max_value='MIN';
                         elseif($min_max==2)
                           $min_max_value='MAX';
                         elseif($min_max==3)
                           $min_max_value='NO REFUEL';

                         if ($min_max != $navlog_details->min_max) 
                          $fuel = "<span><span style='color:red'> FUEL </span> " . "<span style='color:red'>".$min_max_value."</span>" . '</span>';
                        else
                          $fuel = "<span> FUEL " . $min_max_value . '</span>';        
                 }
                if($level4=='')
                    $flight_level=''; 
                else if ($level4 != $navlog_details->level4) 
                    $level4 = "<span>F" . "<span style='color:red'>".$level4 .'</span></span>';
                elseif($navlog_details->level4!="")
                    $level4 = "<span>" . ' F'.$level4 . '</span>';  

                if ($take_off_alternate_route != $navlog_details->take_off_alternate_route) 
                    $take_off_alternate_route = "<span  style='color:red'>" . $take_off_alternate_route . '</span>';
                else
                    $take_off_alternate_route = "<span>" . $take_off_alternate_route . '</span>';
                      

                if ($pilot_in_command != $navlog_details->pilot) 
                    $pilot_in_command = "<span>"."<span style='color:red'>".$pilot_in_command . "</span>" . '</span>';
                else
                    $pilot_in_command = "<span>" . $pilot_in_command. '</span>';

                if ($mobile_number != $navlog_details->mobile) 
                    $mobile_number = "<span  style='color:red'>" . $mobile_number . '</span>';
                else
                    $mobile_number = "<span>" . $mobile_number. '</span>';

                if ($copilot != $navlog_details->co_pilot) 
                    $copilot = "<span  style='color:red'>" . $copilot . '</span>';
                else
                    $copilot = "<span>" . $copilot . '</span>'; 

                $tcas_value = ($tcas == 'YES') ? "<span> TCAS EQUIPPED</span>" : '';

                $credit_value = ($credit == "YES") ? "<span> CREDIT FACILITY AVAILABLE WITH AAI </span>" : "<span> NO CREDIT FACILITY</span>";
                
                if ($remarks != $navlog_details->remarks) 
                    $remarks = "<span  >" . " RMK/"."<span style='color:red'>$remarks</span>" . '</span>';
                else
                    $remarks = "<span>" . " RMK/".$remarks . '</span>';
           
                 $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
                 $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
                 $code_value = ($code) ? " CODE/" . $code . "" : '';
                 $sel_value = ($sel) ? " SEL/" . $sel . "" : '';
                 $take_off_altn_value = ($take_off_altn) ? $take_off_altn . "" : '';

                 $level4_value = ($level4) ? $level4 . "" : '';
                 $take_off_alternate_route_value = ($take_off_alternate_route) ? $take_off_alternate_route . "" : '';
                 if($take_off_altn_value!=""||$level4_value!=""||$take_off_alternate_route_value!="")
                   $talt_level=" TALT/";
                 else
                   $talt_level="";

                 $indian_value = ($indian == "YES") ? " ALL INDIANS ON BOARD NO FOREIGNER" : '';
                 $foreigner_value = ($foreigner == "YES") ? " FOREIGNER ON BOARD " . $foreigner_nationality : '';
                 $changed_by = $this->user_name;
                 $subject = $aircraft_callsign . " DETAILS CHANGED // DOF " . date('d-M-Y',strtotime($date_of_flight));
                 $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
                 $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
                 date_default_timezone_set('Asia/Calcutta');
                 $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
                 $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];
                 $data['other_changes_heading']='';
                 $data['other_changes_heading'] .= "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                         $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .date('ymd',strtotime($date_of_flight))
                         . "-18/" . $pbn_value . $nav_value . $registration . $fir_crossing_time_value . $sel_value . $code_value . " OPR/" . $operator  . $talt_level . $take_off_altn_value ." $level4_value "." $take_off_alternate_route_value ". $remarks . $tcas_value . $credit_value ." PIC " .
                         $pilot_in_command . " MOB " . $mobile_number . " " . $indian_value . $foreigner_value . $total_endurance . ' CO PILOT' ." ".$copilot . $cabin  ;
                         
                 if ($level2!='')
                   $data['other_changes_heading'].=$level2;
                 if ($alternate1route!='')
                   $data['other_changes_heading'].=" $alternate1route";
                 if ($level3!='')
                   $data['other_changes_heading'].=$level3;
                 if ($alternate2route!='')
                   $data['other_changes_heading'].=" $alternate2route";

                 $data['other_changes_heading'].=$pax . $fuel . $cargo.")";        
                 $data['get_zzzz_value'] = myFunction::get_navlog_zzzz_value($data);
                 $data['subject'] = $subject;
                 $data['email'] = $this->user_email;
                 $mail_headers = [
                     'from' => $this->from,
                     'from_name' => $this->from_name,
                     'subject' => $subject,
                     'to' => $this->user_email,
                     'cc' => myFunction::get_navlog_cc_mails($data),
                     'bcc' => myFunction::get_bcc_mails(),
                 ];
                 $mail_send=1;  
                 if ($mail_send) {
                     Log::info("OtherChangeEmailJob Queues Begins2");
                     $this->dispatch(new NavlogOtherChangeEmailJob($data));
                     Log::info("OtherChangeEmailJob Queues Begins2");
                 }
                 return $mail_send; 
       } 
       public function navlog_search(Request $request){
          /*
             Disable for previous Date Record is Pending
          */
           $id=JWTAuth::parseToken()->authenticate()->id;
           $iTotal=Navlog::where('user_id', $id)->count(); 
           $builder = Navlog::query();
           $builder_count = Navlog::query();
           $result = $builder->where('user_id',$id)->get();
           if($request->has('from_date') && $request->has('to_date')){
                $builder->where('flight_date','>=',date('Ymd', strtotime($request->from_date)))
                        ->where('flight_date','<=',date('Ymd', strtotime($request->to_date)));
                $builder_count->where('flight_date','>=',date('Ymd', strtotime($request->from_date)))
                        ->where('flight_date','<=',date('Ymd', strtotime($request->to_date)));        
           }
           else{
                 $builder->where('flight_date',date('Ymd'));
                 $builder_count->where('flight_date',date('Ymd'));
                }
           if($request->has('aircraft_callsign')){
                 $builder->where('callsign','like',"%$request->aircraft_callsign");
                 $builder_count->where('callsign','like',"%$request->aircraft_callsign");       
           }
           if($request->has('departure_aerodrome')){
                $builder->where(function($query) use ($request){
                     $query->where('departure','like',"%$request->departure_aerodrome%")
                           ->orWhere('dept_place','like',"%$request->departure_aerodrome%");
               });   
               $builder_count->where(function($query_count) use ($request){
                     $query_count->where('departure','like',"%$request->departure_aerodrome%")
                                 ->orWhere('dept_place','like',"%$request->departure_aerodrome%");
               });     
           }
           if($request->has('destination_aerodrome')){
               $builder->where(function($query) use ($request){
                     $query->where('destination','like',"%$request->destination_aerodrome%")
                           ->orWhere('dest_place','like',"%$request->destination_aerodrome%");
               });     
               $builder_count->where(function($query_count) use ($request){
                     $query_count->where('destination','like',"%$request->departure_aerodrome%")
                                 ->orWhere('dest_place','like',"%$request->departure_aerodrome%");
               });        
           }
          $result = $builder->where('user_id', $id)->where('live_test_mode',1)->orderBy('flight_date', 'desc')->orderBy('dep_time', 'desc')->get();
          $result_count = $builder_count->where('user_id', $id)->where('live_test_mode',1)->orderBy('flight_date', 'desc')->orderBy('dep_time', 'desc')->count();
          $is_admin = $this->is_admin;
          $output=array();
          $row = array();
          foreach($result as $res) 
          {       
                 $id = $res->id;
                 $date_of_flight = $res->flight_date;
                 $aircraft_callsign = $res->callsign;
                 $departure_aerodrome = $res->departure;
                 $destination_aerodrome = $res->destination;
                 $departure_time_hours = substr($res->dep_time,0,2);
                 $departure_time_minutes =substr($res->dep_time,2,2);
                 $fic = $res->fic;
                 $adc = $res->adc;
                 $plan_status = $res->plan_status;
                 $plan_status_class = ($plan_status == 2) ? "company_color" : 'text-black';
                 $current_date = date('Ymd');
                 $is_plan_active = '';
                 $is_fic_active = '';
                 $background_white = '';
                 if ($date_of_flight >= $current_date && $plan_status == 1) {
                     $is_plan_active = 1;
                 }
                 if ($date_of_flight == $current_date && $plan_status == 1 && $is_admin) {
                     $is_fic_active = '1';
                     $background_white = ($fic && $adc) ? '' : 'background-white';
                 }
                 $cursor_disable = ($is_plan_active) ? '' : 'cursor_disable';
                 $departure_station = '';
                 $destination_station = '';
                 $tooltip_cancel = '';
                 $tooltip_cancel2 = '';

                 if (($departure_aerodrome == 'ZZZZ' && $destination_aerodrome == 'ZZZZ') || ($plan_status == 2)) {
                     $notam_cursor_disable = "style='cursor:not-allowed !important;'";
                     $fpl_notams = "";
                 } else {
                     $notam_cursor_disable = "style='cursor:pointer !important;'";
                     $fpl_notams = "fpl_notams";
                 }
                 if ($departure_aerodrome == 'ZZZZ') {
                     $tooltip_cancel = 'tooltip_cancel';
                 }
                 if ($destination_aerodrome == 'ZZZZ') {
                     $tooltip_cancel2 = 'tooltip_cancel';
                 }

                 if ($departure_aerodrome == 'ZZZZ') {
                     $departure_aerodrome = substr($res->dept_place, 0, 16);
                     $departure_station = $res->dept_place;
                 }
                 if ($destination_aerodrome == 'ZZZZ') {
                     $destination_aerodrome = substr($res->dest_place, 0, 16);
                     $destination_station = $res->dest_place;
                 }

                 if ($is_plan_active) {
                     $fdtl_popup = "fdtl_popup";
                 } else {
                     $fdtl_popup = "";
                 }
                 $hi = gmdate('Hi');
                 $cursor_disable = ($is_plan_active) ? "" : "style='cursor:not-allowed !important;'";
                 $fic_cursor_disable = ($is_fic_active) ? "" : "style='cursor:not-allowed !important;'";
                 $fic_disabled = ($is_fic_active) ? '' : 'disabled="disabled"';
                 $fic_readonly = ($fic) ? 'readonly=readonly' : '';
                 $adc_readonly = ($adc) ? 'readonly=readonly' : '';
                 $check_revise = ($is_plan_active) ? 'navlog_check_revise' : '';
                 $encoded = '';
                 $cancel_disabled = ($plan_status == 1) ? '' : 'disabled="disabled"';
                 $gmt_time = gmdate('Hi');
                 $is_change_allowed = '';
                 $date_of_flight_display = date('d-M', strtotime($date_of_flight));
                 $date_of_flight_notams = date('d-M-Y', strtotime($date_of_flight));
                 $row[] = array(
                                 'slv' => $result_count,
                                  'id'=>  $res->id,
                                  'plan_status'=>$is_plan_active,
                                  'flight_date' =>  $date_of_flight_display,
                                  'from'=>$res->departure,
                                  'to'=>$res->destination,
                                  'callsign'=>$res->callsign,
                                  'dep_time'=>$res->dep_time,
                                  'fic'=>$fic,
                                  'adc'=>$adc,
                                  'is_fic_active'=>$is_fic_active,
                                  'departure_station'=>$departure_station,
                                  'destination_station'=>$destination_station
                                  );  
                  $result_count--;
          }   
          return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$row),200);   
       } 
       public function navlog_filter(Request $request){
          /*
             Disable for previous Date Record is Pending
          */
           $id=JWTAuth::parseToken()->authenticate()->id;
           $iTotal=Navlog::where('user_id', $id)->count(); 
           $builder = Navlog::query();
           $builder_count = Navlog::query();
           $result = $builder->where('user_id',$id)->get();
           if($request->has('aircraft_callsign')){
                 $builder->where('callsign','like',"%$request->aircraft_callsign");
                 $builder_count->where('callsign','like',"%$request->aircraft_callsign");       
           }
           if($request->has('departure_aerodrome')){
                $builder->where(function($query) use ($request){
                     $query->where('departure','like',"%$request->departure_aerodrome%")
                           ->orWhere('dept_place','like',"%$request->departure_aerodrome%");
               });   
               $builder_count->where(function($query_count) use ($request){
                     $query_count->where('departure','like',"%$request->departure_aerodrome%")
                                 ->orWhere('dept_place','like',"%$request->departure_aerodrome%");
               });     
           }
           if($request->has('destination_aerodrome')){
               $builder->where(function($query) use ($request){
                     $query->where('destination','like',"%$request->destination_aerodrome%")
                           ->orWhere('dest_place','like',"%$request->destination_aerodrome%");
               });     
               $builder_count->where(function($query_count) use ($request){
                     $query_count->where('destination','like',"%$request->departure_aerodrome%")
                                 ->orWhere('dest_place','like',"%$request->departure_aerodrome%");
               });        
           }
          $result = $builder->where('user_id', $id)->where('live_test_mode',1)->orderBy('flight_date', 'desc')->orderBy('dep_time', 'desc')->get();
          $result_count = $builder_count->where('user_id', $id)->where('live_test_mode',1)->orderBy('flight_date', 'desc')->orderBy('dep_time', 'desc')->count();
          $is_admin = $this->is_admin;
          $output=array();
          $row = array();
          foreach($result as $res) 
          {       
                 $id = $res->id;
                 $date_of_flight = $res->flight_date;
                 $aircraft_callsign = $res->callsign;
                 $departure_aerodrome = $res->departure;
                 $destination_aerodrome = $res->destination;
                 $departure_time_hours = substr($res->dep_time,0,2);
                 $departure_time_minutes =substr($res->dep_time,2,2);
                 $fic = $res->fic;
                 $adc = $res->adc;
                 $plan_status = $res->plan_status;
                 $plan_status_class = ($plan_status == 2) ? "company_color" : 'text-black';
                 $current_date = date('Ymd');
                 $is_plan_active = '';
                 $is_fic_active = '';
                 $background_white = '';
                 if ($date_of_flight >= $current_date && $plan_status == 1) {
                     $is_plan_active = 1;
                 }
                 if ($date_of_flight == $current_date && $plan_status == 1 && $is_admin) {
                     $is_fic_active = '1';
                     $background_white = ($fic && $adc) ? '' : 'background-white';
                 }
                 $cursor_disable = ($is_plan_active) ? '' : 'cursor_disable';
                 $departure_station = '';
                 $destination_station = '';
                 $tooltip_cancel = '';
                 $tooltip_cancel2 = '';

                 if (($departure_aerodrome == 'ZZZZ' && $destination_aerodrome == 'ZZZZ') || ($plan_status == 2)) {
                     $notam_cursor_disable = "style='cursor:not-allowed !important;'";
                     $fpl_notams = "";
                 } else {
                     $notam_cursor_disable = "style='cursor:pointer !important;'";
                     $fpl_notams = "fpl_notams";
                 }
                 if ($departure_aerodrome == 'ZZZZ') {
                     $tooltip_cancel = 'tooltip_cancel';
                 }
                 if ($destination_aerodrome == 'ZZZZ') {
                     $tooltip_cancel2 = 'tooltip_cancel';
                 }

                 if ($departure_aerodrome == 'ZZZZ') {
                     $departure_aerodrome = substr($res->dept_place, 0, 16);
                     $departure_station = $res->dept_place;
                 }
                 if ($destination_aerodrome == 'ZZZZ') {
                     $destination_aerodrome = substr($res->dest_place, 0, 16);
                     $destination_station = $res->dest_place;
                 }

                 if ($is_plan_active) {
                     $fdtl_popup = "fdtl_popup";
                 } else {
                     $fdtl_popup = "";
                 }
                 $hi = gmdate('Hi');
                 $cursor_disable = ($is_plan_active) ? "" : "style='cursor:not-allowed !important;'";
                 $fic_cursor_disable = ($is_fic_active) ? "" : "style='cursor:not-allowed !important;'";
                 $fic_disabled = ($is_fic_active) ? '' : 'disabled="disabled"';
                 $fic_readonly = ($fic) ? 'readonly=readonly' : '';
                 $adc_readonly = ($adc) ? 'readonly=readonly' : '';
                 $check_revise = ($is_plan_active) ? 'navlog_check_revise' : '';
                 $encoded = '';
                 $cancel_disabled = ($plan_status == 1) ? '' : 'disabled="disabled"';
                 $gmt_time = gmdate('Hi');
                 $is_change_allowed = '';
                 $date_of_flight_display = date('d-M', strtotime($date_of_flight));
                 $date_of_flight_notams = date('d-M-Y', strtotime($date_of_flight));
                 $row[] = array(
                                 'slv' => $result_count,
                                  'id'=>  $res->id,
                                  'plan_status'=>$is_plan_active,
                                  'flight_date' =>  $date_of_flight_display,
                                  'from'=>$res->departure,
                                  'to'=>$res->destination,
                                  'callsign'=>$res->callsign,
                                  'dep_time'=>$res->dep_time,
                                  'fic'=>$fic,
                                  'adc'=>$adc,
                                  'is_fic_active'=>$is_fic_active,
                                  'departure_station'=>$departure_station,
                                  'destination_station'=>$destination_station
                                  );  
                  $result_count--;
          }   
          return response()->json(array('SUCCESS' => true,'STATUS_CODE' => '200','data'=>$row),200);   
       } 
}