<?php

namespace App\Http\Controllers\Newaircraft;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use DateTime;
use Log;
use Response;
use Crypt;
use PDF;
use Storage;
use File;
use Session;
use App\models\Newaircraft;
class NewaircraftController extends Controller
{
   public function __construct() {
    
       $this->from = env('FROM', "support@eflight.aero");
       $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
       $this->user_id = Auth::user()->id;
       $this->user_name = Auth::user()->name;
       $this->user_email = Auth::user()->email;
       $this->is_admin = Auth::user()->is_admin;
       $this->user_callsigns = Auth::user()->user_callsigns;
   }
   public function index(){
          return view('newaircraft.index');
   }
   public function AutoSuggest()
    {
        $newaircrafts = DB::table('newaircraft')->get();
        foreach ($newaircrafts as $newaircraft) {
          $data[]=$newaircraft->name;
        }
         return json_encode($data);
    }
   public function callsign_check(Request $request){
      $aircraft_callsign=Newaircraft::where('callsign',$request->callsign)->count();
      return response()->json(['callsign_count' => $aircraft_callsign]);
   } 
   public function store(Request $request){
    $aircraft_callsign=Newaircraft::where('callsign',$request->callsign)->count();
    if($aircraft_callsign>0)
          return response()->json(['callsign_count' => 1]);
    $newaircraft=new Newaircraft;
    $latestFplCopy_path='';
    $latestLoadTrim_path='';
    $previousNavLog_path='';
    $companyFuelPolicy_path='';
    if ($request->hasFile('latestFplCopy')) {
         $imageName =time().'_'.$request->file('latestFplCopy')->getClientOriginalName();
         $request->file('latestFplCopy')->move(base_path().'/public/media/images/newaircraft/',$imageName);
         $newaircraft->fpl_copy=$imageName;
         $latestFplCopy_path=public_path('media/images/newaircraft/'.$imageName);
    }
    if ($request->hasFile('latestLoadTrim')) {
         $imageName =time().'_'.$request->file('latestLoadTrim')->getClientOriginalName();
         $request->file('latestLoadTrim')->move(base_path().'/public/media/images/newaircraft/',$imageName);
         $newaircraft->loadtrim_sheet=$imageName;
          $latestLoadTrim_path=public_path('media/images/newaircraft/'.$imageName);
    }
    if ($request->hasFile('previousNavLog')) {
         $imageName =time().'_'.$request->file('previousNavLog')->getClientOriginalName();
         $request->file('previousNavLog')->move(base_path().'/public/media/images/newaircraft/',$imageName);
         $newaircraft->previous_navlog=$imageName;
         $previousNavLog_path=public_path('media/images/newaircraft/'.$imageName);
    }
    if ($request->hasFile('companyFuelPolicy')) {
         $imageName =time().'_'.$request->file('companyFuelPolicy')->getClientOriginalName();
         $request->file('companyFuelPolicy')->move(base_path().'/public/media/images/newaircraft/',$imageName);
         $newaircraft->fuel_policy=$imageName;
         $companyFuelPolicy_path=public_path('media/images/newaircraft/'.$imageName);
    }
    //dd($data['filepath']);
    $newaircraft->callsign = strtoupper($request->callsign);
    $newaircraft->operator = strtoupper($request->operator);
    $newaircraft->aircrafttype = strtoupper($request->aircrafttype);
    $newaircraft->engine_type = strtoupper($request->engine_type);
    $newaircraft->weight = $request->weight;
    $newaircraft->pax = $request->pax;
    $newaircraft->max_fl = $request->max_fl;
    $newaircraft->max_fuel = $request->max_fuel;
    $newaircraft->taxi_fuel = $request->taxi_fuel;
    $newaircraft->tow = $request->tow;
    $newaircraft->lw = $request->lw;
    $newaircraft->zfw = $request->zfw;
    $newaircraft->basic_wt = $request->basic_wt;
    $newaircraft->equipments = strtoupper($request->equipments);
    if ($request->has('holding')) {
        $newaircraft->holding = $request->holding;
    }
    if($request->transponder!='Transponder')
        $newaircraft->transponder = strtoupper($request->transponder);

    $newaircraft->pbn = strtoupper($request->pbn);
    $newaircraft->nav = strtoupper($request->nav);
    if ($request->has('credit_aai')) {
        $newaircraft->credit_aai = $request->credit_aai;
    }
    $newaircraft->aircraftcolor = strtoupper($request->aircraftcolor);
    if ($request->has('emergency_radio')) {
        $newaircraft->emergency_radio = json_encode($request->emergency_radio);
    }
    if ($request->has('survial_equipment')) {
        $newaircraft->survival_equipment = json_encode($request->survial_equipment);
    }
    if ($request->has('jacket')) {
        $newaircraft->jacket = json_encode($request->jacket);
    }
    if ($request->has('cover')) {
        $newaircraft->dhinges_cover = $request->cover;
    }
    if(strtoupper($request->dinghies_color)!="COLOR")
      $dinghies_col=strtoupper($request->dinghies_color);
    else
      $dinghies_col='';
    $newaircraft->dinghies_color = $dinghies_col;
    $newaircraft->dinghies_capacity = $request->dinghies_capacity;
    $newaircraft->dinghies_no = $request->dinghies_no;

    $newaircraft->ops_manager = strtoupper($request->ops_manager);
    $newaircraft->ops_mobile = $request->ops_mobile;
    $newaircraft->ops_email_id =$request->ops_email_id;
    $crew=$request->crew;
    foreach($crew as $key=>$value){
      $index=$key+1;
       if($index==1)
          $newaircraft->crew1=strtoupper($value);
       elseif ($index==2) 
          $newaircraft->crew2=strtoupper($value);
       elseif ($index==3) 
          $newaircraft->crew3=strtoupper($value);
       elseif ($index==4) 
          $newaircraft->crew4=strtoupper($value);
       elseif ($index==5) 
          $newaircraft->crew5=strtoupper($value);
       elseif ($index==6) 
          $newaircraft->crew6=strtoupper($value);
       elseif ($index==7)
          $newaircraft->crew7=strtoupper($value);
       elseif ($index==8) 
          $newaircraft->crew8=strtoupper($value);
       elseif ($index==9)
          $newaircraft->crew9=strtoupper($value);
    }
    $mobile=$request->mobile;
    foreach($mobile as $key=>$value){
      $index=$key+1;
       if($index==1)
          $newaircraft->mobile1=strtoupper($value);
       elseif ($index==2) 
          $newaircraft->mobile2=strtoupper($value);
       elseif ($index==3) 
          $newaircraft->mobile3=strtoupper($value);
       elseif ($index==4) 
          $newaircraft->mobile4=strtoupper($value);
       elseif ($index==5) 
          $newaircraft->mobile5=strtoupper($value);
       elseif ($index==6) 
          $newaircraft->mobile6=strtoupper($value);
       elseif ($index==7)
          $newaircraft->mobile7=strtoupper($value);
       elseif ($index==8) 
          $newaircraft->mobile8=strtoupper($value);
       elseif ($index==9)
          $newaircraft->mobile9=strtoupper($value);
    }
    $email=$request->email;
    foreach($email as $key=>$value){
      $index=$key+1;
       if($index==1){
          $newaircraft->email1=$value;
          $newaircraft->designation1=$request->designation0;
       }
       elseif ($index==2){ 
          $newaircraft->email2=$value;
          $newaircraft->designation2=$request->designation1;
        }  
       elseif ($index==3){ 
          $newaircraft->email3=$value;
          $newaircraft->designation3=$request->designation2;
        }  
       elseif ($index==4){ 
          $newaircraft->email4=$value;
          $newaircraft->designation4=$request->designation3;
       }
       elseif ($index==5){ 
          $newaircraft->email5=$value;
          $newaircraft->designation5=$request->designation4;
       }
       elseif ($index==6){ 
          $newaircraft->email6=$value;
          $newaircraft->designation6=$request->designation5;
       }
       elseif ($index==7){
          $newaircraft->email7=$value;
          $newaircraft->designation7=$request->designation6;
       }
       elseif ($index==8){ 
          $newaircraft->email8=$value;
          $newaircraft->designation8=$request->designation7;
       }
       elseif ($index==9){
          $newaircraft->email9=$value;
          $newaircraft->designation9=$request->designation8;
       }
    }
    $newaircraft->save();
    $request->session()->put('aircraft',$newaircraft);
    $data['email'] =$request->ops_email_id;
    $data['subject'] = strtoupper($request->callsign)." ".'AIRCRAFT DETAILS for NEW AIRCRAFT SIGN UP EMAIL';
    $data['file_path1']=$latestFplCopy_path;
    $data['file_path2']=$latestLoadTrim_path;
    $data['file_path3']=$previousNavLog_path;
    $data['file_path4']=$companyFuelPolicy_path;
    $data['username']=$this->user_name;
    dispatch(new \App\Jobs\AircraftJob($data));
    return response()->json(['callsign_count' =>0]);
   } 
}  