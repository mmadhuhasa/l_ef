<?php
namespace App\Http\Controllers\Emailtracker;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Emailtracker;
use App\models\Emailtrackerrevision;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Log;
date_default_timezone_set('Asia/Kolkata');
class EmailtrackerController extends Controller
{
    public function index()
    {
       $resultlist=$this->email_tracker_list('URGENT');	
       return view('emailtracker.email')->with(['resultlist'=>$resultlist,'status'=>'URGENT']);
    }
    public function store(Request $request)
    {
    	 $emailtracker=new Emailtracker();
    	 $emailtracker->type=$request->type;
    	 $emailtracker->operator=$request->operator;
    	 $emailtracker->subject=$request->subject;
    	 $emailtracker->completed_time=$request->completed_time;
    	 $emailtracker->remarks=$request->remarks;
    	 $emailtracker->status=$request->status;
    	 $emailtracker->callsign=$request->callsign;
    	 $emailtracker->email_date=date('Ymd',strtotime($request->email_date));
    	 $emailtracker->email_completed_by=date('Ymd',strtotime($request->email_complete_by));
    	 $emailtracker->save();
         $revisiondata=[
              'emailtracker_id'=>$emailtracker->id,
              'user_id'=>Auth::id(),
              'type'=>$request->type,
              'subject'=>$request->subject,
              'completed_time'=>$request->hhcompleted_time."".$request->mmcompleted_time,
              'status'=>$request->status,
              'callsign'=>$request->callsign,
              'email_date'=>date('Ymd', strtotime($request->email_date)),
              'action'=>'ADD',
              'created_at'=>date("Y-m-d H:i:s",strtotime('+330 minute'))
          ];
         Emailtrackerrevision::create($revisiondata);
         $request->session()->flash('msg','Email Tracker Added Successfully'); 
         return response()->json(array('success' => true,'message' =>"Email Tracker Inserted Successfully"),200);
    }	
    public function email_tracker_list($type)
    {
    	$current_date=date('Ymd');

    	$email_trackerlist=Emailtracker::where('email_date','>=',$current_date)->where('status',$type)->orderBy('email_date', 'asc')->get();
    	$urgent_trackerlist_count=Emailtracker::where('email_date','>=',$current_date)->where('status','URGENT')->orderBy('email_date', 'asc')->count();
    	$pending_trackerlist_count=Emailtracker::where('email_date','>=',$current_date)->where('status','PENDING')->orderBy('email_date', 'asc')->count();
    	$done_trackerlist_count=Emailtracker::where('email_date','>=',$current_date)->where('status','DONE')->orderBy('email_date', 'asc')->count();

    	return ['email_trackerlist'=>$email_trackerlist,'urgent_trackerlist_count'=>$urgent_trackerlist_count,'pending_trackerlist_count'=>$pending_trackerlist_count,'done_trackerlist_count'=>$done_trackerlist_count,'callsign'=>'','operator'=>'','from_date'=>'','to_date'=>'','last_active_btn'=>'','type'=>''];
    }
    public function filter(Request $request)
    {
         $filter=$request->filter;

         $builder = Emailtracker::query();
         $urgent_builder = Emailtracker::query();
         $pending_builder = Emailtracker::query();
         $done_builder = Emailtracker::query();
         if($filter=="search"||$filter=="2nd_search"||$filter=="PENDING"||$filter=="URGENT"||$filter=="DONE"){
          //echo "first";
         	   if($request->has('operator')){
              //echo "A"."<br>";
           	    $builder->where('operator',$request->operator);
           	    $urgent_builder->where('operator',$request->operator);
           	    $pending_builder->where('operator',$request->operator);
           	    $done_builder->where('operator',$request->operator);
              }
              if($request->has('type')){
                  //echo "B"."<br>";
                  $builder->where('type',$request->type);
                  $urgent_builder->where('type',$request->type);
           	      $pending_builder->where('type',$request->type);
           	      $done_builder->where('type',$request->type);
              }
         	    if($request->has('callsign')){
                //echo "C"."<br>";
           	    $builder->where('callsign','like', '%'.$request->callsign.'%'); 
           	    $urgent_builder->where('callsign','like', '%'.$request->callsign.'%');
           	    $pending_builder->where('callsign','like', '%'.$request->callsign.'%');
           	    $done_builder->where('callsign','like', '%'.$request->callsign.'%');
              }
               if($filter=="PENDING"||$filter=="URGENT"||$filter=="DONE"||$filter=="search"){
                //echo "2nd";
          	    $status=$filter;
          	    $current_date=date('Ymd');
          	    if(($request->from_date=='' && $request->to_date=='')||($filter=="search"))
          	    {
                   //echo "D"."<br>";
            			$builder->where('email_date','>=',$current_date);  
            			$urgent_builder->where('email_date','>=',$current_date);  
            			$pending_builder->where('email_date','>=',$current_date);  
            			$done_builder->where('email_date','>=',$current_date);  
                }
              }
         }
          if($filter=="2nd_search"||$filter=="PENDING"||$filter=="URGENT"||$filter=="DONE"){
            //echo "3rd";
           	if($request->has('from_date')){
                 //echo "E"."<br>";
                 $builder->where('email_date','>=',date('Ymd', strtotime($request->from_date)));
                 $urgent_builder->where('email_date','>=',date('Ymd', strtotime($request->from_date)));
                 $pending_builder->where('email_date','>=',date('Ymd', strtotime($request->from_date)));
                 $done_builder->where('email_date','>=',date('Ymd', strtotime($request->from_date))); 
           	}
            if($request->has('to_date')){
                 //echo "F"."<br>";
                $builder->where('email_date','<=',date('Ymd', strtotime($request->to_date))); 
                $urgent_builder->where('email_date','<=',date('Ymd', strtotime($request->to_date)));
                $pending_builder->where('email_date','<=',date('Ymd', strtotime($request->to_date)));
                $done_builder->where('email_date','<=',date('Ymd', strtotime($request->to_date))); 
            }
         }
         if($filter=="PENDING"||$filter=="URGENT"||$filter=="DONE"){
              //echo "G"."<br>";
         	    $status=$filter;
              $builder->where('status',$status);   
          }
          elseif($filter=="search"||$filter=="2nd_search")
          {
               //echo "H"."<br>";
              $status='URGENT';
              $builder->where('status',$status); 
          }
         else{
            // echo "I"."<br>";
         	   $status='';
             //$builder->where('status','URGENT');
         }
         
         $email_trackerlist = $builder->orderBy('email_date', 'asc')->get();

         $urgent_trackerlist_count=$urgent_builder->where('status','URGENT')->count();
         $pending_trackerlist_count=$pending_builder->where('status','PENDING')->count();
        // echo $pending_trackerlist_count;
         $done_trackerlist_count=$done_builder->where('status','DONE')->count();
         $resultlist=[ 
                 'email_trackerlist'=>$email_trackerlist,
                 'urgent_trackerlist_count'=>$urgent_trackerlist_count,
                 'pending_trackerlist_count'=>$pending_trackerlist_count,
                 'done_trackerlist_count'=>$done_trackerlist_count,
                 'callsign'=>$request->callsign,
                 'type'=>$request->type,
                 'operator'=>$request->operator,
                 'from_date'=>$request->from_date,
                 'to_date'=>$request->to_date,
                 'last_active_btn'=>$request->filter,
                 ];

         return view('emailtracker.email')->with(['resultlist'=>$resultlist,'status'=>$status]);
    }
    public function update(Request $request)
    {

    	 $id=$request->id;
         $type=preg_replace('/\s+/', '', $request->type);
         $status=preg_replace('/\s+/', '', $request->status);
         if($type=="NAVLOG")
         	$type='NAV LOG';
    	 $emailtracker=Emailtracker::find($id);
       $revisiondata=array();
    	 if($emailtracker->callsign != $request->callsign)
    	     $revisiondata['callsign']=$request->callsign;
   
    	 if($emailtracker->subject != $request->subject)
    	     $revisiondata['subject']=$request->subject;
              
    	 if($emailtracker->type != $type)
    	     $revisiondata['type']=$type;

    	 if($emailtracker->email_date != date('Ymd', strtotime($request->email_date)))
    	     $revisiondata['email_date']=date('Ymd', strtotime($request->email_date));
    	 
      if(count($revisiondata)>0){
    	   $revisiondata['action']='EDIT'; 
    	   $revisiondata['emailtracker_id']=$id;
    	   $revisiondata['user_id']=Auth::id();
    	   $revisiondata['created_at']=date("Y-m-d H:i:s",strtotime('+330 minute'));
       }
    	 if($emailtracker->type==$type && $emailtracker->status==$status && $emailtracker->operator==$request->operator && $emailtracker->subject==$request->subject && $emailtracker->completed_time==$request->completed_time && $emailtracker->remarks==$request->remarks && $emailtracker->callsign==$request->callsign && $emailtracker->email_date==date('Ymd', strtotime($request->email_date)) && $emailtracker->email_completed_by==date('Ymd', strtotime($request->email_complete_by))){
    	  return response()->json(array('success' => true,'msg'=>"NO data to update"),200);      
    	 }
    	 else{
        if(count($revisiondata)>0)
    	   Emailtrackerrevision::create($revisiondata);  
    	 $emailtracker->type=$type;
    	 $emailtracker->operator=$request->operator;
    	 $emailtracker->subject=$request->subject;
    	 $emailtracker->completed_time=$request->completed_time;
    	 $emailtracker->remarks=$request->remarks;
    	 $emailtracker->status=$status;
    	 $emailtracker->callsign=$request->callsign;
    	 $emailtracker->email_date=date('Ymd',strtotime($request->email_date));
    	 $emailtracker->email_completed_by=date('Ymd',strtotime($request->email_complete_by));
    	 $emailtracker->save();
    	 $request->session()->flash('msg','Email Tracker Updated Successfully');
         return response()->json(array('success' => true,'message' =>"Email Tracker Updated Successfully"),200);
      }
    }	
    public function delete(Request $request)
    {
    	 $id=$request->id;
    	 $email_tracker=Emailtracker::find($id);
    	 $email_tracker->action=1;
    	 $email_tracker->save();
         $revisiondata['action']="DELETE"; 
         $revisiondata['emailtracker_id']=$id;
         $revisiondata['user_id']=Auth::id();
         $revisiondata['created_at']=date("Y-m-d H:i:s",strtotime('+330 minute'));
    	 Emailtrackerrevision::create($revisiondata);  
    	 $request->session()->flash('msg','Email Tracker Deleted Successfully'); 
         return response()->json(array('success' => true,'message' =>"Email Tracker Deleted Successfully"),200);
    }
    public function ViewHistory(Request $request)
    {       
          $id=$request->emailtracker_id;
          $offset=$request->start;
          $length=$request->length;
          $emailtracker_list_count=Emailtrackerrevision::where('emailtracker_id',$id)->count();
          $emailtracker_list=Emailtrackerrevision::where('emailtracker_id',$id)->orderBy('created_at','desc')->offset($offset)
                ->limit(10)->get();
          $i=$request->start+1;
          $result=array();
          foreach ($emailtracker_list as $emailtracker) 
          { 
          	 $result[]=array(
          	    $i++,
          	    $emailtracker->action,
          	    $emailtracker->callsign,
          	    $emailtracker->subject,
          	    $emailtracker->email_date ? date('d-M-Y',strtotime($emailtracker->email_date)) : '',
          	    $emailtracker->type,
          	    date('d-M-Y H:i:s',strtotime($emailtracker->created_at)),
          	    $emailtracker->user->name);
             }
           $tracker_list=array(
                 'recordsTotal'=>$emailtracker_list_count,'data'=>$result,"recordsFiltered" => $emailtracker_list_count);
            return response()->json($tracker_list);
          
    }    	
    public function email_tracker_auto_remainder($status) {
        try {
              $data = [];
              $current_date = date('Ymd');
              $current_date2 = date('d-M-Y');
              $caps_status=strtoupper($status);
              $results=Emailtracker::where('email_completed_by','<=',$current_date)
              ->where('status',$caps_status)
              ->orderBy('callsign','asc')->orderBy('email_completed_by','desc')->orderBy('completed_time','asc')
              ->get();
              if(count($results)>0){
                $data['subject'] = $caps_status." EMAIL REMINDER // $current_date2"; 
                $data['results'] = $results;
                $data['status'] = $caps_status;
                Log::info('Email tracker Auto Remainder Starts');
                dispatch(new \App\Jobs\Emailtracker\AutoRemainderEmailJob($data));
                Log::info('Email tracker Auto Remainder Ends');
                return 'success';
             }
             else
              return 'No Data';
          } 
         catch (\Exception $ex) {
            Log::info('test_email: ' . $ex->getMessage());
        }
    }   
    public function email_tracker_auto_remainder_time($status,$completion_time) {
        try {
              $data = [];
              $current_date = date('Ymd');
              $current_date2 = date('d-M-Y');
              $caps_status=strtoupper($status);
              $results=Emailtracker::where('email_completed_by','<=',$current_date)
              ->where('completed_time','<=',$completion_time)
              ->where('status',$caps_status)
              ->orderBy('callsign','asc')->orderBy('email_completed_by','desc')->orderBy('completed_time','asc')
              ->get();
              if(count($results)>0){
                $data['subject'] = $caps_status." EMAIL REMINDER // $current_date2"; 
                $data['results'] = $results;
                $data['status'] = $caps_status;
                Log::info('Email tracker Auto Remainder Starts');
                dispatch(new \App\Jobs\Emailtracker\AutoRemainderEmailJob($data));
                Log::info('Email tracker Auto Remainder Ends');
                return 'success';
             }
             else
              return 'No Data';
          } 
         catch (\Exception $ex) {
            Log::info('test_email: ' . $ex->getMessage());
        }
    }   
    public function email_tracker_auto_remainder_status_conversion() {
        try {
              $data = [];
              $current_date = date('Ymd');
              $current_time = date('Hi');
              $current_timestamp= strtotime(date('Ymd Hi'));
              $results=Emailtracker::where('email_completed_by','<=',$current_date)
              ->where('status','PENDING')
              ->where('action',0)
              ->get();
              foreach ($results as $d) {
                $record_timestamp=strtotime($d->email_completed_by."".$d->completed_time);  
                if($current_timestamp>=$record_timestamp){
                  Emailtracker::find($d->id)->update(['status' => 'URGENT']);
                }
              }
              Log::info('Email tracker Staus Conversion done');
              return 'success';
          } 
         catch (\Exception $ex) {
            Log::info('test_email: ' . $ex->getMessage());
        }
    }   
}
