<?php

namespace App\Http\Controllers\Adc;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\CallSignMailsModel;

class AdcController extends Controller {

    public function index() {
	return view('adc.adc_page');
    }

    public function store(Request $request) {
	$adc = trim($request->adc);
	$adc = trim($adc,'.');
	$aircraft_callsign = substr($adc, 0,5);

	$message = $adc;
	$user = "eflight";
	$password = "PCpl2016";
	$to = CallSignMailsModel::get_callsign_mobile_numbers($aircraft_callsign);
	
//	$to = '9739939581,9743266297,9886079898,9688183136,9886454717,9886800634,9449485515,7022632088';
	$text = urlencode($message);
	$url = "http://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=$user&password=$password&msisdn=$to&sid=EFLYTE&msg=$text&fl=0&gwid=2";
	$ret = file($url);
	
	return response()->json(['success' =>' FIC ADC SUBMITTED SUCCESSFULLY']);
    }
    
   

}
