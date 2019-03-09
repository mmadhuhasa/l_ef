<?php

namespace App\Http\Controllers\LoadAndTrim;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VtajjController extends Controller
{
    public function index(Request $request){
	
    }
    public function create(Request $request){
	
    }
    public function store(Request $request){
	$take_off_fuel = $request->take_off_fuel_weight1;
	$landing_fuel  = $request->landing_fuel_weight1;
	$get_take_off_moment = \App\models\VtajjModel::where('is_active',1)->where('fuel_weight',$take_off_fuel)->first();
	$get_landing_moment = \App\models\VtajjModel::where('is_active',1)->where('fuel_weight',$landing_fuel)->first();
	
	
	$take_off_fuel_moment = ($get_take_off_moment) ? $get_take_off_moment->moment : 0;
	$landing_fuel_moment = ($get_landing_moment) ? $get_landing_moment->moment : 0;
	
	$take_off_fuel_arm  = ($take_off_fuel_moment/$take_off_fuel);
	$landing_fuel_arm  = ($landing_fuel_moment/$landing_fuel);
	
	return response()->json(['take_off_fuel_moment1'=>$take_off_fuel_moment,
				'landing_fuel_moment1'=>$landing_fuel_moment,
				'take_off_fuel_arm1'=>$take_off_fuel_arm,
				'landing_fuel_arm1'=>$landing_fuel_arm]);
	
    }
}
