<?php

namespace App\Http\Controllers\Fpl;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\WebNotificationsModel;
use Auth;

class WebNotificationController extends Controller {

    public $user_id;
    public $user_name;
    public $user_email;
    public $is_admin;

    public function __construct() {
	$this->user_id = Auth::user()->id;
	$this->user_name = Auth::user()->name;
	$this->user_email = Auth::user()->email;
	$this->is_admin = Auth::user()->is_admin;
    }

    public function index() {
	
    }

    public function store() {
	
    }

    public function onclick(Request $request) {
	$id = $request->id;
	$user_id = $this->user_id;

	$update_data = ['viewed_user_id' => $user_id, 'on_click' => '1'];
	$result = WebNotificationsModel::where('id', $id)->update($update_data);
	$notification_count = count(WebNotificationsModel::get_notifications('1'));
	return response()->json(['result'=>$result,'notify_count'=>$notification_count]);
    }

    public function onclose(Request $request) {
	$id = $request->id;
	$user_id = $this->user_id;

	$update_data = ['viewed_user_id' => $user_id, 'on_close' => '1'];

	$result = WebNotificationsModel::where('id', $id)->update($update_data);
	return $result;
    }

}
