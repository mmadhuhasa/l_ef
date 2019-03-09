<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Fuelprice;
use App\models\Fuelpricerevision;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Session;
class FuelpriceController extends Controller
{
    public function index()
    {
        $current_date=date('Ymd');
        $code_city=Fuelprice::whereRaw('id IN (select max(id) FROM fuelprices  GROUP BY airport_code,city)')->orderBy('airport_code','asc')->pluck('airport_code','city');
       foreach($code_city as $city=>$code) 
       { 
            $fuelprice=Fuelprice::where('airport_code',$code)
                         ->where('city',$city)
                         ->where('from_Date','<=',$current_date)
                         ->where('fuel_type',1)
                         ->orderBy('from_date','DESC')
                         ->first();   
            if(isset($fuelprice))
             {   
            $fuelpricelist[]=array('id'=>$fuelprice->id,
                              'user_id'=>$fuelprice->user_id,
                              'airport_code'=>$fuelprice->airport_code,
                              'city'=>$fuelprice->city,
                              'fuel_type'=>$fuelprice->fuel_type,
                              'basic_price'=>isset($fuelprice->basic_price) ? $fuelprice->basic_price : '',
                              'tax'=>isset($fuelprice->tax) ?  $fuelprice->tax : '',
                              'tax_amount'=>isset($fuelprice->tax_amount) ?  $fuelprice->tax_amount : '',
                              'hp_price'=>isset($fuelprice->hp_price) ?  $fuelprice->hp_price : '' ,
                              'from_date'=>!empty($fuelprice->from_date) ? $fuelprice->from_date : '',
                              'to_date'=>!empty($fuelprice->to_date) ? $fuelprice->to_date : ''
                                        );        
            }

        }
    	return view('fuel.fuel_price')->with(['fuelpricelist'=>$fuelpricelist,'latestfuelid'=>true,'disable'=>true]);
    }
    public function AddAirport(Request $request)
    {
    	$rules=[
              'airport_code' => 'unique:fuelprices',
              'city'=>'unique:fuelprices']; 
        $message=['airport_code.unique'=>'Airport Code Already Exist','city.unique'=>'City Already Exist'];    
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            return response()->json(array('success' => false,'message' =>$validation->errors()),200);
         }       	
    	$fuel= new Fuelprice();
    	$fuel->airport_code=$request->airport_code;
    	$fuel->city=$request->city;
    	$fuel->user_id=Auth::id();
        $fuel->fuel_type=isset($request->fuel_type) ?  $request->fuel_type : 2; 
    	$fuel->save();
    	$request->session()->flash('msg', $request->airport_code." - ".$request->city." Added Successfully to fuel price list");
        return response()->json(array('success' => true,'msg'=>"Added Successfully to fuel price list"),200);   
    }
    Public function UpdateFuelPrice(Request $request)
    {
      
         $message=[
                  'from_date.is_edit_date_valid'=>'INVALID DATE'
                 ];     
        $validation=Validator::make(
                $request->all(),[ 
                'from_date' => "is_edit_date_valid:$request->airport_code,$request->to_date,$request->id,$request->city",
            ],$message);

        if($validation->fails())
            return response()->json(array('success' => false,'message' =>$validation->errors()),200);

    	$id=$request->id;
    	$fuel=Fuelprice::find($id);
    	$tax_amount= sprintf('%.2f',($request->tax*$request->basic_price)/100);
    	$hp_price= sprintf('%.2f',$tax_amount+$request->basic_price)   ;
        if(($fuel->from_date==date('Ymd', strtotime($request->from_date))) && ($fuel->to_date==date('Ymd', strtotime($request->to_date))) && ($fuel->basic_price==$request->basic_price) && ($fuel->tax==$request->tax))
         return response()->json(array('success' => true,'msg'=>"NO data to update",'data'=>array('tax_amount'=>'','hp_price'=>'')),200);  
         $data=[
             'user_id'=>Auth::id(),
             // 'eflight_price'=>$request->eflight_price,
             'basic_price'=>$request->basic_price,
             'tax'=>$request->tax,
             'tax_amount'=>$tax_amount,
             'hp_price'=>$hp_price,
             'from_date'=>date('Ymd', strtotime($request->from_date)),
             'to_date'=>date('Ymd', strtotime($request->to_date)),
             'created_at'=>date("Y-m-d H:i:s")   
             ];  
         // if($fuel->eflight_price != $request->eflight_price)
         //    $revisiondata['eflight_price']=$request->eflight_price;
         if($fuel->basic_price != $request->basic_price)
             $revisiondata['basic_price']=$request->basic_price;
         if($fuel->tax != $request->tax)
             $revisiondata['tax']=$request->tax;
         if($fuel->from_date != date('Ymd', strtotime($request->from_date)))
             $revisiondata['from_date']= date('Ymd', strtotime($request->from_date));
         if($fuel->to_date != date('Ymd', strtotime($request->to_date)))
             $revisiondata['to_date']= date('Ymd', strtotime($request->to_date));        
         /*if(empty($fuel->eflight_price))
            $revisiondata['status']='ADD';
          else            
            $revisiondata['status']='EDIT';*/
         if(empty($fuel->basic_price))
            $revisiondata['status']='ADD';
          else            
            $revisiondata['status']='EDIT'; 
         $revisiondata['fuelprice_id']=$id;
         $revisiondata['user_id']=Auth::id();
         $revisiondata['created_at']=date("Y-m-d H:i:s",strtotime('+330 minute'));
         $fuel=Fuelprice::find($id)->update($data);       
         
         Fuelpricerevision::create($revisiondata);     
        return response()->json(array('success' => true,'msg'=>"Fuel price updated Successfully",'data'=>array('tax_amount'=>$tax_amount,'hp_price'=>$hp_price)),200);
    }
    public function AddFuelPrice(Request $request)
    { 

        $message=[
                  'from_date.is_date_valid'=>'DATE CONFLICT'
                 ];     
        $validation=Validator::make(
                $request->all(),[ 
                'from_date' => "is_date_valid:$request->airport_code,$request->to_date,$request->city",
            ],$message);

        if($validation->fails())
            return response()->json(array('success' => false,'message' =>$validation->errors()),200);
           
           
           $tax_amount=($request->tax*$request->basic_price)/100;
           $hp_price=$tax_amount+$request->basic_price;
           $newdata=[
             'user_id'=>Auth::id(),
             'city'=>$request->city,
             'airport_code'=>$request->airport_code,
             // 'eflight_price'=>$request->eflight_price,
             'basic_price'=>$request->basic_price,
             'tax'=>$request->tax,
             'fuel_type'=>$request->fuel_type,
             'tax_amount'=>$tax_amount,
             'hp_price'=>$hp_price,
             'from_date'=>date('Ymd', strtotime($request->from_date)),
             'to_date'=>date('Ymd', strtotime($request->to_date)),
             'created_at'=>date("Y-m-d H:i:s")   
             ]; 
            $newfuel = Fuelprice::create($newdata);
            $revisiondata=[
                             'fuelprice_id'=>$newfuel->id,
                             'user_id'=>Auth::id(),
                             // 'eflight_price'=>$request->eflight_price,
                             'basic_price'=>$request->basic_price,
                             'tax'=>$request->tax,
                             'from_date'=>date('Ymd', strtotime($request->from_date)),
                             'to_date'=>date('Ymd', strtotime($request->to_date)),
                             'status'=>'ADD',
                             'created_at'=>date("Y-m-d H:i:s",strtotime('+330 minute'))
                          ];
            Fuelpricerevision::create($revisiondata);     
            $request->session()->flash('msg', $request->airport_code.' - '.$request->city.' FUEL PRICE Added Successfully');
               return response()->json(array('success' => true,'msg'=>'Fuel price Added Successfully'),200);
               
    }
    public function AutoSuggest()
     {
         $airports = DB::table('fuelprices')->groupBy('airport_code', 'city')->get();
         foreach ($airports as $airport) {
         	$data[]=$airport->airport_code.' - '.$airport->city;
         }
          return json_encode($data);
     }
    public function SearchFilter(Request $request)
    {
     
        $current_date=date('Ymd');
        $aero=$request->aero;
        $frm_date=$request->frm_date;
        $to_date=$request->to_date;
        $builder = Fuelprice::query();
        $current_date=date('Ymd');
        $code_city=Fuelprice::whereRaw('id IN (select max(id) FROM fuelprices  GROUP BY airport_code,city)')->orderBy('airport_code','asc')->pluck('airport_code','city');

        if($request->submit=='bp_filter')
        {
           $fuelpricelist='';
           $aero='';
           $frm_date='';
           $to_date='';
            $latestfuelid=true;
           $disable=false;  

           foreach($code_city as $city=>$code) 
           { 
                $fuelprice=Fuelprice::where('airport_code',$code)
                             ->where('city',$city)
                             ->where('from_Date','<=',$current_date)
                             ->where('fuel_type',2)
                             ->orderBy('from_date','DESC')
                             ->first();   
                if(isset($fuelprice))
                 {   
                $fuelpricelist[]=array('id'=>$fuelprice->id,
                                  'user_id'=>$fuelprice->user_id,
                                  'airport_code'=>$fuelprice->airport_code,
                                  'city'=>$fuelprice->city,
                                  'fuel_type'=>$fuelprice->fuel_type,
                                  'basic_price'=>isset($fuelprice->basic_price) ? $fuelprice->basic_price : '',
                                  'tax'=>isset($fuelprice->tax) ?  $fuelprice->tax : '',
                                  'tax_amount'=>isset($fuelprice->tax_amount) ?  $fuelprice->tax_amount : '',
                                  'hp_price'=>isset($fuelprice->hp_price) ?  $fuelprice->hp_price : '' ,
                                  'from_date'=>!empty($fuelprice->from_date) ? $fuelprice->from_date : '',
                                  'to_date'=>!empty($fuelprice->to_date) ? $fuelprice->to_date : ''
                                            );        
                }

            }
        }
        else if($request->submit=='hp_filter')
        {
           $fuelpricelist='';
           $aero='';
           $frm_date='';
           $to_date='';
           $latestfuelid=true;
           $disable=true;  
           foreach($code_city as $city=>$code) 
           { 
                $fuelprice=Fuelprice::where('airport_code',$code)
                             ->where('city',$city)
                             ->where('from_Date','<=',$current_date)
                             ->where('fuel_type',1)
                             ->orderBy('from_date','DESC')
                             ->first();   
                if(isset($fuelprice))
                 {   
                $fuelpricelist[]=array('id'=>$fuelprice->id,
                                       'user_id'=>$fuelprice->user_id,
                                       'airport_code'=>$fuelprice->airport_code,
                                       'city'=>$fuelprice->city,
                                       'fuel_type'=>$fuelprice->fuel_type,
                                       'basic_price'=>isset($fuelprice->basic_price) ? $fuelprice->basic_price : '',
                                       'tax'=>isset($fuelprice->tax) ?  $fuelprice->tax : '',
                                       'tax_amount'=>isset($fuelprice->tax_amount) ?  $fuelprice->tax_amount : '',
                                       'hp_price'=>isset($fuelprice->hp_price) ?  $fuelprice->hp_price : '' ,
                                       'from_date'=>!empty($fuelprice->from_date) ? $fuelprice->from_date : '',
                                       'to_date'=>!empty($fuelprice->to_date) ? $fuelprice->to_date : ''
                                            );        
                }

            }

        }
        else{  
          $disable=false;  
          if((strpos($aero, '-') !== false) && $request->has('aero')) {
             $aero_city=explode(" - ",$aero);     
             $aerocode=$aero_city[0];
             $city=$aero_city[1];
             $builder->where('airport_code','like', '%'.$aerocode. '%')
                     ->where('city','like', '%'.$city.'%');  
              $latestfuelid= Fuelprice::where('airport_code','like', '%'.$aerocode. '%')
                                     ->where('city','like', '%'.$city.'%')
                                     ->where('from_Date','<=',$current_date)
                                     ->orderBy('from_date','desc')
                                     ->pluck('id')
                                     ->first();          
           }
  		     if($request->has('frm_date')){
  		        $builder->where('from_date','>=',date('Ymd', strtotime($request->frm_date)))
                      ->orderBy('from_date');	
  		     }
           else {
              $builder->where('from_date','<=',$current_date);      
           } 
  		     if($request->has('to_date')){
  		        $builder->where('to_date','<=',date('Ymd', strtotime($request->to_date)));	
  		     }
           if($request->frm_date=="" && $request->to_date==""){
              $fuelpricelist = $builder->orderBy('from_date','desc')->limit(1);
           }
            $request->session()->flash('msg','DISPLAYING SEARCH RESULT for '.$aerocode." - ".$city);
            $fuelpricelist = $builder->get();
        }
       
        //dd($fuelpricelist);
        return view('fuel.fuel_price')->with(['fuelpricelist'=>$fuelpricelist,'aero'=>$aero,'frm_date'=>$frm_date,'to_date'=>$to_date,'latestfuelid'=>$latestfuelid,'disable'=>$disable]); 
    }
    public function ViewHistory(Request $request)
    {       
          $fuelid=$request->fuelid;
          $offset=$request->start;
          $length=$request->length;
          $fuel_pricecount=Fuelpricerevision::where('fuelprice_id',$fuelid)->count();
          $fuel_pricelist=Fuelpricerevision::where('fuelprice_id',$fuelid)->orderBy('created_at','desc')->offset($offset)
                ->limit(10)->get();
          $i=$request->start+1;
          $result=array();
          foreach ($fuel_pricelist as $fuel_price_key=>$fuel_price) 
          {        
             $result[]=array(
                $i++,
                $fuel_price->status,
                // $fuel_price->eflight_price,
                $fuel_price->basic_price,
                $fuel_price->tax,
                isset($fuel_price->from_date) ? date('d-M-Y',strtotime($fuel_price->from_date)) : '',
                isset($fuel_price->to_date) ? date('d-M-Y',strtotime($fuel_price->to_date)) : '',
                date('d-M-Y H:i:s',strtotime($fuel_price->created_at)),
                $fuel_price->user->name);
             }
           $fuel_list=array(
                 'recordsTotal'=>$fuel_pricecount,'data'=>$result,"recordsFiltered" => $fuel_pricecount);
            return response()->json($fuel_list);
          
    }    

}