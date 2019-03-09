<?php
namespace App\Http\Controllers\Handler;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Handler;
use App\models\Handlerinfo;
use App\models\Handlerrevision;
use App\models\HandlerOrderHistoryModel;
use App\models\FlightPlanDetailsModel;
use Auth;
use DB;
use App\Jobs\HandlerOrderJob;
use Carbon\Carbon;
use Log;
date_default_timezone_set('Asia/Calcutta');
class HandlerOrderController extends Controller
{
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
        $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
        $this->user_id = Auth::user()->id;
        $this->user_name = Auth::user()->name;
        $this->user_email = Auth::user()->email;
        $this->is_admin = Auth::user()->is_admin;
        $this->user_callsigns = Auth::user()->user_callsigns;
    }
    public function index()
    {

      $current_date=date('ymd'); 
      $data=FlightPlanDetailsModel::where('date_of_flight',$current_date)->orderBy('date_of_flight', 'desc')
                           ->orderBy('departure_time_hours', 'desc')
                           ->orderBy('departure_time_minutes', 'desc')->get();
      $i=1;
      $result=array();
      foreach($data as $handling_d)
      {
            $arrival_time=$this->ArrivalTime($handling_d->departure_time_hours,$handling_d->total_flying_hours,$handling_d->departure_time_minutes,$handling_d->total_flying_minutes);
            if($handling_d->destination_aerodrome=='ZZZZ')
              $aero=(string)$handling_d->destination_station;
            else
              $aero=(string)$handling_d->destination_aerodrome;  
            $handler=Handler::where('airport_code',$aero)->where('callsign',$handling_d->aircraft_callsign)->first();
            if(count($handler)>0){
              $handler_name=$handler->handler_name;
              $handler_id=$handler->id;
              $basic_rate=$handler->basic_rate;
              $royalty=$handler->royalty;
              $tax=$handler->gst_amount;
              $total=$handler->total;
              $city=$handler->city;
            }
            else{
                $handler_name='';
                  $handler_id='';
                  $basic_rate='';
                  $total='';
                  $tax='';
                  $royalty=''; 
                  $city=''; 
            }
            $handling_ordered=HandlerOrderHistoryModel::where('fpl_id',$handling_d->id)->count();
            $result[]=['sr'=>$i++,
                    'display_date_of_flight'=>date('d M',strtotime('20'.$handling_d->date_of_flight)),
                    'date_of_flight'=>$handling_d->date_of_flight,
                    'operator'=>$handling_d->operator,
                    'fpl_id'=>$handling_d->id,
                    'plan_status'=>$handling_d->plan_status,
                    'aircraft_callsign'=>$handling_d->aircraft_callsign,
                    'departure_aerodrome'=>$handling_d->departure_aerodrome,
                    'departure_station'=>$handling_d->departure_station,
                    'destination_aerodrome'=>$handling_d->destination_aerodrome,
                    'destination_station'=>$handling_d->destination_station,
                    'departure_time_hours'=>$handling_d->departure_time_hours,
                    'departure_time_minutes'=>$handling_d->departure_time_minutes,
                    'total_flying_hours'=>$handling_d->total_flying_hours,
                    'total_flying_minutes'=>$handling_d->total_flying_minutes,
                    'arrival_time'=>$arrival_time,
                    'handlername'=>$handler_name,
                    'handler_id'=>$handler_id,
                    'basic_rate'=>$basic_rate,
                    'royalty'=>$royalty,
                    'total'=>$total,
                    'city'=>$city,
                    'aero'=>$aero,
                    'tax'=>$tax,
                    'current_date'=>date('ymd'),
                    'handling_ordered'=>$handling_ordered
                    ];
      }
        return view('handler.order')->with(['handling_data'=>$result]);
    }
   public function Search(Request $request)
   {
         $i=1; $result=array();
         $builder = DB::table('flight_plan_details');
         if($request->has('s_operator')){
              $builder->where('operator',$request->s_operator);
           }
         if($request->has('s_callsign')){
            $builder->where('aircraft_callsign',$request->s_callsign);
            }
         if($request->has('from_date')){
            $from_date=date('ymd',strtotime($request->from_date));
           
            $builder->where('date_of_flight','>=',$from_date);
           }
         if($request->has('to_date')){
             $to_date=date('ymd',strtotime($request->to_date));
             $builder->where('date_of_flight','<=',$to_date);
           }
         if($request->has('s_ordered')){
            $destination=substr($request->s_ordered,0,4);
            $builder->where('destination_aerodrome','like', '%'.$destination. '%')
                     ->orWhere('destination_station','like',"%".$destination."%");
                 
           }
          if($request->has('handler'))
          {
              //  $handlinglist=$builder->orderBy('operator','asc')->Has('handlers1')->whereHas('handlers',function($query) use($request){
              //    $query->where('handler_name',$request->handler);
              // })->get();
               $handlinglist=$builder ->join('handlers AS a', 'a.airport_code', '=', 'flight_plan_details.destination_aerodrome')
                           ->join('handlers AS b', 'b.callsign', '=', 'flight_plan_details.aircraft_callsign')
                           ->where('a.handler_name',$request->handler)
                           ->orderBy('date_of_flight', 'desc')
                           ->orderBy('departure_time_hours', 'desc')
                           ->orderBy('departure_time_minutes', 'desc')->get();
          }
          else
          {
               $handlinglist=$builder->orderBy('date_of_flight', 'desc')
                                     ->orderBy('departure_time_hours', 'desc')
                                     ->orderBy('departure_time_minutes', 'desc')->get();
               // $handlinglist=$builder ->leftJoin('handlers AS a', 'a.airport_code', '=', 'flight_plan_details.destination_aerodrome')
               //             ->leftJoin('handlers AS b', 'b.callsign', '=', 'flight_plan_details.aircraft_callsign')->orderBy('operator','asc')
               //             ->get();
          } 

           foreach ($handlinglist as $handling_d) {
              $arrival_time=$this->ArrivalTime($handling_d->departure_time_hours,$handling_d->total_flying_hours,$handling_d->departure_time_minutes,$handling_d->total_flying_minutes);
              if($handling_d->destination_station=='ZZZZ')
                $aero=(string)$handling_d->destination_station;
              else
                $aero=(string)$handling_d->destination_aerodrome;  
              if($request->has('handler')){
                $handler_name=$handling_d->handler_name;
                $handler_id=$handling_d->id;
                $basic_rate=$handling_d->basic_rate;
                $royalty=$handling_d->royalty;
                $tax=$handling_d->gst_amount;
                $total=$handling_d->total;
                $city=$handling_d->city;
              }
              else{
                    $handler=Handler::where('airport_code',$aero)->where('callsign',$handling_d->aircraft_callsign)->first();
                    if(count($handler)>0){
                      $handler_name=$handler->handler_name;
                      $handler_id=$handler->id;
                      $basic_rate=$handler->basic_rate;
                      $royalty=$handler->royalty;
                      $tax=$handler->gst_amount;
                      $total=$handler->total;
                      $city=$handler->city;
                    }
                    else{
                        $handler_name='';
                          $handler_id='';
                          $basic_rate='';
                          $total='';
                          $tax='';
                          $royalty=''; 
                          $city=''; 
                     }
              }
              $handling_ordered=HandlerOrderHistoryModel::where('fpl_id',$handling_d->id)->count();
              $result[]=['sr'=>$i++,
                      'display_date_of_flight'=>date('d M',strtotime('20'.$handling_d->date_of_flight)),
                      'date_of_flight'=>$handling_d->date_of_flight,
                      'operator'=>$handling_d->operator,
                      'fpl_id'=>$handling_d->id,
                      'plan_status'=>$handling_d->plan_status,
                      'aircraft_callsign'=>$handling_d->aircraft_callsign,
                      'departure_aerodrome'=>$handling_d->departure_aerodrome,
                      'departure_station'=>$handling_d->departure_station,
                      'destination_aerodrome'=>$handling_d->destination_aerodrome,
                      'destination_station'=>$handling_d->destination_station,
                      'departure_time_hours'=>$handling_d->departure_time_hours,
                      'departure_time_minutes'=>$handling_d->departure_time_minutes,
                      'total_flying_hours'=>$handling_d->total_flying_hours,
                      'total_flying_minutes'=>$handling_d->total_flying_minutes,
                      'arrival_time'=>$arrival_time,
                      'handlername'=>$handler_name,
                      'handler_id'=>$handler_id,
                      'basic_rate'=>$basic_rate,
                      'royalty'=>$royalty,
                      'total'=>$total,
                      'city'=>$city,
                      'aero'=>$aero,
                      'tax'=>$tax,
                      'current_date'=>date('ymd'),
                      'handling_ordered'=>$handling_ordered
                      ];
           }
          
           return view('handler.order')->with(['handling_data'=>$result,'s_operator'=>$request->s_operator,'s_callsign'=>$request->s_callsign,'handler'=>$request->handler,'s_ordered'=>$request->s_ordered,'from_date'=>$request->from_date,'to_date'=>$request->to_date]);

   }
   Public function ArrivalTime($departure_time_hours,$total_flying_hours,$departure_time_minutes,$total_flying_minutes)
   {
       $arrival_hr=(int)$departure_time_hours+(int)$total_flying_hours;
       $arrival_min=(int)$departure_time_minutes+(int)$total_flying_minutes;
        if($arrival_min>=60){
           $arrival_hr=$arrival_hr+1;
           $arrival_min=$arrival_min-60;
        }
        if($arrival_hr>=24)
          $arrival_hr=$arrival_hr-24;
        if(strlen($arrival_min)==1)
            $arrival_min='0'.$arrival_min;
        if(strlen($arrival_hr)==1)
             $arrival_hr='0'.$arrival_hr;
        return $arrival_hr.$arrival_min;
   }
   Public function ArrivalTimeIST($departure_time_hours,$total_flying_hours,$departure_time_minutes,$total_flying_minutes)
   {
       $arrival_hr=(int)$departure_time_hours+(int)$total_flying_hours+5;
       $arrival_min=(int)$departure_time_minutes+(int)$total_flying_minutes+30;


        if($arrival_min>=60){
           $arrival_hr=$arrival_hr+1;
           $arrival_min=$arrival_min-60;
        }
        if($arrival_hr>=24)
          $arrival_hr=$arrival_hr-24;
        if(strlen($arrival_min)==1)
            $arrival_min='0'.$arrival_min;
        if(strlen($arrival_hr)==1)
             $arrival_hr='0'.$arrival_hr;
        return $arrival_hr.':'.$arrival_min;
   }
   Public function ArrivalTimeISTRoundOff($departure_time_hours,$total_flying_hours,$departure_time_minutes,$total_flying_minutes)
   {
       $arrival_hr=(int)$departure_time_hours+(int)$total_flying_hours+5;
       $arrival_min=(int)$departure_time_minutes+(int)$total_flying_minutes+30;
       $mod = $arrival_min%10;
       if($mod<5)
          $arrival_min=($arrival_min+5)-$mod;
       elseif($mod>5)
           $arrival_min=$arrival_min+(10-$mod);


        if($arrival_min>=60){
           $arrival_hr=$arrival_hr+1;
           $arrival_min=$arrival_min-60;
        }
        if($arrival_hr>=24)
          $arrival_hr=$arrival_hr-24;
        if(strlen($arrival_min)==1)
            $arrival_min='0'.$arrival_min;
        if(strlen($arrival_hr)==1)
             $arrival_hr='0'.$arrival_hr;
        return $arrival_hr.':'.$arrival_min;
   }
  public function order(Request $request) {
      $fpl_id=$request->fplid;  
      $handler_id=$request->handler_id;  
      $history_data = [
          'fpl_id' => $fpl_id,
          'user_id' => Auth::user()->id,
          'remarks' => $request->remarks,
          'handler_id'=>$handler_id
      ];
      $result = FlightPlanDetailsModel::where('id', $fpl_id)
              ->first();
      $aircraft_callsign = ($result) ? $result->aircraft_callsign : "";
      $destination_aerodrome = ($result) ? $result->destination_aerodrome : "";
      $date_of_flight = ($result) ? $result->date_of_flight : "";
      $date_of_flight = date('d-M-Y', strtotime('20' . $date_of_flight));
      $registration = ($result) ? $result->registration : "";
      $operator = ($result) ? $result->operator : "";
      $history = HandlerOrderHistoryModel::create($history_data);
      $email = $this->user_email;
      $user_name = $this->user_name;
      $subject = "$aircraft_callsign GROUND HANDLING REQUEST at $destination_aerodrome // $date_of_flight";
      $entered_date = date('d-M-Y');
      $entered_time = date('H:i:s');
      $entered_time = Carbon::parse($entered_time);
      //$entered_time = $entered_time->addHours(5)->addMinutes(30);
      $entered_time = date('H:i', strtotime($entered_time)); 
      $arrival_time=$this->ArrivalTimeISTRoundOff($result->departure_time_hours,$result->total_flying_hours,$result->departure_time_minutes,$result->total_flying_minutes);
      $airport= DB::table('airport_list')->where('airport_code',$destination_aerodrome)->first();
      if(count($airport)>0)
        $airport_name=$airport->airport_city;
      else
        $airport_name='';

      $data = ['email' => $email, 'subject' => $subject,
          'destination_aerodrome' => $destination_aerodrome, 'aircraft_callsign' => $aircraft_callsign,
          'date_of_flight' => $date_of_flight, 'operator' => $operator,'airport_name'=>$airport_name,
          'registration' => $registration, 'entered_by' => $user_name,
          'entered_date' => $entered_date, 'entered_time' => $entered_time,'arrival_time'=>$arrival_time,'remarks' => $request->remarks,
      ];
      Log::info('FuelOrderJob started!');
      dispatch(new HandlerOrderJob($data));
      Log::info('FuelOrderJob ended!');
      return response()->json(['success' => true, 'message' => 'HANDLER ORDER PLACED SUCCESSFULLY!']);
  }
  public function OrderHistory(Request $request)
  {
       $fpl_id=$request->fplid;
       $offset=$request->start;
       $length=$request->length;
       $handler_order_history_count=HandlerOrderHistoryModel::where('fpl_id',$fpl_id)->count();
       $handler_order_history_list=HandlerOrderHistoryModel::where('fpl_id',$fpl_id)->offset($offset)
                      ->limit(10)->get();
        $i=$request->start+1;
        $result=array();
        foreach ($handler_order_history_list as $handler_order) 
        {        
           $result[]=array(
              $i++,
              date('d-M-Y H:i:s',strtotime($handler_order->created_at)),
              $handler_order->user->name);
        }
        $handler_order_list=array(
                 'recordsTotal'=>$handler_order_history_count,'data'=>$result,"recordsFiltered" => $handler_order_history_count);
        return response()->json($handler_order_list);
  }
  public function HandlerInfo(Request $request)
  {
       $handler=$request->handler;
       $callsignlist=Handler::where('handler_name',$handler)->groupBy('callsign')->pluck('callsign');
       $airport_list=Handler::where('handler_name',$handler)->groupBy('airport_code')->pluck('airport_code');
       $handlerinfo=Handlerinfo::where('handler_name',$handler)->first();
       $data=array('callsignlist'=>$callsignlist,"airport_list" => $airport_list,'handler'=>$handler,'handlerinfo'=>$handlerinfo);
       return response()->json(['success' => true,'data'=>$data]);
  }
  public function UpdateHandlerInfo(Request $request)
  {

      $flight =Handlerinfo::updateOrCreate(
          ['handler_name' =>$request->handler_names],
          $request->all()
      );
      return response()->json(['success' => true]);
  }
  public function AutoSuggestOperator(Request $request)
  {  
      $flight_plan_details = DB::table('flight_plan_details')->groupBy('operator')->get();
      if(count($flight_plan_details)>0)
      {
        foreach ($flight_plan_details as $flight_plan_detail) {
          $data[]=$flight_plan_detail->operator;
        }
      } 
      else
         $data=[];
       return json_encode($data);     
  }  

}
