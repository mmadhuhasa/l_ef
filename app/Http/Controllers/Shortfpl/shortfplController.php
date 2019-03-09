<?php
namespace App\Http\Controllers\Shortfpl;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\loadtrim\LoadtrimModel;
use Log;

class shortfplController extends Controller{
	
    public function index(){
		return view('shortfpl.index');
    }
    public function fullfpl(Request $request){
        try {
        
        $aircraft_callsign = $request->arg['aircraft_callsign'];
        $pic = $request->arg['pilot_in_command'];
        
        $pic_data = \App\models\CallsignInfoModel::get_pilot_data($aircraft_callsign, $pic);
        $mobile_number = ($pic_data) ? $pic_data->mobile_number : '';
        $data = $request->arg;
        $data['mobile_number'] = $mobile_number;
	    return view('shortfpl.new_full_fpl', $data);
            
        } catch (\Exception $ex) {
          Log::info('Short FPL'.$ex->getMessage());  
        }
    }
    public function combinedfpl()  {
        return view('shortfpl.combinedfpl');
    }
    public function store_loadtrim(Request $request)  {

        $response=array('message'=>'fail','activity'=>'none');

        $info = $request->all();
        unset($info['_token']);
        $prev_data=LoadtrimModel::where('callsign',$info['callsign'])->
        where('departure_aerodrome',$info['departure_aerodrome'])->
        where('destination_aerodrome',$info['destination_aerodrome'])->
        where('date_of_flight',$info['date_of_flight'])->
        where('dep_time',$info['dep_time'])->first();
        if($prev_data==false){
            LoadtrimModel::insert($info);
        $response=array('message'=>'success','activity'=>'insert');

        }
        else{
        LoadtrimModel::where('id',$prev_data['id'])->
            update($info);
        $response=array('message'=>'success','activity'=>'update');

        }
        return $response;
        // return view('shortfpl.combinedfpl');
    }
}
