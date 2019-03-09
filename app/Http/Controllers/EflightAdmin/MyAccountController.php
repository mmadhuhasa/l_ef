<?php

namespace App\Http\Controllers\EflightAdmin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\FlightPlanDetailsModel;
use Response;
use Input;
use Log;
use Mail;
use Auth;
use PDF;
use Redirect;
use App\myfolder\myFunction;
use App\models\CallSignMailsModel;

class MyAccountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $user_id;
    public $user_name;
    public $user_email;
    public $user_type;

    public function __construct() {
	$this->bcc = env('BCC', "dev.eflight@pravahya.com");
	$this->cc = env('CC', "dev.eflight@pravahya.com");
	$this->from = env('FROM', "support@eflight.aero");
	$this->from_name = env('FROM_NAME', 'Support | EFLIGHT');
	$this->user_id = Auth::user()->id;
	$this->user_name = Auth::user()->name;
	$this->user_email = Auth::user()->email;
	$this->user_type = Auth::user()->is_admin;
    }

    public function index() {
	try {
	    $get_all = FlightPlanDetailsModel::fetch_fpl_records();
	    $get_day_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
	    $get_month_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('', '1'));
	    $get_year_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
	    $get_total_count_fpl = count(FlightPlanDetailsModel::get_count_fpl());
	    $get_dates_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
	    $get_user_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
	    $input = [];
	    $data = ['get_all' => $get_all,
		'get_day_count_fpl' => $get_day_count_fpl,
		'get_month_count_fpl' => $get_month_count_fpl,
		'get_year_count_fpl' => $get_year_count_fpl,
		'get_total_count_fpl' => $get_total_count_fpl,
		'get_dates_count_fpl' => $get_dates_count_fpl,
		'get_user_count_fpl' => $get_user_count_fpl,
		'input_data' => $input
	    ];
//	echo count($get_count_fpl);exit;
	    return view('EflightAdmin.myaccount.myaccount', $data);
	} catch (\Exception $ex) {
	    Log::error('Myaccount Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
	$input = $request->all();
	$get_all = FlightPlanDetailsModel::get_fpl_filter_data($input);
	$get_day_count_fpl = count($get_all);
	$get_month_count_fpl = count($get_all);
	$get_year_count_fpl = count($get_all);
	$get_total_count_fpl = count($get_all);
	$get_dates_count_fpl = count($get_all);
	$get_user_count_fpl = count($get_all);
	$data = ['get_all' => $get_all,
	    'get_day_count_fpl' => $get_day_count_fpl,
	    'get_month_count_fpl' => $get_month_count_fpl,
	    'get_year_count_fpl' => $get_year_count_fpl,
	    'get_total_count_fpl' => $get_total_count_fpl,
	    'get_dates_count_fpl' => $get_dates_count_fpl,
	    'get_user_count_fpl' => $get_user_count_fpl,
	    'input_data' => $input
	];
//	print_r($get_filter_data);exit;
	return view('EflightAdmin.myaccount.myaccount', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
	//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
	//
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

    public function revice_time(Request $request) {
//	print_r($request->all());exit;
	$id = $request->id;
	$fpl_details = FlightPlanDetailsModel::find($id);
	$fpl_json_encode = json_encode($fpl_details);
	$data = json_decode($fpl_json_encode, TRUE);

	$is_update = '';
	if ($data['departure_time_hours'] . $data['departure_time_minutes'] != $request->departure_time) {
	    $is_update = 1;
	}

	$aircraft_callsign = $data['aircraft_callsign'];
	$departure_aerodrome = $data['departure_aerodrome'];
	$departure_time_hours = substr($request->departure_time, 0, 2);
	$departure_time_minutes = substr($request->departure_time, 2, 2);
	$destination_aerodrome = $data['destination_aerodrome'];
	$date_of_flight = $data['date_of_flight'];
	$pilot_in_command = $data['pilot_in_command'];
	$mobile_number = $data['mobile_number'];
	$copilot = $data['copilot'];
	$total_flying_hours = $data['total_flying_hours'];
	$total_flying_minutes = $data['total_flying_minutes'];
	$revised_by = $this->user_name;
	$departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
	$departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
	$destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
	$destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
	$get_zzzz_value = myFunction::get_zzzz_value($data);

	//Status update
	$update_plan_status = FlightPlanDetailsModel::where('id', $id)->update(['departure_time_hours' => $departure_time_hours, 'departure_time_minutes' => $departure_time_minutes]);

	$subject = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;

//	 $data['subject_type'] = 'revise_time';
	$subject = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;
	$data['revised_by'] = "Revised By: <span style=color:#404040;>$revised_by</span>";
	$data['revised_date'] = "<span style='margin-left:27px;color:#404040;'></span>Revised Date: <span style='color:#404040;'>" . date('d-M-Y') . "</span>";

	date_default_timezone_set('Asia/Calcutta');
	$data['revised_time'] = "<span style='margin-left:27px;color:#404040;'></span> Revised Time: <span style='color:#404040;'>" . date('H:i') . "  IST" . "</span>";
	$data['revised_via'] = "<span style='margin-left:33px;color:#404040;'></span>Revised Via: " . $_SERVER['HTTP_HOST'];

	$data['revice_time_heading'] = "(DLA-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
		$departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";

	$data['get_zzzz_value'] = $get_zzzz_value;
	$mail_headers = [
	    'from' => $this->from,
	    'from_name' => $this->from_name,
	    'subject' => $subject,
	    'to' => $this->user_email,
	    'cc' => $this->cc,
	    'bcc' => $this->bcc
	];
	if ($is_update) {
	    Mail::send('emails.fpl.myaccount.revice_time', $data, function($message) use($mail_headers) {
		$message->from($mail_headers['from'], $mail_headers['from_name']);
		$message->to($mail_headers['to']);
		$message->subject($mail_headers['subject']);
		$message->cc($mail_headers['cc']);
	    });
	}
//	if($is_update){
	return Response::json(['success' => $aircraft_callsign . ' Departure Time Revised Successfully']);
//	}else{
//	   return Response::json(['success' => ' Departure Time not changed!']); 
//	}
    }

    public function fpl_cancel(Request $request) {
	$id = $request->id;
	$fpl_details = FlightPlanDetailsModel::find($id);
	$fpl_json_encode = json_encode($fpl_details);
	$data = json_decode($fpl_json_encode, TRUE);

	$aircraft_callsign = $data['aircraft_callsign'];
	$departure_aerodrome = $data['departure_aerodrome'];
	$departure_time_hours = $data['departure_time_hours'];
	$departure_time_minutes = $data['departure_time_minutes'];
	$destination_aerodrome = $data['destination_aerodrome'];
	$date_of_flight = $data['date_of_flight'];
	$pilot_in_command = $data['pilot_in_command'];
	$mobile_number = $data['mobile_number'];
	$copilot = $data['copilot'];
	$total_flying_hours = $data['total_flying_hours'];
	$total_flying_minutes = $data['total_flying_minutes'];
	$cancelled_by = $this->user_name;
	//Status update
	$update_plan_status = FlightPlanDetailsModel::where('departure_aerodrome', $departure_aerodrome)
			->where('destination_aerodrome', $destination_aerodrome)
			->where('date_of_flight', $date_of_flight)
			->where('departure_time_hours', $departure_time_hours)
			->where('departure_time_minutes', $departure_time_minutes)->update(['plan_status' => '2']);
	$data['subject_type'] = 'cancel';
	$subject = myFunction::get_subject($data);
	$data['cancelled_by'] = " <span style='color:red;'> Cancelled By: $cancelled_by</span>";
	$data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#404040;'>" . date('d-M-Y') . "</span>";
	date_default_timezone_set('Asia/Calcutta');
	$data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#404040;'>" . date('H:i') . "  IST" . "</span>";
	$data['cancelled_via'] = "<span style='margin-left:38px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];
	$data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
		$departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";
	$data['heading_top'] = "CANCEL";
	$data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
	$mail_headers = [
	    'from' => $this->from,
	    'from_name' => $this->from_name,
	    'subject' => $subject,
	    'to' => $this->user_email,
	    'cc' => $this->cc,
	    'bcc' => $this->bcc
	];
	Mail::send('emails.fpl.fpl_cancel', $data, function($message) use($mail_headers) {
	    $message->from($mail_headers['from'], $mail_headers['from_name']);
	    $message->to($mail_headers['to']);
	    $message->subject($mail_headers['subject']);
	    $message->cc($mail_headers['cc']);
	});
	return Response::json(['success' => $aircraft_callsign . ' Plan cancelled successfully']);
//	return back()->with('success',' Plan cancelled successfully');
    }

    public function change_fic_adc(Request $request) {
	$id = $request->id;
	$fpl_details = FlightPlanDetailsModel::find($id);
	$fpl_json_encode = json_encode($fpl_details);
	$data = json_decode($fpl_json_encode, TRUE);

	$aircraft_callsign = substr($data['aircraft_callsign'], 0, 5);
	$departure_aerodrome = $data['departure_aerodrome'];
	$departure_time_hours = $data['departure_time_hours'];
	$departure_time_minutes = $data['departure_time_minutes'];
	$destination_aerodrome = $data['destination_aerodrome'];

	$fic = $request->fic;
	$adc = $request->adc;

	$is_update = '';
	if ($data['fic'] . $data['adc'] != $fic . $adc) {
	    $is_update = 1;
	}

	$entered_by = $this->user_name;
	//Update FIC and ADC
	$update_plan_status = FlightPlanDetailsModel::where('id', $id)
		->update(['fic' => $fic, 'adc' => $adc]);

	$subject = $aircraft_callsign . " FIC " . $fic . " & ADC " . $adc;

	$data['entered_by'] = "Entered  By: <span style='color:red;'>$entered_by</span>";
	$data['entered_date'] = "<span style='margin-left:27px;color:#404040;'></span>Entered  Date: <span style='color:red;'>" . date('d-M-Y') . "</span>";
	date_default_timezone_set('Asia/Calcutta');
	$data['entered_time'] = "<span style='margin-left:27px;color:#404040;'></span> Entered  Time: <span style='color:red;'>" . date('H:i') . "  IST" . "</span>";
	$data['entered_via'] = "<span style='margin-left:33px;color:#404040;'></span>Entered  Via: " . $_SERVER['HTTP_HOST'];

	$data['fic_adc_heading'] = $aircraft_callsign . " FIC " . $fic . " ADC " . $adc . " " . $departure_aerodrome . " " .
		$departure_time_hours . "" . $departure_time_minutes . " - " . $destination_aerodrome;
	$data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
	$mail_headers = [
	    'from' => $this->from,
	    'from_name' => $this->from_name,
	    'subject' => $subject,
	    'to' => $this->user_email,
	    'cc' => $this->cc,
	    'bcc' => $this->bcc
	];
	if ($is_update) {
	    Mail::send('emails.fpl.myaccount.fic_adc', $data, function($message) use($mail_headers) {
		$message->from($mail_headers['from'], $mail_headers['from_name']);
		$message->to($mail_headers['to']);
		$message->subject($mail_headers['subject']);
		$message->cc($mail_headers['cc']);
	    });
	}

	//SMS
	$message = "" . $aircraft_callsign . " FIC " . $fic . " ADC " . $adc . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome . ". Call +919449485515 for Support. HAVE A NICE FLIGHT:)";
	$user = "eflight";
	$password = "eFpl2016";
	$to = CallSignMailsModel::get_callsign_mobile_numbers($aircraft_callsign);
//	$to = '9739939581,9743266297,9886079898,9688183136,9886454717,9886800634,9449485515,7022632088';
	$text = urlencode($message);
	$url = "http://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=$user&password=$password&msisdn=$to&sid=EFLYTE&msg=$text&fl=0&gwid=2";
	$ret = file($url);
	//SMS

	return Response::json(['success' => $aircraft_callsign . ' FIC ADC Updated Successfully']);
    }

    public function change_plan(Request $request) {
	$id = $request->id;
	$fpl_details = FlightPlanDetailsModel::find($id);
	$fpl_json_encode = json_encode($fpl_details);
	$data[] = array();
	$data = json_decode($fpl_json_encode, TRUE);
	$data['route1'] = '';
	$data['remarks1'] = '';
	$data['callsign'] = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
	$data['is_myaccount'] = '1';
	$data['is_id'] = $id;
//	return $data;
	return view('fpl.new_full_fpl', $data);
    }

}
