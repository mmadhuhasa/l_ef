<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Log;

class WebNotificationsModel extends Model {

    protected $table = 'web_notifications';
    protected $PrimaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'action', 'unique_id', 'subject', 'viewed_user_id', 'is_app',
        'on_click', 'on_close', 'is_active', 'is_delete', 'created_at'];

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    public static $instance;
    public static $counter = 0;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance() {
        if (!isset(WebNotificationsModel::$instance)) {
            WebNotificationsModel::$instance = new WebNotificationsModel();
        }

        return WebNotificationsModel::$instance;
    }

    public static function getAll() {
        return WebNotificationsModel::where('is_active', 1)->get();
    }

    public static function get_notifications($count = '', $action = '') {

        if ($count) {
            $result = WebNotificationsModel::where('web_notifications.is_active', 1)
                    ->where(function($query) use($count, $action) {
                        if ($count) {
                            $query->where('viewed_user_id', '=', 0);
                        }
                    })
                    ->leftJoin('notification_actions', 'notification_actions.id', '=', 'web_notifications.action')
                    ->orderBy('web_notifications.id', 'desc')
                    ->select('web_notifications.*', 'notification_actions.action_name')
                    ->get();
        } else {
            $result = WebNotificationsModel::where('web_notifications.is_active', 1)
                            ->where(function($query) use($count, $action) {
                                if ($action) {
                                    $query->where('action', $action);
                                }
                            })
                            ->leftJoin('notification_actions', 'notification_actions.id', '=', 'web_notifications.action')
                            ->orderBy('web_notifications.id', 'desc')
                            ->select('web_notifications.*', 'notification_actions.action_name')
                            ->get()->take(10);
        }
        return $result;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function notification_actions() {
        return $this->belongsTo('\App\models\NotificationActions');
    }

    public static function get_fpl_notifications($yesterday='',$delay = '', $change = '') {
        try{
//        $yesterday = date('ymd', strtotime("-1 day"));
        if ($delay) {
            $result = FlightPlanDetailsModel::leftjoin('web_notifications', 'web_notifications.unique_id', '=','flight_plan_details.id')
                    ->where('flight_plan_details.is_active', '1')
                    ->where('flight_plan_details.date_of_flight', $yesterday)
                    ->where('flight_plan_details.aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('flight_plan_details.aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->where('web_notifications.action',3)
                    ->count();
        } else {
            $result = FlightPlanDetailsModel::leftjoin('web_notifications', 'web_notifications.unique_id', '=', 'flight_plan_details.id')
                   ->where('flight_plan_details.is_active', '1')
                    ->where('flight_plan_details.date_of_flight', $yesterday)
                    ->where('flight_plan_details.aircraft_callsign', 'NOT LIKE', '%TESTA%')
                    ->where('flight_plan_details.aircraft_callsign', 'NOT LIKE', '%TESTX%')
                    ->where('web_notifications.action',5)
                    ->count();
        }
        return $result;
          } catch (\Exception $e) {
            Log::info('Stats '. $e->getMessage().' Line '.$e->getLine());
        }
    }
    
    public static function get_fpl_stats2($aircraft_callsign, $from_date, $to_date, $flag, $month = '') {
	$current_day = date('ymd');
	if ($from_date != '' && $to_date != '' & $flag == 'dates') {
	    $result = WebNotificationsModel::leftjoin('flight_plan_details', 'flight_plan_details.id', '=', 'web_notifications.unique_id')
			->whereBetween('date_of_flight', [$from_date, $to_date])
			->where('flight_plan_details.is_active', 1)
			->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
			->select('web_notifications.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
			->get();
	} else {
	    if ($month != '') {
		$start_day_month = date("Ym") . "01";
		$last_day_month = date("Ym") . "31";
		$start_day_month = date("ymd", strtotime($start_day_month));
		$last_day_month = date("ymd", strtotime($last_day_month));
		$result = WebNotificationsModel::leftjoin('flight_plan_details', 'flight_plan_details.id', '=', 'web_notifications.unique_id')
			->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
			->where('flight_plan_details.is_active', 1)
			->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
			->select('web_notifications.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
			->get();
	    }else{
		$result = WebNotificationsModel::leftjoin('flight_plan_details', 'flight_plan_details.id', '=', 'web_notifications.unique_id')
			->where('flight_plan_details.date_of_flight', $current_day)
			->where('flight_plan_details.is_active', 1)
			->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
			->select('web_notifications.*', 'flight_plan_details.departure_time_hours', 'flight_plan_details.departure_time_minutes')
			->get();
	    }
	}
	return $result;
    }

}
