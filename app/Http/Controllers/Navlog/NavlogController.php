<?php

namespace App\Http\Controllers\Navlog;
use App\myfolder\myFunction;
use Illuminate\Http\Request;
use App\Jobs\DelayEmailJob;
use App\Jobs\Navlog\NavlogSpeedChangeEmailJob;
use App\Jobs\Navlog\NavlogALTChangeEmailJob;
use App\Jobs\CancelEmailJob;
use App\Jobs\Navlog\NavlogOtherChangeEmailJob;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Navlog;
use App\models\Navlogmaster;
use App\models\FlightPlanDetailsModel;
use App\Jobs\FICADCEmailJob;
use Auth;
use DB;
use App\models\CallsignInfoModel;
use App\models\Route;
use DateTime;
use Log;
use Response;
use Crypt;
use PDF;
use Storage;
use File;
use App\models\WatchHoursModel;
class NavlogController extends Controller
{
    
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
    public $user_callsigns;

    public function __construct() {
        // $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        // $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
        $this->user_id = Auth::user()->id;
        $this->user_name = Auth::user()->name;
        $this->user_email = Auth::user()->email;
        $this->is_admin = Auth::user()->is_admin;
        $this->user_callsigns = Auth::user()->user_callsigns;
        $this->user_role_id = Auth::user()->user_role_id;
    }
    public function index(Request $request){
      for($navlog=1;$navlog<=6;$navlog++){
              $request->session()->forget('navlog'.$navlog);  
       }       
      return view('navlog.index');
    }
    public function test_index(Request $request){
      for($navlog=1;$navlog<=6;$navlog++){
              $request->session()->forget('navlog'.$navlog);  
       }       
      return view('navlog.test');
    }
    public function AutoSuggest()
     {
         $airports = DB::table('airport_list')->get();
         foreach ($airports as $airport) {
          $data[]=$airport->airport_code;
         }
          return json_encode($data);
     }
    public function pending_cancelled_completed(Request $request){ 
       $live_test_mode=$request->live_test_mode;
       $from_date=date('Ymd', strtotime($request->from_date));
       $to_date=date('Ymd', strtotime($request->to_date));
       $pending_builder = Navlog::query();
       $cancelled_builder = Navlog::query();
       if($this->user_role_id !=1 && $this->user_role_id !=2){
          $pending_builder->where('user_id',Auth::user()->id);
          $cancelled_builder->where('user_id',Auth::user()->id);
       }  
       if($live_test_mode==1)
        $pending=$pending_builder->where('plan_status',1)->where('live_test_mode',
        $live_test_mode)->whereNotIn('callsign', ['TESTA','TESTX'])->where('flight_date','>=',$from_date)->where('flight_date','<=',$to_date)->count();
       else
        $pending=$pending_builder->where('plan_status',1)->where('live_test_mode',
        $live_test_mode)->where('flight_date','>=',$from_date)->where('flight_date','<=',$to_date)->count();

       $cancelled=$cancelled_builder->where('plan_status',2)->where('live_test_mode',
        $live_test_mode)->where('flight_date','>=',$from_date)->where('flight_date','<=',$to_date)->count();
       return response()->json(array('success' => true,'pending'=>$pending,'cancelled'=>$cancelled),200);
    }
    public function get_filter_data(Request $request) {
        $clicked_btn = $request->clicked_btn;
        return view('navlog.filter_quick_plan', ['clicked_btn' => $clicked_btn]);
    }
    public function get_test_filter_data(Request $request) {
        $clicked_btn = $request->clicked_btn;
        return view('navlog.test_filter_quick_plan', ['clicked_btn' => $clicked_btn]);
    }
    public function store_backup(Request $request)
    {
        $navlog_exist=Navlog::where('flight_date',date('Ymd',strtotime($request->flight_date)))->where('callsign',strtoupper($request->callsign))->where('departure',$request->departure)->where('destination',strtoupper($request->destination))->where('dep_time',$request->dep_time)->where('plan_status',1)->where('live_test_mode',1)->count();
        if($navlog_exist>0){
          return response()->json(array('success' => false,'message' =>"Plan Already Exist"),200); 
        }
        $request->session()->put($request->section,$request->all());
        $date=array();
        $current_month_year=strtoupper(date('My'));
        if($request->btnvalue=='SUBMIT'){
            $no_of_flight=$request->no_of_flight;
            $callsign=$request->callsign;
            $navlog_count=Navlog::where('live_test_mode',1)->where('callsign',$callsign)->where('filed_date',$current_month_year)->count();
            for($navlog=1;$navlog<=$request->no_of_flight;$navlog++){
                  $navlog_count++;
                  if(strlen($navlog_count)==1)
                    $prefix='00';
                  else if(strlen($navlog_count)==2)
                    $prefix='0';
                  else 
                    $prefix='';
                  $navlog_serial_no=strtoupper(substr($callsign,2)).'-'.$current_month_year.'-L'.$prefix.$navlog_count;
                  $data=$request->session()->get('navlog'.$navlog);
                  $data['navlog_no']=$navlog_serial_no;
                  $request->session()->put('navlog'.$navlog,$data);
                  if(isset($data)){
                      if($navlog==1){
                       $first_navlog_callsign=strtoupper($data['callsign']);
                       if(isset($data['registration']))
                        $first_navlog_registration=strtoupper($data['registration']);
                       else
                        $first_navlog_registration='';
                      }
                      $dep=strtoupper($data['departure']);
                      $des=strtoupper($data['destination']);
                      if($data['departure']=='zzzz'|| $data['departure']=='ZZZZ') 
                        $dep=$data['dept_place'];
                      if($data['destination']=='zzzz'|| $data['destination']=='ZZZZ') 
                        $des=$data['dest_place'];
                      $plans[]=array($dep,$des,strtoupper($data['flight_date']));
                      $date[]=strtoupper($data['flight_date']); 
                      $result=[
                          'user_id'=>$data['user_id'],
                          'aircraft_callsign'=>strtoupper($data['callsign']),
                          'departure_aerodrome'=>$data['departure'],
                          'destination_aerodrome'=>$data['destination'],
                          'departure_time_hours'=>$data['hhdept_time'],
                          'departure_time_minutes'=>$data['mmdept_time'],
                          'date_of_flight'=>date('ymd',strtotime($data['flight_date'])),
                          'departure_station'=>isset($data['dept_place']) ? strtoupper($data['dept_place']) : NULL,
                          'destination_station'=>isset($data['dest_place']) ?strtoupper($data['dest_place']) : NULL,
                          'pilot_in_command'=>strtoupper(trim($data['pilot'])),       
                          'mobile_number'=>$data['mobile'],
                          'copilot'=>strtoupper(trim($data['co_pilot'])),
                          'departure_latlong'=>isset($data['dept_lat']) ? strtoupper($data['dept_lat']) : NULL,
                          'destination_latlong'=>isset($data['dept_lat']) ? strtoupper($data['dept_lat']) : NULL,
                          'crushing_speed'=>isset($data['speed']) ? strtoupper($data['speed']) : NULL,
                          'flight_level'=>$data['level1'],
                          'route'=>strtoupper($data['main_route']),
                          'take_off_altn'=>strtoupper($data['take_off_alternate']),
                          'first_alternate_aerodrome'=>strtoupper($data['alternate1']),
                          'second_alternate_aerodrome'=>strtoupper($data['alternate2']),
                          'remarks'=>strtoupper(trim($data['remarks'])),
                          'registration'=>strtoupper($data['registration']),
                          'route_altn'=>strtoupper($data['alternate1route']),
                          'pax'=>strtoupper($data['pax']),
                          'load'=>strtoupper($data['load']),
                          'min_max'=>strtoupper($data['min_max']),
                          'deptime_ist'=>strtoupper($data['deptime_ist']),
                          'cabin'=>isset($data['cabin']) ? $data['cabin'] : NULL,
                          'level2'=>strtoupper($data['level2']),
                          'level3'=>strtoupper($data['level3']),
                          'level4'=>strtoupper($data['level4']),
                          'dep_airport_name'=>strtoupper($data['dep_airport_name']),
                          'dest_airport_name'=>strtoupper($data['dest_airport_name']), 
                          'alt1_airport_name'=>strtoupper($data['alt1_airport_name']),
                          'alt2_airport_name'=>strtoupper($data['alt2_airport_name']),
                          'toff_airport_name'=>strtoupper($data['toff_airport_name']),
                          'live_test_mode'=>$data['live_test_mode'], 
                          'alternate1route'=>strtoupper($data['alternate1route']),
                          'alternate2route'=>strtoupper($data['alternate2route']),
                          'take_off_alternate_route'=>strtoupper($data['take_off_alternate_route']),
                          'fuel'=>$data['fuel'],
                          'filed_date'=>date('Y-m-d H:i:s'),
                      ];
                      FlightPlanDetailsModel::create($result);
                      // Navlog::create(array_merge($data,['filed_date'=>$current_month_year]));
                   } 
            }
            $flight_date_unique=array_unique($date);
            $flight_date_count=count($flight_date_unique);

            $implode_fl_date=implode(" & ",$flight_date_unique);
            $pdfname=$implode_fl_date.'_'.$first_navlog_callsign.'_NAV LOG REQUEST.pdf';
            $fpl_count=FlightPlanDetailsModel::count()+1;
            $path = public_path('media/pdf/navlog/'.$fpl_count);
            $result = File::makeDirectory($path);
            $pdf = PDF::loadView('navlog.pdf',compact('no_of_flight'))->save($path.'/'.$pdfname); 
            $date_of_flight = date('d-M-Y');
            $data['email'] = $this->user_email;
            $data['subject'] = $first_navlog_callsign." NAV LOG REQUEST // $implode_fl_date";
            $data['dof'] = $implode_fl_date; 
            $data['count_date']=$flight_date_count;
            $data['file_path']=$path.'/'.$pdfname;
            $data['folder_path']=$path;
            $data['pdf_name']=$pdfname;
            $data['plans']=$plans;
            $data['title']='NAV LOG REQUEST';
            $data['registration']=$first_navlog_registration;
            $data['username']=$this->user_name;
            dispatch(new \App\Jobs\Navlog\NavlogJob($data));
        }
        return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully"),200); 
    }
    public function store(Request $request)
    {
        $navlog_exist=Navlog::where('flight_date',date('Ymd',strtotime($request->flight_date)))->where('callsign',strtoupper($request->callsign))->where('departure',$request->departure)->where('destination',strtoupper($request->destination))->where('dep_time',$request->dep_time)->where('plan_status',1)->where('live_test_mode',1)->count();
        if($navlog_exist>0){
          return response()->json(array('success' => false,'message' =>"Plan Already Exist"),200); 
        }
        $request->session()->put($request->section,$request->all());
        $date=array();
        $current_month_year=strtoupper(date('My'));
        $filed_date=date('Y-m-d H:i:s');
        if($request->btnvalue=='SUBMIT'){
            $no_of_flight=$request->no_of_flight;
            $callsign=$request->callsign;
            $navlog_count=Navlog::where('live_test_mode',1)->where('callsign',$callsign)->where('filed_date',$current_month_year)->count();
            for($navlog=1;$navlog<=$request->no_of_flight;$navlog++){
                  $navlog_count++;
                  if(strlen($navlog_count)==1)
                    $prefix='00';
                  else if(strlen($navlog_count)==2)
                    $prefix='0';
                  else 
                    $prefix='';
                  $navlog_serial_no=strtoupper(substr($callsign,2)).'-'.$current_month_year.'-L'.$prefix.$navlog_count;
                  $data=$request->session()->get('navlog'.$navlog);
                  $data['navlog_no']=$navlog_serial_no;
                  $request->session()->put('navlog'.$navlog,$data);
                  if(isset($data)){
                      if($navlog==1){
                       $navlog_master=NavlogMaster::create();
                       $first_navlog_callsign=strtoupper($data['callsign']);
                       if(isset($data['registration']))
                        $first_navlog_registration=strtoupper($data['registration']);
                       else
                        $first_navlog_registration='';
                      }
                      $dep=strtoupper($data['departure']);
                      $des=strtoupper($data['destination']);
                      if($data['departure']=='zzzz'|| $data['departure']=='ZZZZ') 
                        $dep=$data['dept_place'];
                      if($data['destination']=='zzzz'|| $data['destination']=='ZZZZ') 
                        $des=$data['dest_place'];
                      $plans[]=array($dep,$des,strtoupper($data['flight_date']));
                      $date[]=strtoupper($data['flight_date']); 
                      $data['navlog_masterid']=$navlog_master->id;
                      $data['filed_date']=$filed_date;
                      $result=$this->get_flight_details($data);
                      if(isset($result))
                       Navlog::create(array_merge($data,$result));
                      else
                       Navlog::create($data); 
                   } 
            }
            $flight_date_unique=array_unique($date);
            $flight_date_count=count($flight_date_unique);
            $implode_fl_date=implode(" & ",$flight_date_unique);
            $pdfname=$implode_fl_date.'_'.$first_navlog_callsign.'_NAV LOG REQUEST.pdf';
            $path = public_path('media/pdf/navlog/'.$navlog_master->id);
            $result = File::makeDirectory($path);
            $pdf = PDF::loadView('navlog.pdf',compact('no_of_flight'))->save($path.'/'.$pdfname); 
            $date_of_flight = date('d-M-Y');
            $data['email'] = $this->user_email;
            $data['subject'] = $first_navlog_callsign." NAV LOG REQUEST // $implode_fl_date";
            $data['dof'] = $implode_fl_date; 
            $data['count_date']=$flight_date_count;
            $data['file_path']=$path.'/'.$pdfname;
            $data['folder_path']=$path;
            $data['pdf_name']=$pdfname;
            $data['plans']=$plans;
            $data['title']='NAV LOG REQUEST';
            $data['registration']=$first_navlog_registration;
            $data['username']=$this->user_name;
            dispatch(new \App\Jobs\Navlog\NavlogJob($data));
        }
        return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully"),200); 
    }
    public  function get_flight_details($data) {
        $result=array();
        $aircraft_callsign = $data['callsign'];
        $departure_aerodrome = $data['departure'];
        $destination_aerodrome = $data['departure'];
        $fpl_details = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                ->where('departure_aerodrome', $departure_aerodrome)
                ->where('destination_aerodrome', $destination_aerodrome)
                ->where('plan_status', '1')
                ->orderBy('id', 'desc')
                ->orderBy('date_of_flight', 'desc')
                ->orderBy('departure_time_hours', 'desc')
                ->orderBy('departure_time_minutes', 'desc')
                ->first();
         if(isset($fpl_details)){
           $result=[
                 'flight_rules'=>$fpl_details->flight_rules,
                 'flight_type'=>$fpl_details->flight_type,
                 'aircraft_type'=>$fpl_details->aircraft_type,
                 'weight_category'=>$fpl_details->weight_category,
                 'equipment'=>$fpl_details->equipment,
                 'transponder'=>$fpl_details->transponder,
                 'crushing_speed_indication'=>$fpl_details->crushing_speed_indication,
                 'flight_level_indication'=>$fpl_details->flight_level_indication,
                 'flying_time'=>$fpl_details->total_flying_hours.$fpl_details->total_flying_minutes,
                 'endurance_hours'=>$fpl_details->endurance_hours,
                 'endurance_minutes'=>$fpl_details->endurance_minutes,
                 'indian'=>$fpl_details->indian,
                 'foreigner'=>$fpl_details->foreigner,
                 'foreigner_nationality'=>$fpl_details->foreigner_nationality,
                 'operator'=>$fpl_details->operator,
                 'cabincrew'=>$fpl_details->cabincrew,
                 'sel'=>$fpl_details->sel,
                 'fir_crossing_time'=>$fpl_details->fir_crossing_time,
                 'pbn'=>$fpl_details->pbn,
                 'nav'=>$fpl_details->nav,
                 'code'=>$fpl_details->code,
                 'per'=>$fpl_details->per,
                 'tcas'=>$fpl_details->tcas,
                 'credit'=>$fpl_details->credit,
                 'no_credit'=>$fpl_details->no_credit,
                 'emergency_uhf'=>$fpl_details->emergency_uhf,
                 'emergency_vhf'=>$fpl_details->emergency_vhf,
                 'emergency_elba'=>$fpl_details->emergency_elba,
                 'polar'=>$fpl_details->polar,
                 'desert'=>$fpl_details->desert,
                 'maritime'=>$fpl_details->maritime,
                 'jungle'=>$fpl_details->jungle,
                 'light'=>$fpl_details->light,
                 'floures'=>$fpl_details->floures,
                 'jacket_uhf'=>$fpl_details->jacket_uhf,
                 'jacket_vhf'=>$fpl_details->jacket_vhf,
                 'number'=>$fpl_details->number,
                 'capacity'=>$fpl_details->capacity,
                 'cover'=>$fpl_details->cover,
                 'color'=>$fpl_details->color,
                 'aircraft_color'=>$fpl_details->aircraft_color,
                 'route_altn'=>$fpl_details->route_altn,
                 'alternate_station'=>$fpl_details->alternate_station,
           ];
         }        
        return $result;
    }
        public function file_plan(Request $request) {
            try {
                $id = $request->id;
                $fpl_details = Navlog::where('id', $id)->first();
                $aircraft_callsign = ($fpl_details) ? $fpl_details->callsign : '';
                $departure_aerodrome = ($fpl_details) ? $fpl_details->departure : '';
                $destination_aerodrome = ($fpl_details) ? $fpl_details->destination : '';
                $equipment = ($fpl_details) ? $fpl_details->equipment : '';
                $departure_time_hours = ($fpl_details) ? substr($fpl_details->dep_time,0,2) : '';
                $departure_time_minutes = ($fpl_details) ? substr($fpl_details->dep_time,2,2) : '';
                $flight_rules = ($fpl_details) ? $fpl_details->flight_rules : '';
                $flight_type = ($fpl_details) ? $fpl_details->flight_type : '';
                $aircraft_type = ($fpl_details) ? $fpl_details->aircraft_type : '';
                $weight_category = ($fpl_details) ? $fpl_details->weight_category : '';
                $crushing_speed_indication = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
                if(isset($fpl_details->speed))
                 $crushing_speed = $fpl_details->speed;
                else
                 $crushing_speed = $fpl_details->txtspeed;  
                // $crushing_speed = ($fpl_details) ? $fpl_details->speed : '';
                $flight_level_indication = ($fpl_details) ? $fpl_details->flight_level_indication : '';
                $flight_level = ($fpl_details) ? $fpl_details->level1 : '';
                $route = ($fpl_details) ? $fpl_details->main_route : '';
                $total_flying_hours = ($fpl_details) ? substr($fpl_details->flying_time,0,2) : '';
                $total_flying_minutes = ($fpl_details) ? substr($fpl_details->flying_time,2,2) : '';
                $first_alternate_aerodrome = ($fpl_details) ? $fpl_details->alternate1 : '';
                $second_alternate_aerodrome = ($fpl_details) ? $fpl_details->alternate2 : '';
                $endurance_hours = ($fpl_details) ? $fpl_details->endurance_hours : '';
                $endurance_minutes = ($fpl_details) ? $fpl_details->endurance_minutes : '';
                $tbn = 'TBN';
                $number = ($fpl_details) ? $fpl_details->number : '';
                $capacity = ($fpl_details) ? $fpl_details->capacity : '';
                $color = ($fpl_details) ? $fpl_details->color : '';
                $aircraft_color = ($fpl_details) ? $fpl_details->aircraft_color : '';
                $remarks = ($fpl_details) ? $fpl_details->remarks : '';
                $pilot_in_command = ($fpl_details) ? $fpl_details->pilot : '';
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
                $departure_latlong = ($fpl_details) ? $fpl_details->dept_lat : '';
                $departure_station = ($fpl_details) ? $fpl_details->dept_place : '';
                $destination_latlong = ($fpl_details) ? $fpl_details->dest_lat : '';
                $destination_station = ($fpl_details) ? $fpl_details->dest_place : '';
                $date_of_flight = ($fpl_details) ? substr($fpl_details->flight_date,2) : '';
                $registration = ($fpl_details) ? $fpl_details->registration : '';
                $fir_crossing_time = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
                $sel = ($fpl_details) ? $fpl_details->sel : '';
                $code = ($fpl_details) ? $fpl_details->code : '';
                $operator = ($fpl_details) ? $fpl_details->operator : '';
                $per = ($fpl_details) ? $fpl_details->per : '';
                $route_altn = ($fpl_details) ? $fpl_details->route_altn : '';
                $take_off_altn = ($fpl_details) ? $fpl_details->take_off_alternate : '';
                $alternate_station = ($fpl_details) ? $fpl_details->alternate_station : '';
                $remarks_value = ($fpl_details) ? $fpl_details->remarks : '';
                $credit = ($fpl_details) ? $fpl_details->credit : '';
                $pilot_in_command = ($fpl_details) ? $fpl_details->pilot : '';
                $indian = ($fpl_details) ? $fpl_details->indian : '';
                $foreigner = ($fpl_details) ? $fpl_details->foreigner : '';
                $foreigner_nationality = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
                $mobile_number = ($fpl_details) ? $fpl_details->mobile : '';
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
                $station_addresses_data = myFunction::station_addresses($departure_aerodrome,$destination_aerodrome);
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

    public function test_store(Request $request)
    {
        $navlog_exist=Navlog::where('flight_date',date('Ymd',strtotime($request->flight_date)))->where('callsign',strtoupper($request->callsign))->where('departure',$request->departure)->where('destination',strtoupper($request->destination))->where('dep_time',$request->dep_time)->where('plan_status',1)->where('live_test_mode',2)->count();
        if($navlog_exist>0){
          return response()->json(array('success' => false,'message' =>"Plan Already Exist"),200); 
        }
        $request->session()->put($request->section,$request->all());
        $date=array();
        $current_month_year=strtoupper(date('My'));
        if($request->btnvalue=='SUBMIT'){
            $callsign=$request->callsign;
            $navlog_count=Navlog::where('live_test_mode',2)->where('callsign',$callsign)->where('filed_date',$current_month_year)->count(); 
            $no_of_flight=$request->no_of_flight;
            for($navlog=1;$navlog<=$request->no_of_flight;$navlog++){
                  $navlog_count++;
                  if(strlen($navlog_count)==1)
                    $prefix='00';
                  else if(strlen($navlog_count)==2)
                    $prefix='0';
                  else 
                    $prefix='';
                  $navlog_serial_no=strtoupper(substr($callsign,2)).'-'.$current_month_year.'-T'.$prefix.$navlog_count;
                  $data=$request->session()->get('navlog'.$navlog);
                  $data['navlog_no']=$navlog_serial_no;
                  $request->session()->put('navlog'.$navlog,$data);
                  if(isset($data)){
                      if($navlog==1){
                       $navlog_master=NavlogMaster::create();
                       $first_navlog_callsign=strtoupper($data['callsign']);
                       if(isset($data['registration']))
                        $first_navlog_registration=strtoupper($data['registration']);
                       else
                        $first_navlog_registration='';
                      }
                      $dep=strtoupper($data['departure']);
                      $des=strtoupper($data['destination']);
                      if($data['departure']=='zzzz'|| $data['departure']=='ZZZZ') 
                        $dep=$data['dept_place'];
                      if($data['destination']=='zzzz'|| $data['destination']=='ZZZZ') 
                        $des=$data['dest_place'];
                      $plans[]=array($dep,$des,strtoupper($data['flight_date']));
                      $date[]=strtoupper($data['flight_date']); 
                      Navlog::create(array_merge($data,['navlog_masterid' =>$navlog_master->id,'filed_date'=>$current_month_year]));
                   } 
            }
            $flight_date_unique=array_unique($date);
            $flight_date_count=count($flight_date_unique);
            $implode_fl_date=implode(" & ",$flight_date_unique);
            $pdfname='TEST PLAN REQUEST_'.$first_navlog_callsign.'_'.$implode_fl_date.'.pdf';
            $path = public_path('media/pdf/navlog/'.$navlog_master->id);
            $result = File::makeDirectory($path);
            $pdf = PDF::loadView('navlog.test_pdf',compact('no_of_flight'))->save($path.'/'.$pdfname); 
            $date_of_flight = date('d-M-Y');
            $data['email'] = $this->user_email;
            $data['subject'] = 'TEST PLAN '.$first_navlog_callsign." REQUEST // $implode_fl_date";
            $data['dof'] = $implode_fl_date; 
            $data['count_date']=$flight_date_count;
            $data['file_path']=$path.'/'.$pdfname;
            $data['folder_path']=$path;
            $data['pdf_name']=$pdfname;
            $data['plans']=$plans;
            $data['title']='TEST PLAN REQUEST';
            $data['registration']=$first_navlog_registration;
            $data['username']=$this->user_name;
            dispatch(new \App\Jobs\Navlog\NavlogTestJob($data));
        
        }
        return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully"),200); 
    }
    public function update(Request $request)
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
             if($navlog_data->min_max!=$request->min_max||$navlog_data->fuel!=$request->fuel||$navlog_data->pax!=$request->pax||$navlog_data->load!=$request->load||$navlog_data->pilot!=$request->pilot||$navlog_data->mobile!=$request->mobile||$navlog_data->co_pilot!=   $request->co_pilot||$navlog_data->cabin!=$request->cabin||$navlog_data->remarks!=$request->remarks||$navlog_data->take_off_alternate!=$request->take_off_alternate||$navlog_data->level4!=$request->level4||$navlog_data->take_off_alternate_route!=$request->take_off_alternate_route||$navlog_data->level2!=$request->level2||$navlog_data->alternate1route!=$request->alternate1route||$navlog_data->level3!=$request->level3||$navlog_data->alternate2route!=$request->alternate2route||$navlog_data->paxs!=$request->paxs){
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
            
            return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully",'updated'=>$updated),200);  
           }
           return response()->json(array('success' => true,'message' =>"Navlog Updated Successfully",'updated'=>$updated),200);
    }
    public function test_update(Request $request)
    {       
            $field=array();
            $updated=false;
            $navlog_id=$request->navlog_id;
            $navlog_data=Navlog::find($navlog_id);
             if($navlog_data->min_max!=$request->min_max||$navlog_data->fuel!=$request->fuel||$navlog_data->pax!=$request->pax||$navlog_data->load!=$request->load||$navlog_data->remarks!=$request->remarks||$navlog_data->paxs!=$request->paxs||$navlog_data->dep_time!=$request->dep_time){
                $this->other_test_changes($request->all());    
             } 
            if($navlog_data->min_max!=$request->min_max||$navlog_data->fuel!=$request->fuel||$navlog_data->pax!=$request->pax||$navlog_data->load!=$request->load||$navlog_data->remarks!=$request->remarks||$navlog_data->dep_time!=$request->dep_time){
               if($navlog_data->fuel!=$request->fuel && $request->fuel!=''){
                  Navlog::find($navlog_id)->update(array_merge($request->all(),['min_max' =>0])); 
                }
                else
                  Navlog::find($navlog_id)->update($request->all()); 
            $updated=true;          
            
            return response()->json(array('success' => true,'message' =>"Test Navlog Updated Successfully",'updated'=>$updated),200);  
           }
           return response()->json(array('success' => true,'message' =>"Test Navlog Updated Successfully",'updated'=>$updated),200);
    }
    public function AirportName(Request $request){
       $airport_code=$request->airport_code; 
       $airport= DB::table('airport_list')->where('airport_code',$airport_code)->first();
       if(isset($airport))
         $city=$airport->airport_city;
       else
         $city=''; 
       return response()->json(array('success' => true,'airportcity'=>$city),200);
    }
    public function FlyingTime(Request $request)
    {
        $callsign=strtoupper($request->callsign);
        $departure=strtoupper($request->departure);
        $destination=strtoupper($request->destination);
        $result=FlightPlanDetailsModel::where('aircraft_callsign',$callsign)->where('departure_aerodrome',$departure)->where('destination_aerodrome',$destination)->orderBy('id','desc')->where('plan_status',1)->first();
        if(isset($result)){
             $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $result->date_of_flight . " " . $result->departure_time_hours . ":" . $result->departure_time_minutes));
             $res_time2 = gmdate('y-m-d H:i', strtotime('20' .$result->date_of_flight . " " . $result->total_flying_hours . ":" . $result->total_flying_minutes));
             $secs = strtotime($res_time2) - strtotime('20' . $result->date_of_flight . " 00:00");
             $total_time_after_flying = gmdate('ymd:H:i', strtotime($res_time1) + $secs);
             return response()->json(
             array('success' => true,
               'arrival_time'=>strtotime($res_time1) + $secs,
               'total_time_after_flying'=>$total_time_after_flying,
               'total_flying_hours'=>$result->total_flying_hours,
               'total_flying_minutes'=>$result->total_flying_minutes,
               'departure_time_hours'=>$result->departure_time_hours,
               'departure_time_minutes'=>$result->departure_time_minutes,
               'date_of_flight'=>$result->date_of_flight,
               ),200);
        }
        else
              return response()->json(
                 array('success' => true,
                       'arrival_time'=>0,
                       'total_flying_hours'=>0,
                       'total_flying_minutes'=>0,
                       'departure_time_hours'=>0,
                       'departure_time_minutes'=>0,
                       'date_of_flight'=>0
                       ),200);
      
    }
    public function LastflightFlyingTime(Request $request){
     
        $callsign=strtoupper($request->callsign);
        $result=FlightPlanDetailsModel::where('aircraft_callsign',$callsign)->orderBy('id','desc')->where('plan_status',1)->first();

        if(isset($result)){
             $res_time1 = gmdate('y-m-d H:i', strtotime('20' . $result->date_of_flight . " " . $result->departure_time_hours . ":" . $result->departure_time_minutes));
             $res_time2 = gmdate('y-m-d H:i', strtotime('20' .$result->date_of_flight . " " . $result->total_flying_hours . ":" . $result->total_flying_minutes));
             $secs = strtotime($res_time2) - strtotime('20' . $result->date_of_flight . " 00:00");
             $total_time_after_flying = gmdate('ymd:H:i', strtotime($res_time1) + $secs);
             return response()->json(
             array('success' => true,
               'arrival_time'=>strtotime($res_time1) + $secs,
               'total_time_after_flying'=>$total_time_after_flying,
               'total_flying_hours'=>$result->total_flying_hours,
               'total_flying_minutes'=>$result->total_flying_minutes,
               'departure_time_hours'=>$result->departure_time_hours,
               'departure_time_minutes'=>$result->departure_time_minutes,
               'date_of_flight'=>$result->date_of_flight,
               'plan_id'=>$result->id,
               ),200);
        }
        else
              return response()->json(
                 array('success' => true,
                       'arrival_time'=>0,
                       'total_flying_hours'=>0,
                       'total_flying_minutes'=>0,
                       'departure_time_hours'=>0,
                       'departure_time_minutes'=>0,
                       'date_of_flight'=>0
                       ),200);
    }
    public function LastDestination(Request $request)
    {
       $city="";
       $callsign=$request->callsign;
       $date_of_flight=date('Ymd');
       $result=FlightPlanDetailsModel::where('aircraft_callsign',$callsign)->where('date_of_flight','<=',$date_of_flight)->orderBy('date_of_flight', 'desc')->first();
       if(count((array)$result)>0)
          $destination=$result->destination_aerodrome;
        else
          $destination='';
       if($destination!=""){
         $airport= DB::table('airport_list')->where('airport_code',$destination)->first();
         if(isset($airport))
          $city=$airport->airport_city;
        }
      return response()->json(array('success' => true,'destination'=>$destination,'airportcity'=>$city),200);
    }
    public function copilot(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;

            $pilotnames = CallsignInfoModel::pilot_in_command($aircraft_callsign, $term);
            $copilot = CallsignInfoModel::copilot($aircraft_callsign, $term);
            foreach ($pilotnames as $pilot_names) {
                $pilot_results[] = ['value' => $pilot_names->name];
                $pilotnames_array[] = $pilot_names->name;
            }
            foreach ($copilot as $copilot_names) {
                if (!in_array($copilot_names->name, $pilotnames_array)) {
                    $copilot_results[] = ['value' => $copilot_names->name];
                }
            }
            $results = array_values(array_merge($pilot_results, $copilot_results));
            return Response::json($results);
           
        } catch (\Exception $ex) {
            Log::error('Fpl Controller copilot: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller copilot : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }
    public function TimeDiff(Request $request){
       $dept_date=$request->date_of_flight;
       $dept_min=$request->dept_time_min;
       $dept_hr=$request->dept_time_hr; 
       if($dept_min==60){
         $dept_min=00;
         $dept_hr=$dept_hr+1; 
       }
       $d2= new DateTime(); 
       $d1= new DateTime("$dept_date $dept_hr:$dept_min:00");
       $interval= $d1->diff($d2);
       $diff_hours=($interval->days * 24) + $interval->h;
       return response()->json(array('success' => true,'diff_hours'=>$diff_hours),200);
    }
    public function AutofillRoute(Request $request)
    {
       $departure=strtoupper($request->departure);
       $destination=strtoupper($request->destination);
       $callsign=strtoupper($request->callsign);
       $speedlist_count=DB::table('aircraft_speed')->where('callsign',$callsign)->count();
       $route=FlightPlanDetailsModel::where('aircraft_callsign',$callsign)->where('departure_aerodrome',$departure)->where('destination_aerodrome',$destination)->orderBy('id', 'desc')->first();
       if(isset($route)){
          $alternate1=$route->first_alternate_aerodrome;
          $alternate2=$route->second_alternate_aerodrome;
          $take_off_alternate=$route->take_off_altn;
          $alternate1_airport= DB::table('airport_list')->where('airport_code',$alternate1)->first();
          $alternate2_airport= DB::table('airport_list')->where('airport_code',$alternate2)->first();
          $take_off_alternate_airport= DB::table('airport_list')->where('airport_code',$take_off_alternate)->first();
          $data=array(
                    'speedlist_count'=>$speedlist_count,
                    'speed'=>$route->crushing_speed,
                    'main_fl'=>$route->flight_level,
                    'main_route'=>$route->route,
                    'alternate1'=>$route->first_alternate_aerodrome, 
                    'alternate2'=>$route->second_alternate_aerodrome, 
                    'take_off_alternate'=>$route->take_off_altn, 
                    'alternate1_lbl'=>isset($alternate1_airport) ? $alternate1_airport->airport_city:"",
                    'alternate2_lbl'=>isset($alternate2_airport) ? $alternate2_airport->airport_city : "",
                    'take_off_alternate_lbl'=>isset($take_off_alternate_airport) ? $take_off_alternate_airport->airport_city : "",
                    );            
       }
       else{
          $data=array();
       }

       return response()->json(array('success' => true,'data'=>$data),200);
    }
        public function speed_change($data) {

            $change=array();
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
              $txtspeed = strtoupper($data['txtspeed']);
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
                $change['speed_change']=1;
            }
            else{
              $mail_send = 1;
              $crushing_speed =$speed; 
            }
            if ($txtspeed != $navlog_details->txtspeed) {
                $mail_send = 1;
                $txtspeed = "<span style='color:red'>" . $txtspeed . '</span>';
                $change['text_speed_change']=1;
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
                $change['level1_change']=1;
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
                $change['main_route_change']=1;
            }
            elseif($main_route!=""){
               $mail_send = 1;
               $route = "<span>" .' '.$main_route . '</span>';
             }
             else
              $route ='';
            if(count($change))
            Navlog::find($data['navlog_id'])->update($change);
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
            $change=array();
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
            $result=FlightPlanDetailsModel::where('aircraft_callsign',$aircraft_callsign)->where('departure_aerodrome',$departure_aerodrome)->where('destination_aerodrome',$destination_aerodrome)->orderBy('id','desc')->first();
            if($result!=null){
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
                $change['alternate1_change']=1;
            }
            else{
              $mail_send = 1;
              $alternate1 = "<span>".$alternate1.'</span>'; 
            }
            if($alternate2==''){
                $alternate2=''; 
                $mail_send = 1;
             }   
            elseif ($alternate2 != $navlog_details->alternate2) {
                $mail_send = 1;
                $alternate2 = "<span style='color:red'>" . $alternate2 . '</span>';
                $change['alternate2_change']=1;
            }
            else{
               $mail_send = 1;
               $alternate2 = "<span>" . $alternate2 . '</span>';
            }
            $changed_by = $this->user_name;
            if(count($change))
            Navlog::find($data['navlog_id'])->update($change);
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
             if($alternate2!='')
                $data['speed_change_heading'].=' ';
             if ($alternate2!='')
               $data['speed_change_heading'].=$alternate2;

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
            $change=array();
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

            if($fpl_details!=null){
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
               if (strtoupper($data['registration']) !=$navlog_details->registration){
                   $registration = "<span>" ." REG/"."<span style='color:red'>$reg</span>" . '</span>';
                   $change['registration_change']=1;
                  }
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
             
             if ($take_off_altn != $navlog_details->take_off_alternate){ 
                 $take_off_altn = "<span  style='color:red'>" . $take_off_altn . '</span>';
                 $change['take_off_altn_change']=1; 
               }
             else
                 $take_off_altn = "<span>" . $navlog_details->take_off_alternate . '</span>';
             
             if($cabin=='')
                 $cabin ='';
             else if ($cabin != $navlog_details->cabin){ 
                 $cabin = "<span> CABIN NO " . "<span style='color:red'>".$cabin."</span>" . '</span>';
                 $change['cabin_change']=1;  
               }
             else
                 $cabin = "<span> CABIN NO " . $cabin . '</span>';

             if ($pax != $navlog_details->pax){ 
                 $pax = "<span><span style='color:red'> PAX </span>" . "<span style='color:red'>".$pax."</span>" . '</span>';
                 $change['pax_change']=1;  
                } 
             else
                 $pax = "<span> PAX " . $pax . ' </span>';

             if ($cargo != $navlog_details->load){ 
                 $cargo = "<span><span style='color:red'> CARGO </span>" . "<span style='color:red'>".$cargo."</span>" . '</span>';
                $change['load_change']=1;
               }
             else
                 $cargo = "<span> CARGO " . $cargo . '</span>';
             
             if($level2=='')
                 $level2=''; 
             else if ($level2 != $navlog_details->level2){ 
                 $level2 = "<span style='color:red'> ALT1 LEVEL </span>"."<span style='color:red'>".$level2.'</span>';
                 $change['level2_change']=1;
               }
             elseif($navlog_details->level2!="")
                 $level2 = "<span> ALT1 LEVEL ".$level2.'</span>';  
             
             if($alternate1route==''){
                 $alternate1route=''; 
             }     
             else if ($alternate1route != $navlog_details->alternate1route){ 
                 $alternate1route = "<span style='color:red'> ALT1 ROUTE </span>"."<span  style='color:red'>" . $alternate1route.'</span>';
                 $change['alternate1route_change']=1;
               }
             else
                 $alternate1route = "<span> ALT1 ROUTE </span>"."<span>" . $alternate1route.'</span>';

             if($level3==''){
                 $level3=''; 
                 $mail_send = 1;
              }   
             else if ($level3 != $navlog_details->level3) {
                 $level3 = "<span style='color:red'> ALT2 LEVEL </span><span style='color:red'>".$level3 .'</span>';
                 $mail_send = 1;
                 $change['level3_change']=1;
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
                 $change['alternate2route_change']=1;
               }
             else{
                 $mail_send = 1;
                 $alternate2route = "<span>ALT2 ROUTE </span><span>" . $alternate2route . '</span>';
               }    

             
             if($fuel!='')
              {
                   if ($fuel != $navlog_details->fuel){ 
                       $fuel = "<span><span style='color:red'> FUEL </span> " . "<span style='color:red'>".$fuel."</span>" . '</span>';
                       $change['fuel_change']=1;
                     }  
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

                      if ($min_max != $navlog_details->min_max){ 
                       $fuel = "<span><span style='color:red'> FUEL </span> " . "<span style='color:red'>".$min_max_value."</span>" . '</span>';
                      $change['fuel_change']=1;
                      }
                     else
                       $fuel = "<span> FUEL " . $min_max_value . '</span>';        
              }
             if($level4=='')
                 $flight_level=''; 
             else if ($level4 != $navlog_details->level4){ 
                 $level4 = "<span>F" . "<span style='color:red'>".$level4 .'</span></span>';
                 $change['level4_change']=1; 
              }
             elseif($navlog_details->level4!="")
                 $level4 = "<span>" . ' F'.$level4 . '</span>';  

             if ($take_off_alternate_route != $navlog_details->take_off_alternate_route){ 
                 $take_off_alternate_route = "<span  style='color:red'>" . $take_off_alternate_route . '</span>';
                 $change['take_off_alternate_route_change']=1;
                } 
             else
                 $take_off_alternate_route = "<span>" . $take_off_alternate_route . '</span>';
                   

             if ($pilot_in_command != $navlog_details->pilot){ 
                 $pilot_in_command = "<span>"."<span style='color:red'>".$pilot_in_command . "</span>" . '</span>';
                 $change['pilot_change']=1; 
                } 
             else
                 $pilot_in_command = "<span>" . $pilot_in_command. '</span>';

             if ($mobile_number != $navlog_details->mobile){ 
                 $mobile_number = "<span  style='color:red'>" . $mobile_number . '</span>';
                 $change['mobile_change']=1;
               }
             else
                 $mobile_number = "<span>" . $mobile_number. '</span>';

             if ($copilot != $navlog_details->co_pilot){ 
                 $copilot = "<span  style='color:red'>" . $copilot . '</span>';
                 $change['co_pilot_change']=1; 
               }
             else
                 $copilot = "<span>" . $copilot . '</span>'; 

             $tcas_value = ($tcas == 'YES') ? "<span> TCAS EQUIPPED</span>" : '';

             $credit_value = ($credit == "YES") ? "<span> CREDIT FACILITY AVAILABLE WITH AAI </span>" : "<span> NO CREDIT FACILITY</span>";
             
             if ($remarks != $navlog_details->remarks){ 
                 $remarks = "<span  >" . " RMK/"."<span style='color:red'>$remarks</span>" . '</span>';
                 $change['remarks_change']=1;   
              }
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
              if(count($change)>0)
              Navlog::find($data['navlog_id'])->update($change);  
              if ($mail_send) {
                  Log::info("OtherChangeEmailJob Queues Begins2");
                  $this->dispatch(new NavlogOtherChangeEmailJob($data));
                  Log::info("OtherChangeEmailJob Queues Begins2");
              }
              return $mail_send; 
    }  
       public function other_test_changes($data) {
            $change=array();
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
            $date_of_flight = $navlog_details->flight_date;
            $remarks=strtoupper($data['remarks']);
            $pax=$data['pax'];
            $cargo=$data['load'];
            $fuel=$data['fuel'];
            $fpl_details=FlightPlanDetailsModel::where('aircraft_callsign',$aircraft_callsign)->where('departure_aerodrome',$departure_aerodrome)->where('destination_aerodrome',$destination_aerodrome)->orderBy('id','desc')->first();

            if($fpl_details!=null){
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
               if(($departure_time_hours!=$data['hhdept_time'])||($departure_time_minutes!=$data['mmdept_time'])){

                 $change['dep_time_change']=1;
                 $hh=$data['hhdept_time'];
                 $min=$data['mmdept_time'];
                 
                 $time = "<span style='color:red'>$hh$min</span>";
               }
               else{
                 $time = "<span>$departure_time_hours$departure_time_minutes </span>";

              }
              if(isset($data['registration']))
              {
                $reg=strtoupper($data['registration']);
               if (strtoupper($data['registration']) !=$navlog_details->registration){
                   $registration = "<span>" ." REG/"."<span style='color:red'>$reg</span>" . '</span>';
                   $change['registration_change']=1;
                  }
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
             if ($pax != $navlog_details->pax){ 
                 $pax = "<span><span style='color:red'> PAX </span>" . "<span style='color:red'>".$pax."</span>" . '</span>';
                 $change['pax_change']=1;  
                } 
             else
                 $pax = "<span> PAX " . $pax . ' </span>';


             if ($cargo != $navlog_details->load){ 
                 $cargo = "<span><span style='color:red'> CARGO </span>" . "<span style='color:red'>".$cargo."</span>" . '</span>';
                $change['load_change']=1;
               }
             else
                 $cargo = "<span> CARGO " . $cargo . '</span>';
               
             if($fuel!='')
              {
                   if ($fuel != $navlog_details->fuel){ 
                       $fuel = "<span><span style='color:red'> FUEL </span> " . "<span style='color:red'>".$fuel."</span>" . '</span>';
                       $change['fuel_change']=1;
                     }  
                   else
                       $fuel = "<span> FUEL " . $fuel . '</span>';
              }
             else
              {
                   if($data['min_max']!="")
                   {
                      $min_max=$data['min_max'];
                      if($min_max==1)
                        $min_max_value='MIN';
                      elseif($min_max==2)
                        $min_max_value='MAX';
                      elseif($min_max==3)
                        $min_max_value='NO REFUEL';

                      if ($min_max != $navlog_details->min_max){ 
                       $fuel = "<span><span style='color:red'> FUEL </span> " . "<span style='color:red'>".$min_max_value."</span>" . '</span>';
                      $change['fuel_change']=1;
                      }
                     else
                       $fuel = "<span> FUEL " . $min_max_value . '</span>';        
                   }  
              }                  
             $tcas_value = ($tcas == 'YES') ? "<span> TCAS EQUIPPED</span>" : '';
             $credit_value = ($credit == "YES") ? "<span> CREDIT FACILITY AVAILABLE WITH AAI </span>" : "<span> NO CREDIT FACILITY</span>";
             
             if ($remarks != $navlog_details->remarks){ 
                 $remarks = "<span  >" . " RMK/"."<span style='color:red'>$remarks</span>" . '</span>';
                 $change['remarks_change']=1;   
              }
             else
                 $remarks = "<span>" . " RMK/".$remarks . '</span>';
        
              $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
              $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
              $code_value = ($code) ? " CODE/" . $code . "" : '';
              $sel_value = ($sel) ? " SEL/" . $sel . "" : '';

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
                      $time . "-" . $destination_aerodrome . "-DOF/" .date('ymd',strtotime($date_of_flight))
                      . "-18/" . $pbn_value . $nav_value . $registration . $fir_crossing_time_value . $sel_value . $code_value . " OPR/" . $operator  . $remarks . $tcas_value . $credit_value." " . $indian_value . $foreigner_value . $total_endurance ;
                      
              $data['other_changes_heading'].=$pax . $fuel . $cargo . ")";        
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
              if(count($change)>0)
              Navlog::find($data['navlog_id'])->update($change);  
              if ($mail_send) {
                  Log::info("OtherChangeEmailJob Queues Begins2");
                  $this->dispatch(new NavlogOtherChangeEmailJob($data));
                  Log::info("OtherChangeEmailJob Queues Begins2");
              }
              return $mail_send; 
    }    
    public function NoOfPax(Request $request)
    {

       $callsign=$request->callsign;
       $paxs=DB::table('maxfuel_maxpax')->where('callsign',$callsign)->first();
       if(count((array)$paxs)>0){
        for ($i=0;$i<=$paxs->max_pax;$i++) {
            $results[] = ['value' => $i];
        }
        return response()->json($results,200);
       }
       else {
        for ($i=0;$i<=14;$i++) {
            $results[] = ['value' => $i];
        }
        return response()->json($results,200);
       }
    }  
    public function Maxfuel(Request $request)
    {
       $callsign=$request->callsign;
       $maxfuel=DB::table('maxfuel_maxpax')->where('callsign',$callsign)->first();
       //return response()->json(array('success' => true,'data'=>$maxfuel),200);
       if(count((array)$maxfuel)>0)
        return response()->json(array('success' => true,'data'=>$maxfuel),200);
       else 
        return response()->json(array('success' => true,'data'=>999999999),200);
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
       return response()->json(array('success' => true,'data'=>$data),200);
    }  
    public function NavlogPdf()
    {
            $pdfname='30-DEC-2017'.'_'.'VTSSF'.'_NAV LOG REQUEST.pdf';
            $pdf = PDF::loadView('navlog.pdf')->save('pdf/'.$pdfname); 
            //return $pdf->stream($pdfname); 
    }
    public function navlog_list(Request $request){
        $live_test_mode=$request->live_test_mode;
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $offset =intval($_GET['iDisplayStart']);
            $limit=intval($_GET['iDisplayLength']);
        }
        $iTotal_builder=Navlog::query(); 
        $builder = Navlog::query();
        $builder_count = Navlog::query();
        $cancel='cancel';
        $change_plan='change_plan';
        if($request->clicked_btn=='3rd'){  // pending
           $builder->where('plan_status',1)->whereNotIn('callsign', ['TESTA','TESTX']);
           $builder_count->where('plan_status',1)->whereNotIn('callsign', ['TESTA','TESTX']);
           $cancel='pending_cancel';
           $change_plan='pending_change_plan';
           $iTotal_builder->where('plan_status',1)->whereNotIn('callsign', ['TESTA','TESTX']);
        }
         else if($request->clicked_btn=='4th'){   //completed
           $builder->where('plan_status',3);
           $builder_count->where('plan_status',3);
           $iTotal_builder->where('plan_status',3);
        }
        else if($request->clicked_btn=='5th'){   //cancelled
           $builder->where('plan_status',2);
           $builder_count->where('plan_status',2);
           $iTotal_builder->where('plan_status',2);
        }
        else{
          $builder->where('plan_status',1);
          $builder_count->where('plan_status',1);
          $iTotal_builder->where('plan_status',1);
        }
        if($request->has('from_date') && $request->has('to_date')){
             $builder->where('flight_date','>=',date('Ymd', strtotime($request->from_date)))
                     ->where('flight_date','<=',date('Ymd', strtotime($request->to_date)));
             $builder_count->where('flight_date','>=',date('Ymd', strtotime($request->from_date)))
                     ->where('flight_date','<=',date('Ymd', strtotime($request->to_date)));        
        }
        if($request->has('flight_date'))
        {
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

       if($this->user_role_id !=1 && $this->user_role_id !=2){
          $builder->where('user_id',Auth::user()->id);
          $builder_count->where('user_id',Auth::user()->id);

          $iTotal_builder->where('user_id',Auth::user()->id);
       } 
       $result = $builder->offset($offset)->limit($limit)->where('live_test_mode',$live_test_mode)->orderBy('flight_date', 'desc')->orderBy('dep_time', 'desc')->get();

       $iFilteredTotal=$builder_count->where('live_test_mode',$live_test_mode)->count();
       $iTotal=$iTotal_builder->count();
       $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array(),
        );
      $departure_aerodrome = (isset($_GET['departure_aerodrome'])) ? $_GET['departure_aerodrome'] : '';
      $destination_aerodrome = (isset($_GET['destination_aerodrome'])) ? $_GET['destination_aerodrome'] : '';
      $aircraft_callsign = (isset($_GET['aircraft_callsign'])) ? $_GET['aircraft_callsign'] : '';
      $from_date = (isset($_GET['from_date'])) ? $_GET['from_date'] : '';
      $to_date = (isset($_GET['to_date'])) ? $_GET['to_date'] : '';
      $url = (isset($_GET['url'])) ? $_GET['url'] : '';
      $date_of_flight = (isset($_GET['date_of_flight'])) ? $_GET['date_of_flight'] : '';
      $clicked_btn = (isset($_GET['clicked_btn'])) ? $_GET['clicked_btn'] : '';
      $is_admin = $this->is_admin;
      $filter_stats = (isset($_GET['filter_stats'])) ? $_GET['filter_stats'] : '';
      $sno = $iFilteredTotal - ($_GET['iDisplayStart']);
      foreach($result as $res) 
      {
              $row = array();
              $id = $res->id;
              $date_of_flight = $res->flight_date;
              $aircraft_callsign = $res->callsign;
              $departure_aerodrome = $res->departure;
              $destination_aerodrome = $res->destination;
              $departure_time_hours = substr($res->dep_time,0,2);
              $departure_time_minutes =substr($res->dep_time,2,2);
              $fic = $res->fic;
              $adc = $res->adc;
              $fpl_id = $res->fpl_id;
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
              $change_fpl_html='';
              //$aRow['is_active'] = ($aRow['is_active']) ? 'Active' : 'Inactive';
              $hi = gmdate('Hi');
              $cursor_disable = ($is_plan_active) ? "" : "style='cursor:not-allowed !important;'";
              $fic_cursor_disable = ($is_fic_active) ? "" : "style='cursor:not-allowed !important;'";
              $fic_disabled = ($is_fic_active) ? '' : 'disabled="disabled"';
              $fic_readonly = ($fic) ? 'readonly=readonly' : '';
              $adc_readonly = ($adc) ? 'readonly=readonly' : '';
              $check_revise = ($is_plan_active) ? 'navlog_check_revise' : '';
              $encoded = Crypt::encrypt($id);
              $cancel_disabled = ($plan_status == 1) ? '' : 'disabled="disabled"';
              $gmt_time = gmdate('Hi');
              $is_change_allowed = '';
              $date_of_flight_display = date('d-M', strtotime($date_of_flight));
              $date_of_flight_notams = date('d-M-Y', strtotime($date_of_flight));
              if(isset($fpl_id)){
                $fplid_encoded = Crypt::encrypt($fpl_id);
                $change_fpl_html="<div class='tooltip_cancel' style='float:right'>
                                         <div class='tooltip_cancel'>
                                          <img src='$url/media/ananth/images/modify_black.png' class='img-responsive navlog_modal_class add_cancel_img$fpl_id' $cursor_disable $is_change_allowed is_change_allowed='$is_change_allowed' data-value='$fpl_id' data-encoded='$fplid_encoded' data-url='$url/navlog_modal_popups' is-plan-active='$is_plan_active' modal-type='change_fpl_plan' alt='modify'>
                                          </div>
                                             <span class='tooltip_change_position modifychangefpl_position'>CHANGE  FPL</span>
                                         <div class='tooltip_tri_shape6 modifychangefpl_shape'></div>
                                       </div>";
              }
              $is_etd_changed = $res->is_etd_changed;
              // echo 'fic='.$fic;
              // echo 'adc='.$adc;
              // echo 'is_etd_changed='.$is_etd_changed;
              // dd($is_etd_changed==1 && isset($fic) && isset($adc));
              if($is_etd_changed==1 && $fic!="" && $adc!="" ){
              //  dd("ss");
                 $fic_readonly=''; 
                 $adc_readonly='';
                 $background_white = 'background-white';
                 
              }
               $row = array(0 => $sno,
                           1 => "<div class='dof'>
                                      <span class='flightdate1  $plan_status_class  add_cancel_class$res->id'>" . $date_of_flight_display . "</span>
                                      <div class='tooltip_cancel'>
                                         <span class='delete'><img src='$url/media/ananth/images/close.png' is-plan-active='$is_plan_active' class='img-responsive  navlog_modal_class add_cancel_img$res->id' modal-type=".$cancel." $cursor_disable  data-value='$res->id' data-url='$url/navlog_modal_popups' alt='delete'>
                                         </span>
                                         <span class='tooltip_cancel_position canceltooltip_position'>CANCEL</span>
                                         <div class='tooltip_tri_shape1 canceltooltip_shape'></div>
                                      </div>",
                            2 => "<div class='calsign'>
                                       <div class='tooltip_cancel'>
                                            <a href='javascript:void(0)'><img src='$url/app/new_temp/images/mail1.png' width='18' style='float:left;cursor:pointer;margin-top:4px;'></a>
                                            <div class='tooltip_fpl_position2 sendemailtooltip_position'>SEND EMAIL</div>
                                            <div class='tooltip_tri_shape12 sendemailtooltip_shape'></div>
                                      </div>
                                      <div class='tooltip_cancel'>
                                          <span $cursor_disable data-dept-aero='$res->departure' data-dest-aero='$res->destination' data-callsign='$res->callsign' data-dof='$res->flight_date' data-value='$res->id' class='callsign_icon_margin csgn $plan_status_class add_cancel_class$id $fdtl_popup'>$res->callsign
                                          </span>
                                          <span class='tooltip_fpl_position1 editfdtl_position'>Edit Navlog</span>
                                          <div class='tooltip_tri_shape11 editfdtl_shape'></div>
                                       </div>
                                       
                                        <div class='tooltip_cancel'>
                                            <span class='eye'>
                                               <img src='$url/media/ananth/images/preview.png' is-plan-active='$is_plan_active' modal-type='preview' data-value='$res->id' class='img-responsive navlog_modal_class' data-url='$url/navlog_modal_popups' alt='preview'>
                                            </span>
                                            <span class='tooltip_fpl_position fplreview_position'>NAVLOG REQUEST</span>
                                            <div class='tooltip_tri_shape2 fplreview_shape'></div>
                                        </div>
                                  </div>",
                            3 => "<div class='depart-time'>
                                        <form action='$url/nnavlog_revice_time' name='' id='' method='POST' >
                                            <input type='hidden' name='current_time' data-value='$res->id' id='current_time' value='$hi' />
                                            <input type='hidden' name='current_dof' data-value='$res->id' id='current_dof' value='$date_of_flight' />
                                            <input type='hidden' name='a_current_date' data-value='$res->id' id='a_current_date' value='$current_date' />    
                                            <input type='hidden' id='current_dept_time$res->id' data-value='$res->id' value='$departure_time_hours$departure_time_minutes' />
                                          <div class='mod-time tooltip_revise_dbl tooltip_revise_time tooltip_revise_valid'>
                                             <input type='text' $cursor_disable $cancel_disabled value='$departure_time_hours$departure_time_minutes' id='departure_time$id' data-value='$id' name='departure_time$id' readonly='readonly' class='form-control  alt-time $plan_status_class add_cancel_class$id enable_class numeric navlog_departure_time $background_white ficstyle' minlength='4' maxlength='4' placeholder='Time' data-toggle='popover' data-placement='right' autocomplete='off'>                                                   
                                                <div class='tooltip_tri_shape deptimerevisetime_shape1'></div>
                                                <span class='tooltip_revise_dbl_position deptimerevisetime_position'>Double Click to Revise Time</span>
                                                <div class='tooltip_tri_shape_valid deptimerevisetime_shape'></div>
                                                <span class='tooltip_revise_dbl_position_valid'>Revise Time in multiples of 5 only</span>
                                          </div>
                                          <div class='tooltip_cancel'>
                                            <div class='time-icon'>
                                                 <img src='$url/media/ananth/images/time.png' id='time_img$id' class='$check_revise timeicon_style add_cancel_img$id' data-value='$id' $cursor_disable $cancel_disabled is-plan-active='$is_plan_active' modal-type='revise_confirm' data-url='$url/navlog_modal_popups'>
                                            </div>
                                            <span class='tooltip_revise_position revisetime_position'>REVISE TIME</span>
                                            <div class='tooltip_tri_shape3 revisetime_shape'></div>
                                         </div>
                                        </form>
                                    </div>",     
                             4 => "<div class='fic-adc'>
                                        <form method='post' name='ficadc' action='#'>
                                        <div class='fic'>
                                            <input type='text' data-toggle ='popover' data-placement='right' class='ficstyle form-control $plan_status_class numeric fic_valid add_cancel_class$res->id' data-value='$res->id'  id='fic$id' value='$fic' name='fic$res->id' $fic_readonly  placeholder='FIC' minlength='4' maxlength='4' $fic_disabled>
                                        </div>
                                        <div class='adc'>
                                            <input type='text' data-toggle ='popover' data-placement='right'  data-dept-aero='$departure_aerodrome' data-dest-aero='$destination_aerodrome' id='adc$res->id' name='adc$id' value='$adc' data-placement='bottom' class='adcstyle form-control $plan_status_class adc_valid text_uppercase add_cancel_class$id' $adc_readonly data-value='$res->id' maxlength ='6' placeholder='ADC' $fic_disabled>
                                        </div>
                                        <div class='send'>
                                            <input type='button' class='form-control sendbtn navlog_modal_class add_cancel_img$res->id'  is-fic-active ='$is_fic_active' modal-type='fic_adc' data-value='$res->id' $fic_cursor_disable value='Send' data-url='$url/navlog_modal_popups' >
                                        </div>
                                        </form>
                                    </div>",
                             5 => "<div class='from $plan_status_class  add_cancel_class$res->id deptpopover'>
                                     <div class='$tooltip_cancel'>
                                        <span href='#'>$departure_aerodrome</span>
                                        <span class='tooltip_dept_position airportname_position'>$departure_station</span>
                                        <div class='tooltip_tri_shape4 airportname_shape'></div>
                                     </div>
                                   </div>",
                             6 => "<div class='to $plan_status_class add_cancel_class$id deptpopover'>
                                       <div class='$tooltip_cancel2'>
                                         <span href='#'>$destination_aerodrome</span>
                                         <span class='tooltip_dest_position airportname_position_to'>$destination_station</span>
                                         <div class='tooltip_tri_shape5 airportname_shape_to'>
                                         </div>
                                        </div>
                                    </div>",
                            
                            7 => "<span class='flmodify'>
                                         <div class='tooltip_cancel' style='float:left'>
                                            <img src='$url/media/ananth/images/modify.png' class='img-responsive navlog_modal_class add_cancel_img$res->id' $cursor_disable $is_change_allowed is_change_allowed='$is_change_allowed' data-value='$res->id' data-encoded='$encoded' data-url='$url/navlog_modal_popups' is-plan-active='$is_plan_active' modal-type=".$change_plan." alt='modify'>
                                               <span class='tooltip_change_position modifychangenavlog_position'>CHANGE NAV LOG</span>
                                           <div class='tooltip_tri_shape6 modifychangenavlog_shape'></div>
                                         </div>
                                         $change_fpl_html
                                    </span>",       
                             8 => "<div class='weather' style='visibility:hidden;'>
                                        <div class='tooltip_cancel'>
                                           <a href='$url/navlog_file_plan/$id'><img src='$url/media/ananth/images/pdf.png' class='img-responsive' alt='pdf' width='45px'></a>
                                               <span class='tooltip_pdf_position icaoatc_position'>ICAO ATC</span>
                                               <div class='tooltip_tri_shape8 icaoatc_shape'></div>
                                        </div>
                                    </div>",
                             9 => "<div class='notams' style='visibility:hidden;'>
                                        <div class='tooltip_cancel'>
                                                     <a  class= '$fpl_notams' $notam_cursor_disable data-dof='$date_of_flight_notams' data-value='$id' target='_self'><img src='$url/media/ananth/images/notam1.png' class='img-responsive notamimage_style' alt='notam'></a>
                                                     <span class='tooltip_notam_position filterednotams_position'>FILTERED NOTAMS</span>
                                                     <div class='tooltip_tri_shape9 filterednotams_shape'></div>
                                        </div>
                                    </div>",       
                             10 => "<div class='fildate' style='visibility:hidden;'>
                                         <div class='tooltip_cancel'>
                                            <a href='javascript:void(0)' target='_self'><img src='$url/media/ananth/images/weather.png' class='img-responsive' alt='weather'></a>
                                           <span class='tooltip_wx_position weatherbrief_position'>WEATHER BRIEF</span>
                                           <div class='tooltip_tri_shape10 weatherbrief_shape'></div>
                                        </div>
                                    </div>",
                              11 => "<div class='weather navicon_style_image' style='visibility:hidden;'>
                                              <div class='tooltip_cancel'>
                                                      <a href='javascript:void(0);'><img src='$url/media/ananth/images/NAV.png' class='img-responsive navicon_style navlog_modal_class' alt='pdf' width='45px' modal-type='navlog' data-value='$id' data-url='$url/navlog_modal_popups'></a>
                                                      <span class='tooltip_pdf_position navicon_position'>NAV LOG</span>
                                                      <div class='tooltip_tri_shape8 navicon_shape'></div>
                                              </div>
                                          </div>",
                              12 => "<div class='notams' style='visibility:hidden;'>
                                              <div class='tooltip_cancel'>
                                                      <a  class= '' $notam_cursor_disable data-dof='$date_of_flight_notams' data-value='$id' target='_self'><img src='$url/media/ananth/images/LNT.png' class='img-responsive' alt='notam'></a>
                                                      <span class='tooltip_notam_position lnticon_position'>LOAD AND TRIM</span>
                                                      <div class='tooltip_tri_shape9 lnticon_shape'></div>
                                              </div>
                                              </div>",
                              13 => "<div class='fildate' style='visibility:hidden;'>
                                              <div class='tooltip_cancel'>
                                                      <a href='javascript:void(0);' target='_self'><img src='$url/media/ananth/images/KIT.png' class='img-responsive' alt='weather'></a>
                                                      <span class='tooltip_wx_position kiticon_position'>TRIP KIT</span>
                                                      <div class='tooltip_tri_shape10 kiticon_shape'></div>
                                              </div>
                                          </div>",      
                );  
              $sno--;
             $output['aaData'][] = $row;     
       }   
      return $output;
       
    }
    public function test_navlog_list(Request $request){
       $live_test_mode=$request->live_test_mode;
       if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
           $offset =intval($_GET['iDisplayStart']);
           $limit=intval($_GET['iDisplayLength']);
       }
       $iTotal_builder=Navlog::query(); 
       $builder = Navlog::query();
       $builder_count = Navlog::query();
       $cancel='cancel';
       $change_plan='change_plan';
       if($request->clicked_btn=='3rd'){  // pending
          $builder->where('plan_status',1);
          $builder_count->where('plan_status',1);
          $cancel='pending_cancel';
          $change_plan='pending_change_plan';
          $iTotal_builder->where('plan_status',1);
       }
        else if($request->clicked_btn=='4th'){   //completed
          $builder->where('plan_status',3);
          $builder_count->where('plan_status',3);
          $iTotal_builder->where('plan_status',3);
       }
       else if($request->clicked_btn=='5th'){   //cancelled
          $builder->where('plan_status',2);
          $builder_count->where('plan_status',2);
          $iTotal_builder->where('plan_status',2);
       }
       else{
         $builder->where('plan_status',1);
         $builder_count->where('plan_status',1);
         $iTotal_builder->where('plan_status',1);
       }
       if($request->has('from_date') && $request->has('to_date')){
            $builder->where('flight_date','>=',date('Ymd', strtotime($request->from_date)))
                    ->where('flight_date','<=',date('Ymd', strtotime($request->to_date)));
            $builder_count->where('flight_date','>=',date('Ymd', strtotime($request->from_date)))
                    ->where('flight_date','<=',date('Ymd', strtotime($request->to_date)));        
       }
       if($request->has('flight_date'))
       {
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

      if($this->user_role_id !=1 && $this->user_role_id !=2){
         $builder->where('user_id',Auth::user()->id);
         $builder_count->where('user_id',Auth::user()->id);

         $iTotal_builder->where('user_id',Auth::user()->id);
      } 
      $result = $builder->offset($offset)->limit($limit)->where('live_test_mode',$live_test_mode)->orderBy('flight_date', 'desc')->orderBy('dep_time', 'desc')->get();

      $iFilteredTotal=$builder_count->where('live_test_mode',$live_test_mode)->count();
      $iTotal=$iTotal_builder->count();
      $output = array(
           "sEcho" => intval($_GET['sEcho']),
           "iTotalRecords" => $iTotal,
           "iTotalDisplayRecords" => $iFilteredTotal,
           "aaData" => array(),
       );
     $departure_aerodrome = (isset($_GET['departure_aerodrome'])) ? $_GET['departure_aerodrome'] : '';
     $destination_aerodrome = (isset($_GET['destination_aerodrome'])) ? $_GET['destination_aerodrome'] : '';
     $aircraft_callsign = (isset($_GET['aircraft_callsign'])) ? $_GET['aircraft_callsign'] : '';
     $from_date = (isset($_GET['from_date'])) ? $_GET['from_date'] : '';
     $to_date = (isset($_GET['to_date'])) ? $_GET['to_date'] : '';
     $url = (isset($_GET['url'])) ? $_GET['url'] : '';
     $date_of_flight = (isset($_GET['date_of_flight'])) ? $_GET['date_of_flight'] : '';
     $clicked_btn = (isset($_GET['clicked_btn'])) ? $_GET['clicked_btn'] : '';
     $is_admin = $this->is_admin;
     $filter_stats = (isset($_GET['filter_stats'])) ? $_GET['filter_stats'] : '';
     $sno = $iFilteredTotal - ($_GET['iDisplayStart']);
     foreach($result as $res) 
     {
             $row = array();
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
     //         $aRow['is_active'] = ($aRow['is_active']) ? 'Active' : 'Inactive';
             $hi = gmdate('Hi');
             $cursor_disable = ($is_plan_active) ? "" : "style='cursor:not-allowed !important;'";
             $fic_cursor_disable = ($is_fic_active) ? "" : "style='cursor:not-allowed !important;'";
             $fic_disabled = ($is_fic_active) ? '' : 'disabled="disabled"';
             $fic_readonly = ($fic) ? 'readonly=readonly' : '';
             $adc_readonly = ($adc) ? 'readonly=readonly' : '';
             $check_revise = ($is_plan_active) ? 'navlog_check_revise' : '';
             $encoded = Crypt::encrypt($id);
             $cancel_disabled = ($plan_status == 1) ? '' : 'disabled="disabled"';
             $gmt_time = gmdate('Hi');
             $is_change_allowed = '';
             $date_of_flight_display = date('d-M', strtotime($date_of_flight));
             $date_of_flight_notams = date('d-M-Y', strtotime($date_of_flight));

              $row = array(0 => $sno,
                          1 => "<div class='dof'>
                                     <span class='flightdate1  $plan_status_class  add_cancel_class$res->id'>" . $date_of_flight_display . "</span>
                                     <div class='tooltip_cancel'>
                                        <span class='delete'><img src='$url/media/ananth/images/close.png' is-plan-active='$is_plan_active' class='img-responsive  navlog_modal_class add_cancel_img$res->id' modal-type=".$cancel." $cursor_disable  data-value='$res->id' data-url='$url/navlog_modal_popups' alt='delete'>
                                        </span>
                                        <span class='tooltip_cancel_position canceltooltip_position'>CANCEL</span>
                                        <div class='tooltip_tri_shape1 canceltooltip_shape'></div>
                                     </div>",
                           2 => "<div class='calsign'>
                                      <div class='tooltip_cancel'>
                                           <a href='javascript:void(0)'><img src='$url/app/new_temp/images/mail1.png' width='18' style='float:left;cursor:pointer;margin-top:4px;'></a>
                                           <div class='tooltip_fpl_position2 sendemailtooltip_position'>SEND EMAIL</div>
                                           <div class='tooltip_tri_shape12 sendemailtooltip_shape'></div>
                                     </div>
                                     <div class='tooltip_cancel'>
                                         <span $cursor_disable data-dept-aero='$res->departure' data-dest-aero='$res->destination' data-callsign='$res->callsign' data-dof='$res->flight_date' data-value='$res->id' class='callsign_icon_margin csgn $plan_status_class add_cancel_class$id $fdtl_popup'>$res->callsign
                                         </span>
                                         <span class='tooltip_fpl_position1 editfdtl_position'>Edit Navlog</span>
                                         <div class='tooltip_tri_shape11 editfdtl_shape'></div>
                                      </div>
                                      
                                       <div class='tooltip_cancel'>
                                           <span class='eye'>
                                              <img src='$url/media/ananth/images/preview.png' is-plan-active='$is_plan_active' modal-type='test-preview' data-value='$res->id' class='img-responsive navlog_modal_class' data-url='$url/navlog_modal_popups' alt='preview'>
                                           </span>
                                           <span class='tooltip_fpl_position fplreview_position'>NAVLOG REQUEST</span>
                                           <div class='tooltip_tri_shape2 fplreview_shape'></div>
                                       </div>
                                 </div>",
                           3 => "<div class='depart-time'>
                                        <span style='font-weight:bold'>$departure_time_hours$departure_time_minutes</span>
                                   </div>",     
                            4 => "<div class='from $plan_status_class  add_cancel_class$res->id deptpopover'>
                                    <div class='$tooltip_cancel'>
                                       <span href='#'>$departure_aerodrome</span>
                                       <span class='tooltip_dept_position airportname_position'>$departure_station</span>
                                       <div class='tooltip_tri_shape4 airportname_shape'></div>
                                    </div>
                                  </div>",
                            5 => "<div class='to $plan_status_class add_cancel_class$id deptpopover'>
                                      <div class='$tooltip_cancel2'>
                                        <span href='#'>$destination_aerodrome</span>
                                        <span class='tooltip_dest_position airportname_position_to'>$destination_station</span>
                                        <div class='tooltip_tri_shape5 airportname_shape_to'>
                                        </div>
                                       </div>
                                   </div>",
                           
                           6 => "<span class='flmodify'>
                                        <div class='tooltip_cancel'>
                                           <img src='$url/media/ananth/images/modify.png' class='img-responsive navlog_modal_class add_cancel_img$res->id' $cursor_disable $is_change_allowed is_change_allowed='$is_change_allowed' data-value='$res->id' data-encoded='$encoded' data-url='$url/navlog_modal_popups' is-plan-active='$is_plan_active' modal-type=".$change_plan." alt='modify'>
                                              <span class='tooltip_change_position modifychangefpl_position'>CHANGE REQUEST</span>
                                          <div class='tooltip_tri_shape6 modifychangefpl_shape'></div>
                                        </div>
                                   </span>",       
                            7 => "<div class='weather' style='visibility:hidden;'>
                                       <div class='tooltip_cancel'>
                                          <a href='$url/fpl/file_plan/$id'><img src='$url/media/ananth/images/pdf.png' class='img-responsive' alt='pdf' style='margin-left: 10px;'></a>
                                              <span class='tooltip_pdf_position icaoatc_position'>TEST NAV PLAN</span>
                                              <div class='tooltip_tri_shape8 icaoatc_shape'></div>
                                       </div>
                                   </div>",
                            8 => "<div class='notams' style='visibility:hidden;'>
                                       
                                   </div>"
               );  
             $sno--;
            $output['aaData'][] = $row;     
      }   
     return $output;  
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
          if(!isset($paxs))
             $paxs=array('max_pax'=>14);
           return response()->json(array('success' => true,'data'=>$res,'paxs'=>$paxs,'speeds'=>$speeds),200);
        }
        public function modal_popups(Request $request) {
            $id = $request->id;
            $modal_type = $request->modal_type;

            if($modal_type=='change_fpl_plan'){
              $fpl_details = FlightPlanDetailsModel::find($id);
              $aircraft_callsign = ($fpl_details) ? $fpl_details->aircraft_callsign : '';
              $fpl_details_json_encode = json_encode($fpl_details);
              $data = json_decode($fpl_details_json_encode, TRUE);
              $get_dep_zzzz_name = myFunction::get_dep_zzzz_name($data);
              $get_dest_zzzz_name = myFunction::get_dest_zzzz_name($data);
            }
            else {
              $navlog_details = Navlog::find($id);
              $aircraft_callsign = ($navlog_details) ? $navlog_details->callsign : '';
              $navlog_json_encode = json_encode($navlog_details);
              $data = json_decode($navlog_json_encode, TRUE);
              $get_dep_zzzz_name = myFunction::get_navlog_dep_zzzz_name($data);
              $get_dest_zzzz_name = myFunction::get_navlog_dest_zzzz_name($data);
            }
            switch ($modal_type) {
                case 'cancel':
                    $modal_message = "Do you wish to Cancel ";
                    $modal_message .= (isset($aircraft_callsign)) ? $aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Plan? ";
                    $header_title = 'Cancel Plan '."$navlog_details->navlog_no";
                    break;
                case 'pending_cancel':
                    $modal_message = "Do you wish to Cancel ";
                    $modal_message .= (isset($aircraft_callsign)) ? $aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Plan? ";
                    $header_title = 'Cancel Plan '."$navlog_details->navlog_no";
                    break;    
                case 'preview':
                    $modal_message = myFunction::navlog_preview_info($data);
                    $modal_message = str_ireplace('<br>', "<span class='clearfix'></span>", $modal_message);
                    $header_title = 'NAV LOG REQUEST '."$navlog_details->navlog_no";
                    break;
                case 'navlog':
                    $modal_message = myFunction::navlog_info($data);
                    $modal_message = str_ireplace('<br>', "<span class='clearfix'></span>", $modal_message);
                    $header_title = 'NAV LOG REQUEST '."$navlog_details->navlog_no";
                    break;    
                case 'test-preview':
                    $modal_message = myFunction::navlog_test_preview_info($data);
                    $modal_message = str_ireplace('<br>', "<span class='clearfix'></span>", $modal_message);
                    $header_title = 'NAV LOG REQUEST '."$navlog_details->navlog_no";
                    break;    
                case 'revise_confirm':
                    $modal_message = "Are you sure to revise departure time for ";
                    $modal_message .= (isset($aircraft_callsign)) ? "<br>".$aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Plan? ";
                    $header_title = 'Revise Time '."$navlog_details->navlog_no";
                    break;
                case 'fic_adc':
                    $modal_message = "Confirm you wish to send SMS for ";
                    $modal_message .= (isset($aircraft_callsign)) ? "<br>".$aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Time? ";
                    $header_title = 'FIC ADC Plan '."$navlog_details->navlog_no";
                    break;
                case 'change_plan':
                    $modal_message = "Are you sure to Change Plan details for ";
                    $modal_message .= (isset($aircraft_callsign)) ? "<br>".$aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Plan? ";
                    $header_title = 'Change Plan '."$navlog_details->navlog_no";
                    break;
                case 'change_fpl_plan':
                    $modal_message = "Are you sure to Change Plan details for ";
                    $modal_message .= (isset($aircraft_callsign)) ? "<br>".$aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Plan? ";
                    $header_title = 'Change Fpl Plan';
                    break;    
                case 'pending_change_plan':
                    $modal_message = "Are you sure to Change Plan details for ";
                    $modal_message .= (isset($aircraft_callsign)) ? "<br>".$aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                    $modal_message .= " Plan? ";
                    $header_title = 'Change Plan '."$navlog_details->navlog_no";
                    break;   
                case 'tableview':
                    $modal_message = '
    <div class="table-responsive">
    <table class="table table-bordered">
      <thead class="table-inverse">
        <tr>
          <th class="sno">SI</th>
          <th class="desig">Designation</th>
          <th class="name">Name</th>
          <th class="email"><span>Email</span> <img src="media/ananth/images/copyema-con.png" alt="copyema-con" style="vertical-align:top;" /></th>
          <th class="mob">Mobile</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <td>1</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>2</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>3</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>4</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>5</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>6</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>7</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>8</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>9</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
        <tr>
        <td>10</td>
        <td>webdeveloper</td>
        <td>lavanya</td>
        <td>lavanya.gondrala84@gmail.com</td>
        <td>1234567890</td>
        </tr>
      </tbody>
    </table>

      </div><!-- end of pilots information -->
    ';
                    $header_title = 'VT-UPJ & VT-UPR ';
                default:
                    break;
            }

            return response()->json(['header_title' => $header_title, 'modal_message' => $modal_message]);
        }
   public function revice_time(Request $request) {
        $id = $request->id;
        $navlog_details = Navlog::find($id);
        $navlog_details_json_encode = json_encode($navlog_details);
        $data = json_decode($navlog_details_json_encode, TRUE);
        $is_update = '';
        if ($data['dep_time'] != $request->departure_time) {
            $is_update = 1;
            Navlog::find($id)->update(['dep_time_change'=>1]); 
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
        $update_plan_status = Navlog::where('id', $id)->update(['dep_time' => $request->departure_time,'deptime_ist'=>$request->deptime_ist,'is_etd_changed'=>1]);
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
        return Response::json(['success' => $aircraft_callsign . ' DEPARTURE TIME REVISED SUCCESSFULLY']);
    }
       public function navlog_info_update(Request $request){
          $id=$request->id;
          $navlog=Navlog::find($id);
          $navlog->flying_time=$request->flying_hr.$request->flying_min;
          $navlog->block_fuel=$request->block_fuel;
          $navlog->route=$request->route;
          $navlog->distance=$request->distance;
          $navlog->navlog_load=$request->navlog_load;
          $navlog->min_fuel=$request->min_fuel;
          $navlog->max_fuel=$request->max_fuel;
          $navlog->altn=$request->altn;
          $navlog->altn_dis=$request->altn_dis;
          $navlog->save();
          return Response::json(['success' =>true,'msg'=>'Navlog Info Updated SUCCESSFULLY']);
       } 
        public function navlog_cancel(Request $request) {
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
            return Response::json(['success' => $aircraft_callsign . ' PLAN CANCELLED SUCCESSFULLY']);
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
                $adc = strtoupper($request->adc);
                $is_update = '';
                if ($data['fic'] . $data['adc'] != $fic . $adc) {
                    $is_update = 1;
                }
                $fic_update = ['fic' => $fic, 'adc' => $adc, 'adc_updated_by' => $adc_updated_by, 'adc_updated_time' => $adc_updated_time,'is_etd_changed'=>0];
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
                return Response::json(['success' => $aircraft_callsign . ' FIC ADC Updated Successfully']);
            }
}