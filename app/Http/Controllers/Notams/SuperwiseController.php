<?php

namespace App\Http\Controllers\Notams;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Notams\NotamsController;
use App\models\notams\NotamsModel;
use App\models\notams\SupervisorLogs;
use Auth;
use Mail;

class SuperwiseController extends NotamsController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = $this->supervisor_stats();
        return view('notams.supervise_home', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if ($id == "pending") {
            return response()->view('errors.503', [], 500);
        }
        return $id;
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

    public function reminderEmail(Request $request) {
        date_default_timezone_set('Asia/Kolkata');
        $id = $request->id;
        $notamUpdateCycle = array("7 am to 12 pm", "3pm to 8pm");
        $notamUpdateCycleStartTime = array("0700", "1500");
        $subject = "REMINDER TO SUPERVISOR FOR NOTAMS VERIFICATION // " . date('d-m-Y') . " : " . $notamUpdateCycle[$id];
        $cur_date = date('d-m-Y');
        $lastVerifiedRecord = SupervisorLogs::orderBy('id', 'desc')->first();
        if (isset($lastVerifiedRecord->verified_time)) {
            $lastVerifiedDateTime = date_create($lastVerifiedRecord->verified_time);
        } else {
            return null;
        }
        // $lastInsertedVIData = NotamsModel::where("aerodrome", "like", "%VI%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        // $lastInsertedVAData = NotamsModel::where("aerodrome", "like", "%VA%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        // $lastInsertedVEData = NotamsModel::where("aerodrome", "like", "%VE%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        // $lastInsertedVOData = NotamsModel::where("aerodrome", "like", "%VO%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        // $VIdate = date_create($lastInsertedVIData->toDateTimeString());
        // date_add($VIdate, date_interval_create_from_date_string("330 minutes"));
        // $VAdate = date_create($lastInsertedVAData->toDateTimeString());
        // date_add($VAdate, date_interval_create_from_date_string("330 minutes"));
        // $VEdate = date_create($lastInsertedVEData->toDateTimeString());
        // date_add($VEdate, date_interval_create_from_date_string("330 minutes"));
        // $VOdate = date_create($lastInsertedVOData->toDateTimeString());
        // date_add($VOdate, date_interval_create_from_date_string("330 minutes"));

        $thresholdDate = date_create($notamUpdateCycleStartTime[$id]);
        // if ($id == 3) {
        //     date_add($thresholdDate, date_interval_create_from_date_string("-1 days"));
        // }
        $diff = date_diff($thresholdDate, $lastVerifiedDateTime);
        // $diffVI = date_diff($thresholdDate, $VIdate);
        // $diffVE = date_diff($thresholdDate, $VEdate);
        // $diffVA = date_diff($thresholdDate, $VAdate);

        if ($diff->invert == 1) {
            Mail::send('emails.notams.notam_verify_reminder', array("cycle" => $notamUpdateCycle[$id], "cur_date" => $cur_date), function($message) use($subject) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                // $message->to("ops@eflight.aero");
                // $message->cc("prem@eflight.aero");
                $message->bcc("praveenkmr.t@gmail.com");
            });
            return "Email send";
        }

        return "Not send";
    }

    public function setLastViewedTime() {
        date_default_timezone_set('Asia/Kolkata');
        $insertData = array('user_id' => Auth::id(), "verified_time" => date("y-m-d H:i:s"));
        $prevData = SupervisorLogs::where('user_id', Auth::id())->first();
        if ($prevData == false) {
            SupervisorLogs::insert($insertData);
        } else {
            SupervisorLogs::where('id', '=', $prevData->id)->update(['verified_time' => date("y-m-d H:i:s")]);
        }
        return array('message' => 'success');
    }

    public function getPendingList(Request $request) {
        $requestData = $request->all();
        $last_visited_record = SupervisorLogs::where('user_id', '=', Auth::id())->first();
        if (isset($last_visited_record)) {
            $last_visited_date = date_create($last_visited_record->verified_time);
            date_add($last_visited_date, date_interval_create_from_date_string("-330 minutes"));
        } else {
            $last_visited_date = date_create("01-01-1900");
        }

        $data = NotamsModel::where('aerodrome', 'like', "%" . $requestData['fir'] . "%")->where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->orderBy('updated_at', 'desc')->offset($requestData['offset'] * 100)
                ->limit($requestData['limit'])
                ->get()
                ->map(function ($value, $key) {
            $start_date_formatted = date_create($value['e_start_date']);
            $start_date_formatted_ist = date_create($value['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $value['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $value['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $value['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($value['e_end_date']);
            $end_date_formatted_ist = date_create($value['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $value['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $value['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $value['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
            if ($value['is_daily']) {
                $value['formatted_time'] = $this->combinedTimeForNotam("%" . $value['notam_no'] . "%", 'daily', $value['aerodrome']);
            } elseif ($value['is_weekly']) {
                $value['formatted_time'] = $this->combinedTimeForNotam("%" . $value['notam_no'] . "%", 'weekly', $value['aerodrome']);
            } elseif ($value['is_date_specific']) {
                $value['formatted_time'] = $this->combinedTimeForNotam("%" . $value['notam_no'] . "%", 'specificDate', $value['aerodrome']);
            } else {
                $value['formatted_time'] = " ";
            }
            return $value;
        });
        $last_updated_record = NotamsModel::where('aerodrome', 'like', "%" . $requestData['fir'] . "%")->orderBy('updated_at', 'desc')->first();
        if (isset($last_updated_record)) {
            $last_updatedTime = date_format($last_updated_record->updated_at, "d-M-Y H:i:s a ");
        } else {
            $last_updatedTime = '';
        }

        $count = NotamsModel::where('aerodrome', 'like', "%" . $requestData['fir'] . "%")->where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->count();
        return array('data' => $data->toArray(), 'count' => $count, 'last_updatedTime' => $last_updatedTime);
    }

    public function showAllPending(Request $request) {
        date_default_timezone_set('Asia/Kolkata');

        $insertData = array('user_id' => Auth::id(), "opened_time" => date("y-m-d H:i:s"));
        $prevData = SupervisorLogs::where('user_id', Auth::id())->first();
        if ($prevData == false) {
            SupervisorLogs::insert($insertData);
        } else {
            SupervisorLogs::where('id', '=', $prevData->id)->update(['opened_time' => date("y-m-d H:i:s")]);
        }
        $data = $this->supervisor_stats();

        $vi_last_updated_record = NotamsModel::where('aerodrome', 'like', "%vi%")->orderBy('updated_at', 'desc')->first();
        $vo_last_updated_record = NotamsModel::where('aerodrome', 'like', "%vo%")->orderBy('updated_at', 'desc')->first();
        $va_last_updated_record = NotamsModel::where('aerodrome', 'like', "%va%")->orderBy('updated_at', 'desc')->first();
        $ve_last_updated_record = NotamsModel::where('aerodrome', 'like', "%ve%")->orderBy('updated_at', 'desc')->first();
        if (isset($vi_last_updated_record)) {
            $data['vi_last_updated'] = date_format($vi_last_updated_record->updated_at, "d-M-Y H:i:s a ");
        } else {
            $data['vi_last_updated'] = '';
        }
        if (isset($vo_last_updated_record)) {
            $data['vo_last_updated'] = date_format($vo_last_updated_record->updated_at, "d-M-Y H:i:s a ");
        } else {
            $data['vo_last_updated'] = '';
        }
        if (isset($va_last_updated_record)) {
            $data['va_last_updated'] = date_format($va_last_updated_record->updated_at, "d-M-Y H:i:s a ");
        } else {
            $data['va_last_updated'] = '';
        }
        if (isset($ve_last_updated_record)) {
            $data['ve_last_updated'] = date_format($ve_last_updated_record->updated_at, "d-M-Y H:i:s a ");
        } else {
            $data['ve_last_updated'] = '';
        }
        // $data = $this->supervisor_stats();
        // dd($data);
        return view('notams.supervise_control', $data);
    }

    public function supervisor_stats() {
        $data = array();

        $data['count'] = NotamsModel::where('is_primary', '=', 1)->count();
        $last_visited_record = SupervisorLogs::where('user_id', '=', Auth::id())->first();

        if (isset($last_visited_record)) {

            $last_visited_date = date_create($last_visited_record->verified_time);
            $last_visited_date_ist = date_create($last_visited_record->verified_time);
            date_add($last_visited_date, date_interval_create_from_date_string("-330 minutes"));

            $data['va'] = NotamsModel::where('aerodrome', 'like', "%va%")->where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['ve'] = NotamsModel::where('aerodrome', 'like', "%ve%")->where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['vi'] = NotamsModel::where('aerodrome', 'like', "%vi%")->where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['vo'] = NotamsModel::where('aerodrome', 'like', "%vo%")->where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();

            $data['last_visited'] = NotamsModel::where('updated_at', '>', date_format($last_visited_date, 'y-m-d H:i:s'))->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['last_visited_date'] = "(" . date_format($last_visited_date_ist, 'd-M-Y H:i:s') . " IST)";
        } else {
            $data['va'] = NotamsModel::where('aerodrome', 'like', "%va%")->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['ve'] = NotamsModel::where('aerodrome', 'like', "%ve%")->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['vi'] = NotamsModel::where('aerodrome', 'like', "%vi%")->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['vo'] = NotamsModel::where('aerodrome', 'like', "%vo%")->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();

            $data['last_visited'] = NotamsModel::where('is_primary', '=', 1)->where('is_delete', '=', 0)->count();
            $data['last_visited_date'] = "";
        }
        return $data;
    }

}
