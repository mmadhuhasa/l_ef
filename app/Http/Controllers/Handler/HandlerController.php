<?php
namespace App\Http\Controllers\Handler;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Handler;
use App\models\Handlerrevision;
use Auth;
use DB;
class HandlerController extends Controller
{
	public function index()
    {
       return view('handler.index');
    }
    public function store(Request $request)
    {
    	$data=['airport_code'=>substr($request->airport_code,0,4),'city'=>substr($request->airport_code,7),'callsign'=>$request->callsign,'handler_name'=>$request->handler_name,'trim_handler_name'=> preg_replace('/\s+/', '', $request->handler_name),'basic_rate'=>$request->basic_rate,'royalty'=>$request->royalty,'gst_amount'=>$request->gst_amount,'total'=>$request->total]; 

        $handler_count=Handler::where('airport_code',substr($request->airport_code,0,4))->where('callsign',$request->callsign)->where('trim_handler_name',preg_replace('/\s+/', '', $request->handler_name))->count();
        if($handler_count>0)
        {
        	return response()->json(array('success' => false,'message' =>"Handler Exist Already"),200);
        }
        else{	
          $handler=Handler::create($data);
          $revisiondata=[
                           'handler_id'=>$handler->id,
                           'user_id'=>Auth::id(),
                           'basic_rate'=>$handler->basic_rate,
                           'callsign'=>$handler->callsign,
                           'handler'=>$handler->handler_name,
                           'royalty'=>$handler->royalty,
                           'status'=>'ADD',
                           'created_at'=>date("Y-m-d H:i:s",strtotime('+330 minute'))
                        ];
          //Handlerrevision::create($revisiondata);    
          return response()->json(array('success' => true,'message' =>"Handler Inserted Successfully"),200);
        }
    }
    public function handlinglist(Request $request)
    {       
          $offset=$request->start;
          $length=$request->length;
          /*$handlercount=Handler::groupBy('airport_code', 'handler_name')->count();
          $handlinglist = Handler::groupBy('airport_code', 'handler_name','total')->orderBy('airport_code','asc')->offset($offset)
                ->limit(10)->get();
          $i=$request->start+1;
          $result=array();
          foreach ($handlinglist as $handling) 
          {   
             $total=$handling->total;
             $handler=$handling->handler_name;
             $airport_code=$handling->airport_code;  
             $callsign_list = Handler::where('airport_code',$airport_code)->where('handler_name',$handler)->where('total',$total)->pluck('callsign');
             $result[]=array(
                $i++,
                $airport_code,
                $handling->city,
                $handler,
                $callsign_list,
                $handling->basic_rate,
                $handling->royalty,
                $handling->gst_amount,
                $total,
                ''
                );
          }*/
          $handlercount=Handler::count();
          $handlinglist=Handler::orderBy('airport_code','asc')->offset($offset)
                ->limit(10)->get();
          $i=$request->start+1;
          $result=array();
          foreach ($handlinglist as $handling) 
          {      
             $result[]=array(
                $i++,
                $handling->airport_code,
                $handling->city,
                $handling->handler_name,
                 $handling->callsign,
                '',
                '',
                '',
                '',
                '<div class="tooltip_rel">
                            <a class="viewhistory" id="historyicon" data-toggle="modal" data-target="#ViewHistory" style="cursor:pointer;" data-id="'.$handling->id.'">
                                <i class="fa fa-history pencil_fuel_price"></i>
                            </a>
                            <span class="p-l-9"></span>
                            <span class="tooltip_edit_position t_vh" style="left:-30px;">History</span>
                            <span class="tooltip_tri_shape2"></span>
                        </div>',

                );
          }
          $handling_list=array('recordsTotal'=>$handlercount,'data'=>$result,"recordsFiltered" => $handlercount);
          return response()->json($handling_list);
    }   
    public function Search(Request $request){

       $builder = Handler::query();
    	 if($request->has('aero')){
    	 	    $airport_code=substr($request->aero,0,4);
            $builder->where('airport_code','like', '%'.$airport_code. '%');
         }
    	 if($request->has('handler') && ($request->search=='first_search' || $request->search=='2nd_search')){
    	    $handler=$request->handler;
    	  	$builder->where('handler_name',$handler);
         }
       if($request->has('callsign_info') && $request->search=='2nd_search'){
    	    $callsign=$request->callsign_info;
    	  	$builder->where('callsign',$callsign);
         }
         //$handlinglist = $builder->orderBy('airport_code','asc')->get();
         $handlinglist =  $builder->groupBy('airport_code', 'handler_name','total')->orderBy('airport_code','asc')->get();
         $result=array();
         foreach ($handlinglist as $handling) 
         {   
            $total=$handling->total;
            $handler=$handling->handler_name;
            $airport_code=$handling->airport_code;  
            if($request->has('callsign_info') && $request->search=='2nd_search')
             $callsign_list = Handler::where('total',$total)->where('handler_name',$handler)->where('callsign',$callsign)->groupBy('callsign')->pluck('callsign');
             else
               $callsign_list = Handler::where('total',$total)->where('handler_name',$handler)->groupBy('callsign')->pluck('callsign');
            $result[]=array(
             'airport_code'=>$airport_code,
             'city'=>  $handling->city,
             'handler_name'=>$handler,
             'callsign_list'=>$callsign_list,
             'basic_rate'=>$handling->basic_rate,
             'royalty'=>$handling->royalty,
             'gst'=>$handling->gst_amount,
             'total'=>$total,
             'id'=>$handling->id
               );
         }         
         return view('handler.search')->with(['handlinglist'=>$result,'aero'=>$request->aero,'handler'=>$request->handler,'callsign'=>$request->callsign_info]); 
    } 
    public function Update(Request $request){
        $id=$request->id;
        $handler_count=Handler::where('airport_code',$request->airport_code)->where('callsign',$request->callsign)->where('trim_handler_name',preg_replace('/\s+/', '', $request->handler_name))->where('id','!=',$id)->count();
        if($handler_count>0)
        {
          return response()->json(array('success' => false,'message' =>"Handler Exist Already"),200);
        }
        else{
            $handler=Handler::find($id);
            $data=['basic_rate'=>$request->basic_rate,
                   'royalty'=>$request->royalty,
                   'gst_amount'=>$request->gst_amount,
                   'total'=>$request->total];
           
            $handler_id_list=Handler::where('handler_name',$handler->handler_name)->where('total',$handler->total)->pluck('id');

            if($handler->basic_rate != $request->basic_rate)
                $revisiondata['basic_rate']=$request->basic_rate;
            /*if($handler->callsign != strtoupper($request->callsign))
                $revisiondata['callsign']=strtoupper($request->callsign);

            if($handler->handler_name != strtoupper($request->handler_name)){           
                $revisiondata['handler']=strtoupper($request->handler_name);
            }*/
            if($handler->royalty != $request->royalty)
                $revisiondata['royalty']=$request->royalty;  
           
            $revisiondata['status']='EDIT'; 
            $revisiondata['user_id']=Auth::id();
            if($handler->basic_rate != $request->basic_rate || $handler->royalty != $request->royalty)
            { 
              foreach ($handler_id_list as $handler_id) { 
                $revisiondata['handler_id']=$handler_id;
                $revisiondata['created_at']=date("Y-m-d H:i:s",strtotime('+330 minute'));
                 Handlerrevision::create($revisiondata);   
              }
            }  
            Handler::whereIn('id',$handler_id_list)->update($data);
            return response()->json(array('success' => true,'message' =>"Handler Updated Successfully"),200);
       }
    }
    public function UpdateHandler(Request $request)
    {
        $handler_count=Handler::where('airport_code',substr($request->airport_code,0,4))->where('callsign',$request->callsign)->where('trim_handler_name',preg_replace('/\s+/', '', $request->handler_name))->count();
        if($handler_count>0)
        {
          return response()->json(array('success' => false,'message' =>"Handler Exist Already"),200);
        }
          $handler=Handler::where('airport_code',substr($request->airport_code,0,4))->where('callsign',$request->callsign)->update(['handler_name'=>$request->handler_name,'trim_handler_name'=>preg_replace('/\s+/', '', $request->handler_name)]);
         return response()->json(['success'=>true,'message'=>'Handler name updated Successfully']);
    }
    public function ViewHistory(Request $request)
    {       
          $handlerid=$request->handlerid;
          $offset=$request->start;
          $length=$request->length;
          $revision_count=Handlerrevision::where('handler_id',$handlerid)->count();
          $revision_list=Handlerrevision::where('handler_id',$handlerid)->orderBy('created_at','desc')->offset($offset)
                ->limit(10)->get();
          $i=$request->start+1;
          $result=array();
          foreach ($revision_list as $revision) 
          {        
             $result[]=array(
                $i++,
                $revision->status,
                $revision->callsign,
                $revision->handler,
                $revision->basic_rate,
                $revision->royalty ? $revision->royalty.' %' : '' , 
                date('d-M-Y H:i:s',strtotime($revision->created_at)).' IST',
                $revision->user->name);
             }
           $list=array(
                 'recordsTotal'=>$revision_count,'data'=>$result,"recordsFiltered" => $revision_count);
            return response()->json($list);
          
    }    
    public function AutoSuggestHandler(Request $request)
    {  
        $handlers = DB::table('handlers')->groupBy('handler_name')->get();
        if(count($handlers)>0)
        {
          foreach ($handlers as $handler) {
            $data[]=$handler->handler_name;
          }
        } 
        else
           $data=[];
         return json_encode($data);     
    }  
    public function AutoSuggestHandlerAirportcode(Request $request)
    {  
        $handlers = DB::table('handlers')->where('airport_code',substr($request->airport_code,0,4))->groupBy('handler_name')->get();

        if(count($handlers)>0)
        {
          foreach ($handlers as $handler) {
            $data[]=$handler->handler_name;
          }
        }  
        else
           $data=[];
         return json_encode($data);     
    }  
    public function AutoSuggestCallsignAirportcode(Request $request)
    {  
        $handlers = DB::table('handlers')->where('airport_code',substr($request->airport_code,0,4))->groupBy('callsign')->get();

        if(count($handlers)>0)
        {
          foreach ($handlers as $handler) {
            $data[]=$handler->callsign;
          }
        }  
        else
           $data=[];
         return json_encode($data);     
    }  
    public function AutoSuggestHandlerCallsignAirportcode(Request $request)
    {  
        $handlers = DB::table('handlers')->where('airport_code',substr($request->airport_code,0,4))->where('handler_name','!=',$request->handler)->groupBy('handler_name')->get();
        if(count($handlers)>0)
        {
          foreach ($handlers as $handler) {
            $data[]=$handler->handler_name;
          }
        }  
        else
           $data=[];
         return json_encode($data);     
    }  
    public function AutoSuggestCallsign(Request $request)
    {  
        $handlers = DB::table('flight_plan_details')->groupBy('aircraft_callsign')->get();
        if(count($handlers)>0)
        { 
          foreach ($handlers as $handler) {
            $data[]=$handler->aircraft_callsign;
          }
        }
        else
           $data=[];
         return json_encode($data);     
    }  
}
