<?php

namespace App\Http\Controllers\Fpl;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class WatchHourController extends Controller
{
    public function index(){
        
    }
    
    public function get_watch_hours(Request $request){
        try {
        $aerodrome = $request->aerodrome;
        $dof       = ($request->date_of_flight) ? $request->date_of_flight : date('ymd') ;
        $result       = \App\myfolder\myFunction::watch_hours_tooltip($aerodrome, $dof);
        return response()->json(['STATUS_CODE'=>1,'STATUS_DESC'=>$result]);    
        } catch (\Exception $e) {
            Log::info('get_watch_hours '.$e->getMessage().' Line '.$e->getLine());
        }  
    }
}
