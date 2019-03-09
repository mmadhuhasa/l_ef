<?php

namespace App\Http\Controllers\Notams;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\WatchHoursModel;
use App\models\WatchHoursAirportModel;
use App\models\Watchhoursrevision;
use DB;
use Mail;
use Response;
use Validator;
use PDF;
use Auth;
class WatchHoursController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function old_index(Request $request) {
        $check  = $request->check;
        if (!isset($request->code)) {
            /*$data = WatchHoursModel::groupBy('aerodrome')->whereIn('aerodrome', ['VABB','VIDP','VOBL','VOBG'])->orderBy('id', 'desc')->groupBy('w_start_date')->groupBy('w_end_date')->get();
            
            foreach ($data as $key => $value) {
                $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
                $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
                $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
            }
            return view('notams.watchhours', array('data' => $data, 'code' => ''));*/
            //dd("hii");
            return view('notams.watchhours', array('data' => '', 'code' => ''));
           
        } 
        /*else if (!empty($request->code)) {
            $current_date = date('Y-m-d');
            $data = WatchHoursModel::whereIn('aerodrome',$request->code)
                    ->where(function($query) use($check,$current_date){
                       if($check != "all"){
                           $query->where('w_start_date','>=',$current_date);
                       } 
                    })
                    ->orderBy('id', 'desc')
                    ->groupBy('aerodrome')
                    ->groupBy('w_start_date')
                    ->groupBy('w_end_date')
                    ->get();
            if(!count($data)){
                $data = WatchHoursModel::where('aerodrome', '=', $request->code)
                    ->orderBy('id', 'desc')
                    ->groupBy('aerodrome')
                    ->groupBy('w_start_date')
                    ->groupBy('w_end_date')->get();
            }
            
        } else {
            
            // $data = WatchHoursModel::groupBy('aerodrome')->groupBy('w_start_date')->groupBy('w_end_date')->get();
            return redirect('/watchhours');
        }
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
        }   
        return view('notams.watchhours', array('data' => $data, 'code' => $request->code, 'check' => $check));*/
    }
    public function search(Request $request){
        if(!empty($request->code)){
            if(is_array($request->code))
             $code=$request->code;
            else
            $code=[$request->code]; 
        }      
        else
            $code=['VABB','VIDP','VOMM','VOBG','VOHS'];
        $data = WatchHoursModel::groupBy('aerodrome')
               ->whereIn('aerodrome',$code)
               ->orderBy('aerodrome')
               ->orderBy('w_start_date')
               ->groupBy('w_start_date')
               ->groupBy('w_end_date')
               ->get();
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['ids']=WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->pluck('id');
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
        }
        $request->session()->put('data', $data);
        return view('notams.watchhours_search', array('data' => $data, 'code' => ''));
    }
    public function newsearch(Request $request){

        if(!empty($request->code)){
            if(is_array($request->code))
             $code=$request->code;
            else
            $code=[$request->code]; 
            //$code=DB::table('watch_hours_aerodrome_list')->whereIn('name',$code)->lists('code'); 
        }      
        else
             $code=['VABB','VIDP','VOMM','VOBG','VOHS'];
        $data = WatchHoursModel::groupBy('aerodrome')
               ->whereIn('aerodrome',$code)
               ->orderBy('aerodrome')
               ->orderBy('w_start_date')
               ->groupBy('w_start_date')
               ->groupBy('w_end_date')
               ->get();
        $datalist=array();       
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
            $value['ids']=WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->pluck('id');

            $datalist[$value['aerodrome']][]=array(
                'watchhours'=>$value['watchhours'],
                'start_date_formatted'=>$value['start_date_formatted'],
                'start_date_timestamp'=>strtotime($value['start_date_formatted']),
                'end_date_formatted'=>$value['end_date_formatted'],
                'end_date_timestamp'=>strtotime($value['end_date_formatted']),
                'id'=>$value->id,
                'aerodrome'=>$value->aerodrome,
                'notam_no'=>$value->notam_no,
                'airport_name'=>WatchHoursAirportModel::where('code',$value->aerodrome)->pluck('name'),
                'notams'=>$value->notams 
                 );
                }             
        foreach ($datalist as $key=>$datal) 
        {
           $loop=count($datal)+count($datal);  
           foreach ($datal as $subkey=>$dl) 
           {
                if($dl['start_date_timestamp']<strtotime(date("y-m-d")) && $dl['end_date_timestamp']<strtotime(date("y-m-d")))
                 {
                    $temp=$datal[$subkey];
                    unset($datalist[$key][$subkey]);
                    $datalist[$key][$loop]=$temp;
                    $loop=$loop-1;
                 }
           } 
           ksort($datalist[$key]); 
        }
        if(empty($request->code))
        $request->session()->put('data', $datalist);
        return view('notams.watchhours_new.watchhours_search', array('datalist' => $datalist, 'code' => ''));
    }
    public function index_old(Request $request) {
        $check  = $request->check;
        if (!isset($request->code)) {
            $data = WatchHoursModel::groupBy('aerodrome')->whereIn('aerodrome', ['VABB','VIDP','VOBL','VOBG'])->orderBy('id', 'desc')->groupBy('w_start_date')->groupBy('w_end_date')->get();
            
            foreach ($data as $key => $value) {
                $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
                $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
                $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
            }
            return view('notams.watchhours', array('data' => $data, 'code' => ''));
           
        } else if (!empty($request->code)) {
            $current_date = date('Y-m-d');
            $data = WatchHoursModel::whereIn('aerodrome',$request->code)
                    // ->where(function($query) use($check,$current_date){
                    //    if($check != "all"){
                    //        $query->where('w_start_date','>=',$current_date);
                    //    } 
                    // })
                    ->orderBy('id', 'desc')
                    ->groupBy('aerodrome')
                    ->groupBy('w_start_date')
                    ->groupBy('w_end_date')
                    ->get();
            if(!count($data)){
                $data = WatchHoursModel::where('aerodrome', '=', $request->code)
                    ->orderBy('id', 'desc')
                    ->groupBy('aerodrome')
                    ->groupBy('w_start_date')
                    ->groupBy('w_end_date')->get();
            }
            
        } else {
            
            // $data = WatchHoursModel::groupBy('aerodrome')->groupBy('w_start_date')->groupBy('w_end_date')->get();
            return redirect('/watchhours');
        }
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
        }   
        return view('notams.watchhours', array('data' => $data, 'code' => $request->code, 'check' => $check));
    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('notams.watchhoursform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//

        $reqData = $request->all();
        if (!isset($reqData['remarks'])) {
            $reqData['remarks'] = '';
        }
        $data = $reqData['data'];
        $overLapFlag = WatchHoursModel::where('aerodrome', '=', $reqData['aerodrome'])
                ->where(function($q) use ($reqData) {
                    $q->whereRaw('? between w_start_date and w_end_date', [$reqData['startAt']])->
                    orWhereRaw('? between w_start_date and w_end_date', [$reqData['endAt']]);
                })
                ->first();
        if ($overLapFlag != false) {
            return array('message' => "Please verify data, It was overlaping previous data", "status" => 0);
        }

        if (WatchHoursModel::where('aerodrome', '=', $reqData['aerodrome'])->where('w_start_date', '=', $reqData['startAt'])->where('w_end_date', '=', $reqData['endAt'])->first() == false) {

            for ($i = 0; $i < sizeof($data); $i++) {
                $data[$i]['aerodrome'] = strtoupper($reqData['aerodrome']);
                $data[$i]['w_start_date'] = $reqData['startAt'];
                $data[$i]['w_end_date'] = $reqData['endAt'];
                $data[$i]['notam_no'] = strtoupper($reqData['notamnumber']);
                $data[$i]['remarks'] = $reqData['remarks'];
                $data[$i]['notams'] = $reqData['notams'];
                $watchhours=WatchHoursModel::create($data[$i]);
                $revisiondata=[
                                 'watchhours_id'=>$watchhours->id,
                                 'user_id'=>Auth::id(),
                                 'status'=>'ADD',
                                 'created_at'=>date("Y-m-d H:i:s",strtotime('+330 minute'))
                              ];
                Watchhoursrevision::create($revisiondata);
            }
        } else {
            return array('message' => "Data for same duration already Exists", "status" => 0);
        }
        return array('message' => "Watch Hours successfully inserted", "status" => 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        dd("kk");
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = WatchHoursModel::where('id', '=', $id)->first();
        $data['start_date_formatted'] = date_format(date_create($data['w_start_date']), "d-M-Y");
        $data['end_date_formatted'] = date_format(date_create($data['w_end_date']), "d-M-Y");
        return view('notams.watchhours_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $dataToBeEdited = WatchHoursModel::find($id);
        $reqData = $request->all();
        $start=date('Ymd',strtotime($reqData['startAt']));
        $end=date('Ymd',strtotime($reqData['endAt']));
        $notams_no=substr(trim($reqData['notams']),0,8);
        $notams_alpha_check=preg_match('/^[a-zA-Z]$/',substr($notams_no,0,1));
        $notams_numeric_check=is_numeric(substr($notams_no,1,4));
        $notams_slash_check=substr($notams_no,5,1);
        $notams_numeric1_check=is_numeric(substr($notams_no,6,2));
        if($notams_alpha_check==0 || $notams_numeric_check==false || $notams_slash_check!="/" || $notams_numeric1_check==false)
         return array('message' => "Notams is Not Proper", "status" => 0);
         
        $notams=WatchHoursModel::where('notams', 'like','%'.$notams_no.'%')->first();
        if(isset($notams)){
            if((($notams->w_start_date==$start)&&($notams->w_end_date==$end)&&($dataToBeEdited['aerodrome']==$reqData['aerodrome']))){
              
            }
            else{
                 if($notams->count()>=1)
                 return array('message' => "NOTAM number duplicate not allowed", "status" => 0);
            }
        }
        if(($dataToBeEdited['aerodrome'] == $reqData['aerodrome']) &&(($dataToBeEdited['w_start_date']==$start)||($dataToBeEdited['w_end_date']==$end))){
            WatchHoursModel::where('aerodrome', '=', $dataToBeEdited['aerodrome'])->where('w_start_date', '=', $dataToBeEdited['w_start_date'])->where('w_end_date', '=', $dataToBeEdited['w_end_date'])->delete();
        }
       
        if (!isset($reqData['remarks'])) {
            $reqData['remarks'] = '';
        }
        $data = $reqData['data'];

        // $overLapFlag = WatchHoursModel::where('aerodrome', '=', $reqData['aerodrome'])
        //         ->where(function($q) use ($reqData) {
        //             $q->whereRaw('? between w_start_date and w_end_date', [$reqData['startAt']])->
        //             orWhereRaw('? between w_start_date and w_end_date', [$reqData['endAt']]);
        //         })
        //         ->first();
         $overLapFlag = WatchHoursModel::where('aerodrome', '=', $reqData['aerodrome'])
                ->where(function($q) use ($start,$end) {
                    $q->whereRaw('? between w_start_date and w_end_date', [$start])->
                    orWhereRaw('? between w_start_date and w_end_date', [$end]);
                })
                ->first();
        
        $overLapFlag1=WatchHoursModel::where('aerodrome',$reqData['aerodrome']) 
                   ->where('w_start_date','>=',$start)
                   ->where('w_end_date','<=',$end)
                    ->first();        
        if (($overLapFlag != false)||($overLapFlag1!=false)) {
            return array('message' => "Please verify data, It was overlaping previous data", "status" => 0);
        }

        if (WatchHoursModel::where('aerodrome', '=', $reqData['aerodrome'])->where('w_start_date', '=', $reqData['startAt'])->where('w_end_date', '=', $reqData['endAt'])->first() == false) {

            for ($i = 0; $i < sizeof($data); $i++) {
                $data[$i]['aerodrome'] = strtoupper($reqData['aerodrome']);
                $data[$i]['w_start_date'] = date('Ymd',strtotime($reqData['startAt']));
                $data[$i]['w_end_date'] = date('Ymd',strtotime($reqData['endAt']));
                $data[$i]['notams'] = strtoupper($reqData['notams']);
                // $data[$i]['notam_no'] = strtoupper($reqData['notamnumber']);
                $data[$i]['remarks'] = $reqData['remarks'];
                $watchhours=WatchHoursModel::create($data[$i]);
               

                if($i==0){
                    Watchhoursrevision::where('watchhours_id',$id)->update(['watchhours_id'=>$watchhours->id]);
                }
                $revision_count=Watchhoursrevision::where('watchhours_id',$watchhours->id)->count();                 
                if($revision_count==0)
                    $status="ADD";
                else
                    $status="EDIT";
                 $revisiondata=[
                                 'watchhours_id'=>$watchhours->id,
                                 'user_id'=>Auth::id(),
                                 'status'=>$status,
                                 'created_at'=>date("Y-m-d H:i:s",strtotime('+330 minute'))
                              ];
                Watchhoursrevision::create($revisiondata);
            }
        } else {
            return array('message' => "Data for same duration already Exists", "status" => 0);
        }
        return array('message' => "Watch Hours successfully updated", 'airport_name'=>WatchHoursAirportModel::where('code',$reqData['aerodrome'])->pluck('name'),  "status" => 1);
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

    public function getpreviousdata(Request $request) {
         $current_date=date('Y-m-d');
         $no_of_records=3;
         $PreviousData = WatchHoursModel::where('aerodrome', '=', $request->code)
                 ->groupBy('aerodrome')
                 ->groupBy('w_start_date')
                 ->groupBy('w_end_date')
                 ->where('w_start_date','<',$current_date)
                 ->where('w_end_date','<',$current_date)
                 ->orderBy('w_start_date','desc')
                 ->limit(1)
                 ->get();     
         if($PreviousData->count()>0){
            $no_of_records=$no_of_records-1;
          }
         $CurrentData = WatchHoursModel::where('aerodrome', '=', $request->code)
                 ->groupBy('aerodrome')
                 ->groupBy('w_start_date')
                 ->groupBy('w_end_date')
                 ->where('w_start_date','>=',$current_date)
                 ->where('w_end_date','<=',$current_date)
                 ->get();             
         if($CurrentData->count()>0){
            $no_of_records=$no_of_records-1;
            }
          $FutureData = WatchHoursModel::where('aerodrome', '=', $request->code)
                 ->groupBy('aerodrome')
                 ->groupBy('w_start_date')
                 ->groupBy('w_end_date')
                 ->where('w_start_date','>',$current_date) 
                 ->limit($no_of_records)
                 ->get();     
            $data=array(); 

           if($PreviousData!=null){
            foreach ($PreviousData as $d) {
               $city=WatchHoursAirportModel::where('code',$d->aerodrome)->pluck('name');
                 $data[]=array(
                    'start_date_formatted'=>date_format(date_create($d->w_start_date), "d-M-Y"),
                    'end_date_formatted'=>date_format(date_create($d->w_end_date), "d-M-Y"),
                    'aerodrome'=>$d->aerodrome." - ".$city[0]
                 );
             }
           } 
           if($CurrentData!=null){
            
            foreach ($CurrentData as $d) {
                $city=WatchHoursAirportModel::where('code',$d->aerodrome)->pluck('name');
                 $data[]=array(
                    'start_date_formatted'=>date_format(date_create($d->w_start_date), "d-M-Y"),
                    'end_date_formatted'=>date_format(date_create($d->w_end_date), "d-M-Y"),
                   'aerodrome'=>$d->aerodrome." - ".$city[0]
                 );
             }
           }  
           if($FutureData!=null){
            
            foreach ($FutureData as $d) {
                $city=WatchHoursAirportModel::where('code',$d->aerodrome)->pluck('name');
                 $data[]=array(
                    'start_date_formatted'=>date_format(date_create($d->w_start_date), "d-M-Y"),
                    'end_date_formatted'=>date_format(date_create($d->w_end_date), "d-M-Y"),
                    'aerodrome'=>$d->aerodrome." - ".$city[0]
                 );
             }
           }     

         /*foreach ($watchhoursData as $key) {
             $key['start_date_formatted'] = date_format(date_create($key['w_start_date']), "d-M-Y");
             $key['end_date_formatted'] = date_format(date_create($key['w_end_date']), "d-M-Y");
         }
         return $watchhoursData;

         $watchhoursData = WatchHoursModel::where('aerodrome', '=', $request->code)
                ->groupBy('aerodrome')
                ->groupBy('w_start_date')
                ->groupBy('w_end_date')
                ->get();
        foreach ($watchhoursData as $key) {
            $key['start_date_formatted'] = date_format(date_create($key['w_start_date']), "d-M-Y");
            $key['end_date_formatted'] = date_format(date_create($key['w_end_date']), "d-M-Y");
        }*/
        return $data;
    }

    public function getWatchhoursInfo(Request $request) {
        $id = $request->id;
        $data = WatchHoursModel::where('id', '=', $id)->first();
        $data['start_date_formatted'] = date_format(date_create($data['w_start_date']), "d-M-Y");
        $data['end_date_formatted'] = date_format(date_create($data['w_end_date']), "d-M-Y");
        $data['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $data['aerodrome'])->where('w_start_date', '=', $data['w_start_date'])->where('w_end_date', '=', $data['w_end_date'])->get());

        return $data;
    }

    public function aerodromeList(Request $request) {
        $aerodromeList = array();
        $data = DB::select("select * from watch_hours_aerodrome_list");
        foreach ($data as $key) {
            // array_push($aerodromeList, $key->code);
           $aerodromeList[]=array('label'=>$key->code,'value'=> $key->code.' - '.$key->name);
        }
        return $aerodromeList;
    }

    public function utc_to_ist($time) {
        // echo $time;
        $start = trim(explode("-", $time)[0]);
        $end = trim(explode("-", $time)[1]);
        $start_ist = date_format(date_add(date_create($start), date_interval_create_from_date_string("330 minutes")), 'Hi');
        $end_ist = date_format(date_add(date_create($end), date_interval_create_from_date_string("330 minutes")), 'Hi');
        return "UTC (" . $start_ist . " - " . $end_ist . " IST)";
        // return ;
    }
    public function utc_to_ist1($time) {
        // echo $time;
       
       
        $ist = date_format(date_add(date_create($time), date_interval_create_from_date_string("330 minutes")), 'Hi');
        return "UTC (". $ist . " IST)";
        // return ;
    }

    public function watchhoursOrder($data) {
        $outputArr = array();
        foreach ($data as $key => $value) {
            if (isset($outputArr['sunday'])) {
                array_push($outputArr['sunday'], $value['sunday_open'] . " - " . $value['sunday_close']);
            } else {
                $outputArr['sunday'] = array();
                array_push($outputArr['sunday'], $value['sunday_open'] . " - " . $value['sunday_close']);
            }

            if (isset($outputArr['monday'])) {
                array_push($outputArr['monday'], $value['monday_open'] . " - " . $value['monday_close']);
            } else {
                $outputArr['monday'] = array();
                array_push($outputArr['monday'], $value['monday_open'] . " - " . $value['monday_close']);
            }

            if (isset($outputArr['tuesday'])) {
                array_push($outputArr['tuesday'], $value['tuesday_open'] . " - " . $value['tuesday_close']);
            } else {
                $outputArr['tuesday'] = array();
                array_push($outputArr['tuesday'], $value['tuesday_open'] . " - " . $value['tuesday_close']);
            }

            if (isset($outputArr['wednesday'])) {
                array_push($outputArr['wednesday'], $value['wednesday_open'] . " - " . $value['wednesday_close']);
            } else {
                $outputArr['wednesday'] = array();
                array_push($outputArr['wednesday'], $value['wednesday_open'] . " - " . $value['wednesday_close']);
            }

            if (isset($outputArr['thursday'])) {
                array_push($outputArr['thursday'], $value['thursday_open'] . " - " . $value['thursday_close']);
            } else {
                $outputArr['thursday'] = array();
                array_push($outputArr['thursday'], $value['thursday_open'] . " - " . $value['thursday_close']);
            }

            if (isset($outputArr['friday'])) {
                array_push($outputArr['friday'], $value['friday_open'] . " - " . $value['friday_close']);
            } else {
                $outputArr['friday'] = array();
                array_push($outputArr['friday'], $value['friday_open'] . " - " . $value['friday_close']);
            }

            if (isset($outputArr['saturday'])) {
                array_push($outputArr['saturday'], $value['saturday_open'] . " - " . $value['saturday_close']);
            } else {
                $outputArr['saturday'] = array();
                array_push($outputArr['saturday'], $value['saturday_open'] . " - " . $value['saturday_close']);
            }
        }
        return $outputArr;
    }

    public function watchhoursExpiryAlert() {
        date_default_timezone_set('Asia/Kolkata');
        $thresholdDate = date_create(date('Y-m-d'));
        date_add($thresholdDate, date_interval_create_from_date_string("1 days"));
        $thresholdDateFormatted = date_format($thresholdDate, "Ymd");
        $thresholdDateWithMonthName = date_format($thresholdDate, "d-M-Y");
        $data = WatchHoursModel::where('w_end_date', $thresholdDateFormatted)->distinct()->pluck('aerodrome')->toArray();
        foreach ($data as $d) {
            $watchhours_check=WatchHoursModel::where('w_end_date','>',$thresholdDateFormatted)->where('aerodrome',$d)->count();
             if($watchhours_check>0){
               $key = array_search($d,$data);
                     unset($data[$key]); 
             }
              
        }
        if (sizeof($data) != 0) {
            $subject = " WATCH HOURS EXPIRING LIST ON " . strtoupper($thresholdDateWithMonthName);
            Mail::send('emails.watch_hours_expiry_alert', array("data" => $data, "date" => $thresholdDateWithMonthName), function($message) use($subject) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                $message->to("ops@eflight.aero");
                $message->cc("prem@eflight.aero");
                $message->bcc("sk20900@gmail.com");
            });
            return array('message' => 'Email sent successfully');
        }
        return array('message' => 'NA');
    }
    public function watchhoursExpiredAlert() {
        date_default_timezone_set('Asia/Kolkata');
        $thresholdDate = date_create(date('Y-m-d'));
        //date_add($thresholdDate, date_interval_create_from_date_string("1 days"));
        $thresholdDateFormatted = date_format($thresholdDate, "Ymd");
        $thresholdDateWithMonthName = date_format($thresholdDate, "d-M-Y");
        $data = WatchHoursModel::where('w_end_date','<',$thresholdDateFormatted)->distinct()->pluck('aerodrome')->toArray();

        foreach ($data as $d) {
            $watchhours_check=WatchHoursModel::where('w_end_date','>',$thresholdDateFormatted)->where('aerodrome',$d)->count();
             if($watchhours_check>0){
               $key = array_search($d,$data);
                     unset($data[$key]); 
             }
              
        }
        if (sizeof($data) != 0) {
            $subject = " EXPIRED WATCH HOURS";
            Mail::send('emails.watch_hours_expired_alert', array("data" => $data, "date" => $thresholdDateWithMonthName), function($message) use($subject) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                //$message->to("sk20900@gmail.com");
                $message->to("ops@eflight.aero");
                //$message->cc("prem@eflight.aero");
                $message->bcc("sk20900@gmail.com");
            });
            return array('message' => 'Email sent successfully');
        }
        return array('message' => 'NA');
    }

    public function delete_watch(Request $request) {
        $id = $request->id;
        //$result = WatchHoursModel::where('id', $id)->delete();
        $dataToBedeleted = WatchHoursModel::find($id);
        $subject = $dataToBedeleted['aerodrome']." WATCH HOURS RECORD DELETED";
        if (env('APP_ENV') != 'local') {
        Mail::queue('emails.watch_hours_deleted', array("end_date" => $dataToBedeleted['w_end_date'], "start_date" => $dataToBedeleted['w_start_date'],'airport'=>$dataToBedeleted['aerodrome']), function($message) use($subject) {
            $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
            $message->subject($subject);
            $message->to("ops@eflight.aero");
            $message->cc("prem@eflight.aero");
            $message->bcc("sk20900@gmail.com");
        });
       }
         $result=WatchHoursModel::where('aerodrome', '=', $dataToBedeleted['aerodrome'])->where('w_start_date', '=', $dataToBedeleted['w_start_date'])->where('w_end_date', '=', $dataToBedeleted['w_end_date'])->delete();  
        return response()->json(['STATUS_CODE' => 1, 'result' => $result]);
    }

    public function find(Request $request)
    {
            $term = trim($request->q);
            if (empty($term)) {
                return \Response::json([]);
            }
            $formatted_tags=[];
            $airports_names = DB::table('watch_hours_aerodrome_list')->where('code','like',"%$term%")->get();
            foreach ($airports_names as $airports_name) {
                $formatted_tags[] = ['id' => $airports_name->code, 'text' => $airports_name->code." - ".$airports_name->name];
            }
            return \Response::json($formatted_tags);
    }
    public function AddAirport(Request $request)
    {
        $rules=[
              'code' =>'unique:watch_hours_aerodrome_list',
              'name'=>'unique:watch_hours_aerodrome_list']; 
        $message=['code.unique'=>'Airport Code Already Exist','name.unique'=>'City Already Exist'];    
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            return response()->json(array('success' => false,'message' =>$validation->errors()),200);
         }          
        $airport= new WatchHoursAirportModel();
        $airport->code=strtoupper($request->code);
        $airport->name=strtoupper($request->name); 
        $airport->save();
        $request->session()->flash('msg', $request->airport_code." - ".$request->city." Added Successfully");
        return response()->json(array('success' => true,'msg'=>"Airport Added Successfully"),200);   
    } 
    public function testpdf(){
         $pdf = PDF::loadView('notams.watchhours_new.pdf');
         $pdfname='watchhours.pdf';
        return $pdf->stream($pdfname);  
        return $pdf->download($pdfname);
    }
    public function fav_pdf(Request $request)
     {
        $current_date=date('Ymd');
        $code_array=explode(",",$request->code);
        $data = WatchHoursModel::groupBy('aerodrome')
               ->whereIn('aerodrome',['VABB','VIDP','VOMM','VOBG','VOHS'])
               ->where(function($q) use ($current_date) {
                   $q->whereRaw('? between w_start_date and w_end_date', [$current_date]);
               })
               ->orderBy('aerodrome')
               ->orderBy('w_start_date')
               ->groupBy('w_start_date')
               ->groupBy('w_end_date')
               ->get();
        $date=date('d-m-Y');       
        $datalist=array();    
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
            $value['ids']=WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->pluck('id');
            $datalist[$value['aerodrome']][]=array(
                'watchhours'=>$value['watchhours'],
                'start_date_formatted'=>$value['start_date_formatted'],
                'start_date_timestamp'=>strtotime($value['start_date_formatted']),
                'end_date_formatted'=>$value['end_date_formatted'],
                'end_date_timestamp'=>strtotime($value['end_date_formatted']),
                'id'=>$value->id,
                'aerodrome'=>$value->aerodrome,
                'notam_no'=>$value->notam_no,
                'airport_name'=>WatchHoursAirportModel::where('code',$value->aerodrome)->pluck('name'),
                'notams'=>$value->notams 
                 );
        }                   
        foreach ($datalist as $key=>$datal) 
        {
           $loop=count($datal)+count($datal);  
           foreach ($datal as $subkey=>$dl) 
           {
                if($dl['start_date_timestamp']<strtotime(date("y-m-d")) && $dl['end_date_timestamp']<strtotime(date("y-m-d")))
                 {
                    $temp=$datal[$subkey];
                    unset($datalist[$key][$subkey]);
                    $datalist[$key][$loop]=$temp;
                    $loop=$loop-1;
                 }
           } 
           ksort($datalist[$key]); 
        }
        $date=date('d-m-Y');       
        $name="FAV AIRPORTS WATCH HOURS // ".$date;
        $pdf = PDF::loadView('notams.watchhours_new.pdf',array('datalist'=>$datalist,'title'=>'FAV AIRPORT'));
        $pdfname=$name.'.pdf';
        //return view('notams.watchhours_new.pdf',array('datalist'=>$data,'title'=>'FAV AIRPORT'));
        return $pdf->download($pdfname);
        
     }
     public function searched_pdf(Request $request){
        $current_date=date('Ymd');
        $code_array=explode(",",$request->code);
        $data = WatchHoursModel::groupBy('aerodrome')
               ->whereIn('aerodrome',$code_array)
               ->where(function($q) use ($current_date) {
                   $q->whereRaw('? between w_start_date and w_end_date', [$current_date]);
               })
               ->orderBy('aerodrome')
               ->orderBy('w_start_date')
               ->groupBy('w_start_date')
               ->groupBy('w_end_date')
               ->get();
        $date=date('d-m-Y');       
        $name="SEARCHED AIRPORTS WATCH HOURS // ".$date;
        $datalist=array();    
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
            $value['ids']=WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->pluck('id');
            $datalist[$value['aerodrome']][]=array(
                'watchhours'=>$value['watchhours'],
                'start_date_formatted'=>$value['start_date_formatted'],
                'start_date_timestamp'=>strtotime($value['start_date_formatted']),
                'end_date_formatted'=>$value['end_date_formatted'],
                'end_date_timestamp'=>strtotime($value['end_date_formatted']),
                'id'=>$value->id,
                'aerodrome'=>$value->aerodrome,
                'notam_no'=>$value->notam_no,
                'airport_name'=>WatchHoursAirportModel::where('code',$value->aerodrome)->pluck('name'),
                'notams'=>$value->notams 
                 );
        }                   
        foreach ($datalist as $key=>$datal) 
        {
           $loop=count($datal)+count($datal);  
           foreach ($datal as $subkey=>$dl) 
           {
                if($dl['start_date_timestamp']<strtotime(date("y-m-d")) && $dl['end_date_timestamp']<strtotime(date("y-m-d")))
                 {
                    $temp=$datal[$subkey];
                    unset($datalist[$key][$subkey]);
                    $datalist[$key][$loop]=$temp;
                    $loop=$loop-1;
                 }
           } 
           ksort($datalist[$key]); 
        }
       
        //return view('notams.watchhours_new.pdf',array('datalist'=>$datalist,'title'=>'SEARCHED AIRPORT'));
        $pdf = PDF::loadView('notams.watchhours_new.pdf',array('datalist'=>$datalist,'title'=>'SEARCHED AIRPORT'));
        $pdfname=$name.'.pdf';
        return $pdf->download($pdfname);
     }
     public function region_pdf(Request $request)
     {
        $current_date=date('Ymd');
        $code=$request->region;
        $data = WatchHoursModel::groupBy('aerodrome')
               ->where('aerodrome','LIKE',"$code%")
               ->where(function($q) use ($current_date) {
                   $q->whereRaw('? between w_start_date and w_end_date', [$current_date]);
               })
               ->orderBy('aerodrome')
               ->orderBy('w_start_date')
               ->groupBy('w_start_date')
               ->groupBy('w_end_date')
               ->get();
        $date=date('d-m-Y');       
        if($code=='VA'){
            $title="VABF REGION";
            $name="VABF - MUMBAI REGION WATCH HOURS // ".$date;
        }
        elseif($code=='VE'){
            $title="VECF REGION";
            $name="VECF - KOLKOTA REGION WATCH HOURS // ".$date;
        }
        elseif($code=='VI'){
            $title="VIDF REGION";
            $name="VIDF - DELHI REGION WATCH HOURS // ".$date;
        }
        elseif($code=='VO'){
            $title="VOMF REGION"; 
            $name="VOMF - CHENNAI REGION WATCH HOURS // ".$date;
        }
        $datalist=array();       
        foreach ($data as $key => $value) {
            $value['watchhours'] = $this->watchhoursOrder(WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->get());
            $value['start_date_formatted'] = date_format(date_create($value['w_start_date']), "d-M-Y");
            $value['end_date_formatted'] = date_format(date_create($value['w_end_date']), "d-M-Y");
            $value['ids']=WatchHoursModel::where('aerodrome', '=', $value['aerodrome'])->where('w_start_date', '=', $value['w_start_date'])->where('w_end_date', '=', $value['w_end_date'])->pluck('id');
            $datalist[$value['aerodrome']][]=array(
                'watchhours'=>$value['watchhours'],
                'start_date_formatted'=>$value['start_date_formatted'],
                'start_date_timestamp'=>strtotime($value['start_date_formatted']),
                'end_date_formatted'=>$value['end_date_formatted'],
                'end_date_timestamp'=>strtotime($value['end_date_formatted']),
                'id'=>$value->id,
                'aerodrome'=>$value->aerodrome,
                'notam_no'=>$value->notam_no,
                'airport_name'=>WatchHoursAirportModel::where('code',$value->aerodrome)->pluck('name'),
                'notams'=>$value->notams 
                 );
                }             
        foreach ($datalist as $key=>$datal) 
        {
           $loop=count($datal)+count($datal);  
           foreach ($datal as $subkey=>$dl) 
           {
                if($dl['start_date_timestamp']<strtotime(date("y-m-d")) && $dl['end_date_timestamp']<strtotime(date("y-m-d")))
                 {
                    $temp=$datal[$subkey];
                    unset($datalist[$key][$subkey]);
                    $datalist[$key][$loop]=$temp;
                    $loop=$loop-1;
                 }
           } 
           ksort($datalist[$key]); 
        }
        $pdf = PDF::loadView('notams.watchhours_new.pdf',array('datalist'=>$datalist,'title'=>$title));
        $pdfname=$name.'.pdf';
        return $pdf->download($pdfname);
     }
     public function ViewHistory(Request $request)
     {       
           $id=$request->watchhoursid;
           $offset=$request->start;
           $length=$request->length;
           $Watchhoursrevision_count=Watchhoursrevision::where('watchhours_id',$id)->count();
           $Watchhoursrevision_list=Watchhoursrevision::where('watchhours_id',$id)->orderBy('created_at')
                 ->get();
           $i=$request->start+1;
           $result=array();
           $count=0;
           foreach ($Watchhoursrevision_list as $watchhours) 
           { 
              if($count==0)
                $status="ADD";
              else
                $status="EDIT";
               $count++;
               $result[]=array(
                 $i++,
                 $status,
                 date('d-M-Y H:i:s',strtotime($watchhours->created_at))." IST",
                 $watchhours->user->name);
              }
            $wh_list=array(
                  'recordsTotal'=>$Watchhoursrevision_count,'data'=>$result,"recordsFiltered" => $Watchhoursrevision_count);
             return response()->json($wh_list);
           
     }
     public function index(){
        return view('notams.watchhours_new.watchhours');
     }
     public function search_airport(Request $request){
        if(!empty($request->code)){
             $code_array_length=count($request->code);
             $code=$request->code[$code_array_length-1];
             $watch_hours=WatchHoursAirportModel::where('code',$code)->pluck('name');
             return $watch_hours[0]; 
       }   
       else
         return '';
     }
}
