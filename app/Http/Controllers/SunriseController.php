<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SunriseController extends Controller {

    public function index() {
        $lat = 12.9716;
        $lng = 77.5946;
        $month = date('m');
        $year = date('Y');
        $dataArr = array();
        for ($i = 1; $i < 32; $i++) {
            if ($i < 10) {
                $date = "0" . $i . "-" . $month . "-" . $year;
            } else {
                $date = $i . "-" . $month . "-" . $year;
            }
            $val = array(date_format(date_create(($date)), "d-M-Y"), date_sunrise(strtotime($date), SUNFUNCS_RET_STRING, $lat, $lng, 90.5, 5.5), date_sunset(strtotime($date), SUNFUNCS_RET_STRING, $lat, $lng, 90.5, 5.5));
            array_push($dataArr, $val);
        }
        $reqData = array("month" => "5", "location" => "0", "year" => 2017);
        // dd($dataArr);
        return view('riseset', array("data" => $dataArr, "request" => $reqData));
    }

    public function store(Request $request) {
        $monthDayCount = array("1" => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        // dd($monthDayCount);
        // dd($request);
        $latlngInfoArr = array('0' => array(12.9716, 77.5946),
            '1' => array(28.7041, 77.1025),
            '2' => array(13.0827, 80.2707),
            '3' => array(19.0760, 72.8777),
            '4' => array(22.5726, 88.3639));
        $reqData = $request->all();
        $latlngInfo = $latlngInfoArr[$reqData['location']];

        $lat = $latlngInfo[0];
        $lng = $latlngInfo[1];
        $month = $reqData['month'];
        $year = $reqData['year'];
        $dataArr = array();
        for ($i = 1; $i < $monthDayCount[$reqData['month']]; $i++) {
            if ($i < 10) {
                $date = "0" . $i . "-" . $month . "-" . $year;
            } else {
                $date = $i . "-" . $month . "-" . $year;
            }
            $val = array($date, date_sunrise(strtotime($date), SUNFUNCS_RET_STRING, $lat, $lng, 90.5, 5.5), date_sunset(strtotime($date), SUNFUNCS_RET_STRING, $lat, $lng, 90.5, 5.5));
            array_push($dataArr, $val);
        }
        return view('riseset', array("data" => $dataArr, "request" => $reqData));
    }

}
