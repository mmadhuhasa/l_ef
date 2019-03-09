<?php

namespace App\Api\Controllers\Fpl;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\FDTLPopupJob;
use Auth;

class FDTLPopUpControllerAPI extends Controller {

    public function getFDTLPopup(Request $request) {
        $id = $request->id;
        $get_data = \App\models\FlightPlanDetailsModel::where('id', $id)
                ->first(['chocks_on', 'chocks_off', 'landing_time', 'airborne_time']);
        if($get_data){
        $data = ['chocks_on' => $get_data->chocks_on,
            'landing_time' => $get_data->landing_time,
            'chocks_off' => $get_data->chocks_off,
            'airborne_time' => $get_data->airborne_time];
        return response()->json(['STATUS_DESC' => 'SUCCESS', 'STATUS_CODE' => '1','data' =>$data]);
        }
        else{
            return response()->json(['STATUS_DESC' => 'FAIL', 'STATUS_CODE' => '0']);
        }
    }

    public function FDTLPopup(Request $request) {
        $id = $request->fdtl_id;
        $chocks_on = $request->chocks_on;
        $landing_time = $request->landing_time;
        $chocks_off = $request->chocks_off;
        $airborne_time = $request->airborne_time;

        if ($chocks_on < 0 || $chocks_on > 2359 || substr($chocks_on, 0, 2) > 23 || substr($chocks_on, 2, 2) > 59) {
            return response()->json(['STATUS_DESC' => 'Chocks on time not valid', 'STATUS_CODE' => '0']);
        }
        if ($landing_time < 0 || $landing_time > 2359 || substr($landing_time, 0, 2) > 23 || substr($landing_time, 2, 2) > 59) {
            return response()->json(['STATUS_DESC' => 'Landing time not valid', 'STATUS_CODE' => '0']);
        }
        if ($chocks_off < 0 || $chocks_off > 2359 || substr($chocks_off, 0, 2) > 23 || substr($chocks_off, 2, 2) > 59) {
            return response()->json(['STATUS_DESC' => 'Chocks off time not valid', 'STATUS_CODE' => '0']);
        }
        if ($airborne_time < 0 || $airborne_time > 2359 || substr($airborne_time, 0, 2) > 23 || substr($airborne_time, 2, 2) > 59) {
            return response()->json(['STATUS_DESC' => 'Airborne time not valid', 'STATUS_CODE' => '0']);
        }

        if ($chocks_on == '' || $landing_time == '' || $chocks_off == '' || $airborne_time == '') {
            return response()->json(['STATUS_DESC' => 'Pls enter all the fields', 'STATUS_CODE' => '0']);
        }

        if ($chocks_on < $landing_time) {
            return response()->json(['STATUS_DESC' => 'Chocks On Time cannot be less than Landing Time', 'STATUS_CODE' => '0']);
        } else if ($landing_time < $airborne_time) {
            return response()->json(['STATUS_DESC' => 'Landing Time cannot be less than Airborne Time', 'STATUS_CODE' => '0']);
        } else if ($airborne_time < $chocks_off) {
            return response()->json(['STATUS_DESC' => 'Airborne Time cannot be less than Chocks Off Time', 'STATUS_CODE' => '0']);
        }

        $flying_time = abs($landing_time - $airborne_time);

        $fdtl_departure_aerodrome = $request->fdtl_departure_aerodrome;
        $fdtl_destination_aerodrome = $request->fdtl_destination_aerodrome;
        $fdtl_aircraft_callsign = $request->fdtl_aircraft_callsign;
        $fdtl_date_of_flight = $request->fdtl_date_of_flight;

        $fdtl_date_of_flight = date('d-M-Y', strtotime($fdtl_date_of_flight));

        $subject = "FDTL FOR " . $fdtl_aircraft_callsign . " " . $fdtl_departure_aerodrome . "-" .
                $fdtl_destination_aerodrome . " // " . $fdtl_date_of_flight;

        $user_id = Auth::user()->id;
        $entered_by = Auth::user()->name;
        date_default_timezone_set('Asia/Kolkata');
        $entered_date = date('Y-m-d');
        $entered_time = date('H:i:s');

        $data = ['chocks_on' => $chocks_on,
            'landing_time' => $landing_time,
            'chocks_off' => $chocks_off,
            'airborne_time' => $airborne_time];

        $fpl_update = \App\models\FlightPlanDetailsModel::where('id', $id)->update($data);

        $data['subject'] = $subject;
        $data['flying_time'] = $flying_time;

        $data['entered_by'] = "Entered  By: <span style='color:red;'>$entered_by</span>";
        $data['entered_date'] = "<span style='margin-left:27px;color:#404040;'></span>Entered  Date: <span style='color:red;'>" . $entered_date . "</span>";
        $data['entered_time'] = "<span style='margin-left:27px;color:#404040;'></span> Entered  Time: <span style='color:red;'>" . $entered_time . "  IST" . "</span>";

        $this->dispatch(new FDTLPopupJob($data));
        return response()->json(['STATUS_DESC' => 'FDTL submitted successfully', 'STATUS_CODE' => '1']);
    }

}
