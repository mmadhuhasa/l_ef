<?php

namespace App\Api\Controllers\Notifications;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\FlightPlanDetailsModel;
use App\models\StationsModel;
use App\models\PilotDetailsModel;
use App\Exceptions\customException;
use Response;
use Input;
use Log;
use Mail;
use Auth;
use PDF;
use Redirect;
use App\models\WatchHoursModel;
use App\models\Station_Addresses_model;
use App\myfolder\myFunction;
use App\Api\Requests\QuickPlanRequest;
use App\Api\Requests\FullPlanRequest;
use App\Api\Requests\EditPlanRequest;
use App\User;
use App\Api\Requests\AdminRequest;
use Illuminate\Support\Facades\Validator as Validator;
use App\models\WebNotificationsModel;

class WebNotificationControllerApi extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $customer_id;

    public function __construct() {
	$this->bcc = env('BCC', "dev.eflight@pravahya.com");
	$this->cc = env('CC', "dev.eflight@pravahya.com");
	$this->from = env('FROM', "support@eflight.aero");
	$this->from_name = env('FROM_NAME', "EFLIGHT");
    }

    public function index(Request $request) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    public function get_notifications(Request $request) {
	$user_id = Auth::user()->id; //$request->user_id ;
	$user_details = User::findOrFail($user_id);
	$is_admin = ($user_details) ? $user_details->is_admin : 0;
	$web_notify_obj = WebNotificationsModel::getInstance();
	if ($is_admin) {
	    $web_notifications = $web_notify_obj->get_notifications();
	} else {
	    $web_notifications = User::find($user_id)->web_notifications->where('is_active', 1);
	}
	$notify_count = count($web_notify_obj->get_notifications('1'));

	$fpl_notifications = $web_notify_obj->get_notifications('', '1');
	$fpl_notifications2 = $web_notify_obj->get_notifications('', '2');
	$fpl_notifications3 = $web_notify_obj->get_notifications('', '3');
	$fpl_notifications4 = $web_notify_obj->get_notifications('', '4');
	return response()->json(['success' => $web_notifications,
		    'notify_count' => $notify_count,
		    'fpl_notifications' => $fpl_notifications,
		    'fpl_notifications2' => $fpl_notifications2,
		    'fpl_notifications3' => $fpl_notifications3,
		    'fpl_notifications4' => $fpl_notifications4
	]);
    }

}
