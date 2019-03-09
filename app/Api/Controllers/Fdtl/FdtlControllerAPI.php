<?php

namespace App\Api\Controllers\Fdtl;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Api\Controllers\Fdtl\FirstLandingAPI;
use App\Api\Controllers\Fdtl\SecondLandingAPI;
use App\Api\Controllers\Fdtl\ThirdLandingAPI;
use App\Api\Controllers\Fdtl\FourthLandingAPI;
use App\Api\Controllers\Fdtl\FifthLandingAPI;
use App\Api\Controllers\Fdtl\SixthLandingAPI;
use App\models\FdtlAPIModel;
use Exception;

class FdtlControllerAPI extends Controller {

    public function index() {
        // return '{"STATUS_CODE":0,"STATUS_MESSAGE":"Not Found","DATA":""}';
    }

    /**
     * @api {POST} /api/fdtl/fdtl_store_first_landing/{id}  First Landing
     * @apiName First Landing
     * @apiGroup fdtl API's
     *    
     * @apiParam {String} aircraft_callsign Aircraft Callsign
     * @apiParam {String} departure_aerodrome Departure Aerodrome
     * @apiParam {String} destination_aerodrome Destination Aerodrome
     * @apiParam {String} date_of_flight Date Of Flight
     * @apiParam {String} departure_time Departure Time
     * @apiParam {String} total_flying_time Total Flying Time
    

     * @apiSuccess {String} STATUS_MESSAGE  Success .
     * @apiSuccess {String} STATUS  200 .
     * 
     * * @apiSuccessExample Success-Response:
     *      
      {
      "STATUS": "200",
      "STATUS_MESSAGE": "Success",
      "data": {
      "reporting_time": "0515 GMT (1045 IST)",
      "chocks_off": "0555 GMT (1125 IST)",
      "chocks_on": "1005 GMT (1535 IST)",
      "duty_end_time": "1020 GMT (1550 IST)",
      "flight_time": "04 Hours 10 Minutes ",
      "flight_duty_period": "05 Hours 05 Minutes ",
      "split_duty": "NOT APPLICABLE",
      "split_duty_condition_value": "0",
      "total_FT": "04 Hours 10 Minutes ",
      "total_FT_condition_value": "0",
      "total_fdp": "05 Hours 05 Minutes ",
      "total_fdp_condition_value": "0",
      "last_dep_time": "21:05 (WITHOUT SPLIT DUTY)",
      "last_arrival_time": "22:45 (WITHOUT SPLIT DUTY)",
      "next_day_take_off": "00:50 GMT (0620 IST)"
      }
      }

     * @apiErrorExample Error-Response:
     *     
     *     {
      "STATUS" => "404",
     *       "STATUS_MESSAGE": "Not Found"
     *     }
     *    
     */
    public function fdtl_store_first_landing(Request $request, $id) {

        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome1 = $request->departure_aerodrome;
        $destination_aerodrome1 = $request->destination_aerodrome;
        $date_of_flight1 = $request->date_of_flight;
        $departure_time1 = $request->departure_time;
        $total_flying_time1 = $request->total_flying_time;

        $current_landing = '1';

        $data = [
            'id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight1' => $date_of_flight1,
            'departure_time1' => $departure_time1,
            'total_flying_time1' => $total_flying_time1,
        ];
        $results = FirstLandingAPI::insert_data($data);

        //return $results; 

        $dep_time_total_time = ($results) ? $results['dep_time_total_time'] : "";
        $reporting_time_display = ($results) ? $results['reporting_time1'] : "";
        $chocks_off_display = ($results) ? $results['chocks_off1'] : "";
        $chocks_on_display = ($results) ? $results['chocks_on1'] : "";
        $duty_end_time_display = ($results) ? $results['duty_end_time1'] : "";
        $flight_time_display = ($results) ? $results['flight_time1'] : "";
        $flight_duty_period_display = ($results) ? $results['flight_duty_period1'] : "";
        $split_duty_display = ($results) ? $results['split_duty1'] : "";
        $split_duty1_condition_value = ($results) ? $results['split_duty1_condition_value'] : "";
        $total_FT_display = ($results) ? $results['total_FT1'] : "";
        $total_FT_condition_value = ($results) ? $results['total_FT_condition_value'] : "";
        $total_fdp_display = ($results) ? $results['total_fdp1'] : "";
        $total_fdp_condition_value = ($results) ? $results['total_fdp_condition_value'] : "";
        $last_dep_time_display = ($results) ? $results['last_dep_time1'] : "";
        $last_arrival_time_display = ($results) ? $results['last_arrival_time1'] : "";
        $next_day_take_off_display = ($results) ? $results['next_day_take_off1'] : "";



        $reporting_time1_value = ($results) ? $results['reporting_time1_value'] : "";
        $flight_time1_value = ($results) ? $results['flight_time1_value'] : "";
        $chocks_off1_value = ($results) ? $results['chocks_off1_value'] : "";
        $chocks_on1_value = ($results) ? $results['chocks_on1_value'] : "";
        $duty_end_time1_value = ($results) ? $results['duty_end_time1_value'] : "";
        $flight_duty_period1_value = ($results) ? $results['flight_duty_period1_value'] : "";
        $split_duty1_value = ($results) ? $results['split_duty1_value'] : "";
        $total_FT1_value = ($results) ? $results['total_FT1_value'] : "";
        $total_fdp1_value = ($results) ? $results['total_fdp1_value'] : "";
        $last_dep_time1_value = ($results) ? $results['last_dep_time1_value'] : "";
        $last_arrival_time1_value = ($results) ? $results['last_arrival_time1_value'] : "";
        $next_day_take_off1_value = ($results) ? $results['next_day_take_off1_value'] : "";




        $data_array = [
            'id' => '',
            'user_id' => $id,
            'no_of_landings' => '1',
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight' => $date_of_flight1,
            'departure_aerodrome' => $departure_aerodrome1,
            'destination_aerodrome' => $destination_aerodrome1,
            'departure_time' => $departure_time1,
            'total_flying_time' => $total_flying_time1,
            'dep_time_total_time' => $dep_time_total_time,
            'reporting_time' => $reporting_time1_value,
            'flight_time' => $flight_time1_value,
            'chocks_off' => $chocks_off1_value,
            'chocks_on' => $chocks_on1_value,
            'duty_end_time' => $duty_end_time1_value,
            'flight_duty_period' => $flight_duty_period1_value,
            'split_duty' => $split_duty1_value,
            'is_split_duty' => $split_duty1_condition_value,
            'total_ft' => $total_FT1_value,
            'is_total_ft' => $total_FT_condition_value,
            'total_flight_duty_period' => $total_fdp1_value,
            'is_total_fdp' => $total_fdp_condition_value,
            'today_next_plan_last_dep_time' => $last_dep_time1_value,
            'today_last_duty_end_time' => $last_arrival_time1_value,
            'next_day_earliest_dep_time' => $next_day_take_off1_value,
        ];


        $fdtl_api_details = FdtlAPIModel::create($data_array);
        $reporting_time = ($fdtl_api_details) ? $fdtl_api_details->reporting_time : '';
        $chocks_off = ($fdtl_api_details) ? $fdtl_api_details->chocks_off : "";
        $chocks_on = ($fdtl_api_details) ? $fdtl_api_details->chocks_on : "";
        $duty_end_time = ($fdtl_api_details) ? $fdtl_api_details->duty_end_time : "";
        $flight_time = ($fdtl_api_details) ? $fdtl_api_details->flight_time : "";
        $flight_duty_period = ($fdtl_api_details) ? $fdtl_api_details->flight_duty_period : "";
        $split_duty = ($fdtl_api_details) ? $fdtl_api_details->split_duty : "";
        $total_FT = ($fdtl_api_details) ? $fdtl_api_details->total_FT : "";
        $total_fdp = ($fdtl_api_details) ? $fdtl_api_details->total_flight_duty_period : "";
        $last_dep_time = ($fdtl_api_details) ? $fdtl_api_details->today_next_plan_last_dep_time : "";
        $last_arrival_time = ($fdtl_api_details) ? $fdtl_api_details->today_last_duty_end_time : "";
        $next_day_take_off = ($fdtl_api_details) ? $fdtl_api_details->next_day_earliest_dep_time : "";

        if ($fdtl_api_details) {
            $output = [
                'reporting_time' => $reporting_time_display,
                'chocks_off' => $chocks_off_display,
                'chocks_on' => $chocks_on_display,
                'duty_end_time' => $duty_end_time_display,
                'flight_time' => $flight_time_display,
                'flight_duty_period' => $flight_duty_period_display,
                'split_duty' => $split_duty_display,
                'split_duty_condition_value' => $split_duty1_condition_value,
                'total_FT' => $total_FT_display,
                'total_FT_condition_value' => $total_FT_condition_value,
                'total_fdp' => $total_fdp_display,
                'total_fdp_condition_value' => $total_fdp_condition_value,
                'last_dep_time' => $last_dep_time_display,
                'last_arrival_time' => $last_arrival_time_display,
                'next_day_take_off' => $next_day_take_off_display,
            ];

            $response = response()->json([
                "STATUS" => "200",
                "STATUS_MESSAGE" => "Success",
                "data" => $output
            ]);
        } else {
            $output = [];

            $response = response()->json([
                "STATUS" => "404",
                "STATUS_MESSAGE" => "Not Found",
                "data" => $output
            ]);
        }





        return $response;
    }

    /**
     * @api {POST} /api/fdtl/fdtl_store_second_landing/{id}  Second Landing
     * @apiName Second Landing
     * @apiGroup fdtl API's
     *
     * @apiParam {String} aircraft_callsign Aircraft Callsign
     * @apiParam {String} departure_aerodrome Departure Aerodrome
     * @apiParam {String} destination_aerodrome Destination Aerodrome
     * @apiParam {String} date_of_flight Date Of Flight
     * @apiParam {String} departure_time Departure Time
     * @apiParam {String} total_flying_time Total Flying Time   
     *  
     * @apiSuccess {String} STATUS_MESSAGE  Success .
     * @apiSuccess {String} STATUS  200 .
     * 
     * * @apiSuccessExample Success-Response:
     *      
      {
      "STATUS": "200",
      "STATUS_MESSAGE": "Success",
      "data": {
      "reporting_time": "0515 GMT (1045 IST)",
      "chocks_off": "0555 GMT (1125 IST)",
      "chocks_on": "1005 GMT (1535 IST)",
      "duty_end_time": "1020 GMT (1550 IST)",
      "flight_time": "04 Hours 10 Minutes ",
      "flight_duty_period": "05 Hours 05 Minutes ",
      "split_duty": "NOT APPLICABLE",
      "split_duty_condition_value": "0",
      "total_FT": "04 Hours 10 Minutes ",
      "total_FT_condition_value": "0",
      "total_fdp": "05 Hours 05 Minutes ",
      "total_fdp_condition_value": "0",
      "last_dep_time": "21:05 (WITHOUT SPLIT DUTY)",
      "last_arrival_time": "22:45 (WITHOUT SPLIT DUTY)",
      "next_day_take_off": "00:50 GMT (0620 IST)"
      }
      }

     * @apiErrorExample Error-Response:
     *     
     *     {
      "STATUS" => "404",
     *       "STATUS_MESSAGE": "Not Found"
     *     }
     *    
     */
    public function fdtl_store_second_landing(Request $request, $id) {

        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome2 = $request->departure_aerodrome;
        $destination_aerodrome2 = $request->destination_aerodrome;
        $date_of_flight2 = $request->date_of_flight;
        $departure_time2 = $request->departure_time;
        $total_flying_time2 = $request->total_flying_time;
        $current_landing = '2';

        $data = [
            'id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'departure_aerodrome2' => $departure_aerodrome2,
            'destination_aerodrome2' => $destination_aerodrome2,
            'date_of_flight2' => $date_of_flight2,
            'departure_time2' => $departure_time2,
            'total_flying_time2' => $total_flying_time2,
        ];
        $results = SecondLandingAPI::insert_data($data);

        $dep_time_total_time = ($results) ? $results['dep_time_total_time2'] : "";
        $reporting_time_display = ($results) ? $results['reporting_time2'] : "";
        $chocks_off_display = ($results) ? $results['chocks_off2'] : "";
        $chocks_on_display = ($results) ? $results['chocks_on2'] : "";
        $duty_end_time_display = ($results) ? $results['duty_end_time2'] : "";
        $flight_time_display = ($results) ? $results['flight_time2'] : "";
        $flight_duty_period_display = ($results) ? $results['flight_duty_period2'] : "";
        $split_duty_display = ($results) ? $results['split_duty2'] : "";
        $split_duty_condition_value = ($results) ? $results['split_duty2_condition_value'] : "";
        $total_FT_display = ($results) ? $results['total_FT2'] : "";
        $total_FT_condition_value = ($results) ? $results['total_FT_condition_value'] : "";
        $total_fdp_display = ($results) ? $results['total_fdp2'] : "";
        $total_fdp_condition_value = ($results) ? $results['total_fdp_condition_value'] : "";
        $last_dep_time_display = ($results) ? $results['last_dep_time2'] : "";
        $last_arrival_time_display = ($results) ? $results['last_arrival_time2'] : "";
        $next_day_take_off_display = ($results) ? $results['next_day_take_off2'] : "";

        $reporting_time2_value = ($results) ? $results['reporting_time2_value'] : "";
        $flight_time2_value = ($results) ? $results['flight_time2_value'] : "";
        $chocks_off2_value = ($results) ? $results['chocks_off2_value'] : "";
        $chocks_on2_value = ($results) ? $results['chocks_on2_value'] : "";
        $duty_end_time2_value = ($results) ? $results['duty_end_time2_value'] : "";
        $flight_duty_period2_value = ($results) ? $results['flight_duty_period2_value'] : "";
        $split_duty2_value = ($results) ? $results['split_duty2_value'] : "";
        $total_FT2_value = ($results) ? $results['total_FT2_value'] : "";
        $total_fdp2_value = ($results) ? $results['total_fdp2_value'] : "";
        $last_dep_time2_value = ($results) ? $results['last_dep_time2_value'] : "";
        $last_arrival_time2_value = ($results) ? $results['last_arrival_time2_value'] : "";
        $next_day_take_off2_value = ($results) ? $results['next_day_take_off2_value'] : "";


        $data_array = [
            'id' => '',
            'user_id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight' => $date_of_flight2,
            'departure_aerodrome' => $departure_aerodrome2,
            'destination_aerodrome' => $destination_aerodrome2,
            'departure_time' => $departure_time2,
            'total_flying_time' => $total_flying_time2,
            'dep_time_total_time' => $dep_time_total_time,
            'reporting_time' => $reporting_time2_value,
            'flight_time' => $flight_time2_value,
            'chocks_off' => $chocks_off2_value,
            'chocks_on' => $chocks_on2_value,
            'duty_end_time' => $duty_end_time2_value,
            'flight_duty_period' => $flight_duty_period2_value,
            'split_duty' => $split_duty2_value,
            'is_split_duty' => $split_duty_condition_value,
            'total_ft' => $total_FT2_value,
            'is_total_ft' => $total_FT_condition_value,
            'total_flight_duty_period' => $total_fdp2_value,
            'is_total_fdp' => $total_fdp_condition_value,
            'today_next_plan_last_dep_time' => $last_dep_time2_value,
            'today_last_duty_end_time' => $last_arrival_time2_value,
            'next_day_earliest_dep_time' => $next_day_take_off2_value,
        ];

        $fdtl_api_details = FdtlAPIModel::create($data_array);
        $reporting_time = ($fdtl_api_details) ? $fdtl_api_details->reporting_time : '';
        $chocks_off = ($fdtl_api_details) ? $fdtl_api_details->chocks_off : "";
        $chocks_on = ($fdtl_api_details) ? $fdtl_api_details->chocks_on : "";
        $duty_end_time = ($fdtl_api_details) ? $fdtl_api_details->duty_end_time : "";
        $flight_time = ($fdtl_api_details) ? $fdtl_api_details->flight_time : "";
        $flight_duty_period = ($fdtl_api_details) ? $fdtl_api_details->flight_duty_period : "";
        $split_duty = ($fdtl_api_details) ? $fdtl_api_details->split_duty : "";
        $total_FT = ($fdtl_api_details) ? $fdtl_api_details->total_FT : "";
        $total_fdp = ($fdtl_api_details) ? $fdtl_api_details->total_flight_duty_period : "";
        $last_dep_time = ($fdtl_api_details) ? $fdtl_api_details->today_next_plan_last_dep_time : "";
        $last_arrival_time = ($fdtl_api_details) ? $fdtl_api_details->today_last_duty_end_time : "";
        $next_day_take_off = ($fdtl_api_details) ? $fdtl_api_details->next_day_earliest_dep_time : "";

        if ($fdtl_api_details) {
            $output = [
                'reporting_time' => $reporting_time_display,
                'chocks_off' => $chocks_off_display,
                'chocks_on' => $chocks_on_display,
                'duty_end_time' => $duty_end_time_display,
                'flight_time' => $flight_time_display,
                'flight_duty_period' => $flight_duty_period_display,
                'split_duty' => $split_duty_display,
                'split_duty_condition_value' => $split_duty_condition_value,
                'total_FT' => $total_FT_display,
                'total_FT_condition_value' => $total_FT_condition_value,
                'total_fdp' => $total_fdp_display,
                'total_fdp_condition_value' => $total_fdp_condition_value,
                'last_dep_time' => $last_dep_time_display,
                'last_arrival_time' => $last_arrival_time_display,
                'next_day_take_off' => $next_day_take_off_display,
            ];


            $response = response()->json([
                "STATUS" => "200",
                "STATUS_MESSAGE" => "Success",
                "data" => $output
            ]);
        } else {
            $output = [];
            $response = response()->json([
                "STATUS" => "404",
                "STATUS_MESSAGE" => "Not Found",
                "data" => $output
            ]);
        }



        return $response;
    }

    /**
     * @api {POST} /api/fdtl/fdtl_store_third_landing/{id}  Third Landing
     * @apiName Third Landing
     * @apiGroup fdtl API's
     * 
     * @apiParam {String} aircraft_callsign Aircraft Callsign
     * @apiParam {String} departure_aerodrome Departure Aerodrome
     * @apiParam {String} destination_aerodrome Destination Aerodrome
     * @apiParam {String} date_of_flight Date Of Flight
     * @apiParam {String} departure_time Departure Time
     * @apiParam {String} total_flying_time Total Flying Time
     *     
     * @apiSuccess {String} STATUS_MESSAGE  Success .
     * @apiSuccess {String} STATUS  200 .
     * 
     * * @apiSuccessExample Success-Response:
     *      
      {
      "STATUS": "200",
      "STATUS_MESSAGE": "Success",
      "data": {
      "reporting_time": "0515 GMT (1045 IST)",
      "chocks_off": "0555 GMT (1125 IST)",
      "chocks_on": "1005 GMT (1535 IST)",
      "duty_end_time": "1020 GMT (1550 IST)",
      "flight_time": "04 Hours 10 Minutes ",
      "flight_duty_period": "05 Hours 05 Minutes ",
      "split_duty": "NOT APPLICABLE",
      "split_duty_condition_value": "0",
      "total_FT": "04 Hours 10 Minutes ",
      "total_FT_condition_value": "0",
      "total_fdp": "05 Hours 05 Minutes ",
      "total_fdp_condition_value": "0",
      "last_dep_time": "21:05 (WITHOUT SPLIT DUTY)",
      "last_arrival_time": "22:45 (WITHOUT SPLIT DUTY)",
      "next_day_take_off": "00:50 GMT (0620 IST)"
      }
      }

     * @apiErrorExample Error-Response:
     *     
     *     {
      "STATUS" => "404",
     *       "STATUS_MESSAGE": "Not Found"
     *     }
     *    
     */
    public function fdtl_store_third_landing(Request $request, $id) {
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome3 = $request->departure_aerodrome;
        $destination_aerodrome3 = $request->destination_aerodrome;
        $date_of_flight3 = $request->date_of_flight;
        $departure_time3 = $request->departure_time;
        $total_flying_time3 = $request->total_flying_time;
        $current_landing = '3';

        $data = [
            'id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'departure_aerodrome3' => $departure_aerodrome3,
            'destination_aerodrome3' => $destination_aerodrome3,
            'date_of_flight3' => $date_of_flight3,
            'departure_time3' => $departure_time3,
            'total_flying_time3' => $total_flying_time3,
        ];

        $results = ThirdLandingAPI::insert_data($data);

        $dep_time_total_time = ($results) ? $results['dep_time_total_time3'] : "";
        $reporting_time_display = ($results) ? $results['reporting_time3'] : "";
        $chocks_off_display = ($results) ? $results['chocks_off3'] : "";
        $chocks_on_display = ($results) ? $results['chocks_on3'] : "";
        $duty_end_time_display = ($results) ? $results['duty_end_time3'] : "";
        $flight_time_display = ($results) ? $results['flight_time3'] : "";
        $flight_duty_period_display = ($results) ? $results['flight_duty_period3'] : "";
        $split_duty_display = ($results) ? $results['split_duty3'] : "";
        $split_duty_condition_value = ($results) ? $results['split_duty3_condition_value'] : "";
        $total_FT_display = ($results) ? $results['total_FT3'] : "";
        $total_FT_condition_value = ($results) ? $results['total_FT_condition_value'] : "";
        $total_fdp_display = ($results) ? $results['total_fdp3'] : "";
        $total_fdp_condition_value = ($results) ? $results['total_fdp_condition_value'] : "";
        $last_dep_time_display = ($results) ? $results['last_dep_time3'] : "";
        $last_arrival_time_display = ($results) ? $results['last_arrival_time3'] : "";
        $next_day_take_off_display = ($results) ? $results['next_day_take_off3'] : "";

        $reporting_time3_value = ($results) ? $results['reporting_time3_value'] : "";
        $flight_time3_value = ($results) ? $results['flight_time3_value'] : "";
        $chocks_off3_value = ($results) ? $results['chocks_off3_value'] : "";
        $chocks_on3_value = ($results) ? $results['chocks_on3_value'] : "";
        $duty_end_time3_value = ($results) ? $results['duty_end_time3_value'] : "";
        $flight_duty_period3_value = ($results) ? $results['flight_duty_period3_value'] : "";
        $split_duty3_value = ($results) ? $results['split_duty3_value'] : "";
        $total_FT3_value = ($results) ? $results['total_FT3_value'] : "";
        $total_fdp3_value = ($results) ? $results['total_fdp3_value'] : "";
        $last_dep_time3_value = ($results) ? $results['last_dep_time3_value'] : "";
        $last_arrival_time3_value = ($results) ? $results['last_arrival_time3_value'] : "";
        $next_day_take_off3_value = ($results) ? $results['next_day_take_off3_value'] : "";


        $data_array = [
            'id' => '',
            'user_id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight' => $date_of_flight3,
            'departure_aerodrome' => $departure_aerodrome3,
            'destination_aerodrome' => $destination_aerodrome3,
            'departure_time' => $departure_time3,
            'total_flying_time' => $total_flying_time3,
            'dep_time_total_time' => $dep_time_total_time,
            'reporting_time' => $reporting_time3_value,
            'flight_time' => $flight_time3_value,
            'chocks_off' => $chocks_off3_value,
            'chocks_on' => $chocks_on3_value,
            'duty_end_time' => $duty_end_time3_value,
            'flight_duty_period' => $flight_duty_period3_value,
            'split_duty' => $split_duty3_value,
            'is_split_duty' => $split_duty_condition_value,
            'total_ft' => $total_FT3_value,
            'is_total_ft' => $total_FT_condition_value,
            'total_flight_duty_period' => $total_fdp3_value,
            'is_total_fdp' => $total_fdp_condition_value,
            'today_next_plan_last_dep_time' => $last_dep_time3_value,
            'today_last_duty_end_time' => $last_arrival_time3_value,
            'next_day_earliest_dep_time' => $next_day_take_off3_value,
        ];

        $fdtl_api_details = FdtlAPIModel::create($data_array);
        $reporting_time = ($fdtl_api_details) ? $fdtl_api_details->reporting_time : '';
        $chocks_off = ($fdtl_api_details) ? $fdtl_api_details->chocks_off : "";
        $chocks_on = ($fdtl_api_details) ? $fdtl_api_details->chocks_on : "";
        $duty_end_time = ($fdtl_api_details) ? $fdtl_api_details->duty_end_time : "";
        $flight_time = ($fdtl_api_details) ? $fdtl_api_details->flight_time : "";
        $flight_duty_period = ($fdtl_api_details) ? $fdtl_api_details->flight_duty_period : "";
        $split_duty = ($fdtl_api_details) ? $fdtl_api_details->split_duty : "";
        $total_FT = ($fdtl_api_details) ? $fdtl_api_details->total_FT : "";
        $total_fdp = ($fdtl_api_details) ? $fdtl_api_details->total_flight_duty_period : "";
        $last_dep_time = ($fdtl_api_details) ? $fdtl_api_details->today_next_plan_last_dep_time : "";
        $last_arrival_time = ($fdtl_api_details) ? $fdtl_api_details->today_last_duty_end_time : "";
        $next_day_take_off = ($fdtl_api_details) ? $fdtl_api_details->next_day_earliest_dep_time : "";

        if ($fdtl_api_details) {
            $output = [
                'reporting_time' => $reporting_time_display,
                'chocks_off' => $chocks_off_display,
                'chocks_on' => $chocks_on_display,
                'duty_end_time' => $duty_end_time_display,
                'flight_time' => $flight_time_display,
                'flight_duty_period' => $flight_duty_period_display,
                'split_duty' => $split_duty_display,
                'split_duty_condition_value' => $split_duty_condition_value,
                'total_FT' => $total_FT_display,
                'total_FT_condition_value' => $total_FT_condition_value,
                'total_fdp' => $total_fdp_display,
                'total_fdp_condition_value' => $total_fdp_condition_value,
                'last_dep_time' => $last_dep_time_display,
                'last_arrival_time' => $last_arrival_time_display,
                'next_day_take_off' => $next_day_take_off_display,
            ];

            $response = response()->json([
                "STATUS" => "200",
                "STATUS_MESSAGE" => "Success",
                "data" => $output
            ]);
        } else {
            $output = [];
            $response = response()->json([
                "STATUS" => "404",
                "STATUS_MESSAGE" => "Not Found",
                "data" => $output
            ]);
        }



        return $response;
    }

    /**
     * @api {POST} /api/fdtl/fdtl_store_fourth_landing/{id}  Fourth Landing
     * @apiName Fourth Landing
     * @apiGroup fdtl API's
     * 
     * @apiParam {String} aircraft_callsign Aircraft Callsign
     * @apiParam {String} departure_aerodrome Departure Aerodrome
     * @apiParam {String} destination_aerodrome Destination Aerodrome
     * @apiParam {String} date_of_flight Date Of Flight
     * @apiParam {String} departure_time Departure Time
     * @apiParam {String} total_flying_time Total Flying Time
     *    
     * @apiSuccess {String} STATUS_MESSAGE  Success .
     * @apiSuccess {String} STATUS  200 .
     * 
     * * @apiSuccessExample Success-Response:
     *      
      {
      "STATUS": "200",
      "STATUS_MESSAGE": "Success",
      "data": {
      "reporting_time": "0515 GMT (1045 IST)",
      "chocks_off": "0555 GMT (1125 IST)",
      "chocks_on": "1005 GMT (1535 IST)",
      "duty_end_time": "1020 GMT (1550 IST)",
      "flight_time": "04 Hours 10 Minutes ",
      "flight_duty_period": "05 Hours 05 Minutes ",
      "split_duty": "NOT APPLICABLE",
      "split_duty_condition_value": "0",
      "total_FT": "04 Hours 10 Minutes ",
      "total_FT_condition_value": "0",
      "total_fdp": "05 Hours 05 Minutes ",
      "total_fdp_condition_value": "0",
      "last_dep_time": "21:05 (WITHOUT SPLIT DUTY)",
      "last_arrival_time": "22:45 (WITHOUT SPLIT DUTY)",
      "next_day_take_off": "00:50 GMT (0620 IST)"
      }
      }

     * @apiErrorExample Error-Response:
     *     
     *     {
      "STATUS" => "404",
     *       "STATUS_MESSAGE": "Not Found"
     *     }
     *    
     */
    public function fdtl_store_fourth_landing(Request $request, $id) {
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome4 = $request->departure_aerodrome;
        $destination_aerodrome4 = $request->destination_aerodrome;
        $date_of_flight4 = $request->date_of_flight;
        $departure_time4 = $request->departure_time;
        $total_flying_time4 = $request->total_flying_time;
        $current_landing = '4';

        $data = [
            'id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'departure_aerodrome4' => $departure_aerodrome4,
            'destination_aerodrome4' => $destination_aerodrome4,
            'date_of_flight4' => $date_of_flight4,
            'departure_time4' => $departure_time4,
            'total_flying_time4' => $total_flying_time4,
        ];

        $results = FourthLandingAPI::insert_data($data);

        $dep_time_total_time = ($results) ? $results['dep_time_total_time4'] : "";
        $reporting_time_display = ($results) ? $results['reporting_time4'] : "";
        $chocks_off_display = ($results) ? $results['chocks_off4'] : "";
        $chocks_on_display = ($results) ? $results['chocks_on4'] : "";
        $duty_end_time_display = ($results) ? $results['duty_end_time4'] : "";
        $flight_time_display = ($results) ? $results['flight_time4'] : "";
        $flight_duty_period_display = ($results) ? $results['flight_duty_period4'] : "";
        $split_duty_display = ($results) ? $results['split_duty4'] : "";
        $split_duty_condition_value = ($results) ? $results['split_duty4_condition_value'] : "";
        $total_FT_display = ($results) ? $results['total_FT4'] : "";
        $total_FT_condition_value = ($results) ? $results['total_FT_condition_value'] : "";
        $total_fdp_display = ($results) ? $results['total_fdp4'] : "";
        $total_fdp_condition_value = ($results) ? $results['total_fdp_condition_value'] : "";
        $last_dep_time_display = ($results) ? $results['last_dep_time4'] : "";
        $last_arrival_time_display = ($results) ? $results['last_arrival_time4'] : "";
        $next_day_take_off_display = ($results) ? $results['next_day_take_off4'] : "";

        $reporting_time4_value = ($results) ? $results['reporting_time4_value'] : "";
        $flight_time4_value = ($results) ? $results['flight_time4_value'] : "";
        $chocks_off4_value = ($results) ? $results['chocks_off4_value'] : "";
        $chocks_on4_value = ($results) ? $results['chocks_on4_value'] : "";
        $duty_end_time4_value = ($results) ? $results['duty_end_time4_value'] : "";
        $flight_duty_period4_value = ($results) ? $results['flight_duty_period4_value'] : "";
        $split_duty4_value = ($results) ? $results['split_duty4_value'] : "";
        $total_FT4_value = ($results) ? $results['total_FT4_value'] : "";
        $total_fdp4_value = ($results) ? $results['total_fdp4_value'] : "";
        $last_dep_time4_value = ($results) ? $results['last_dep_time4_value'] : "";
        $last_arrival_time4_value = ($results) ? $results['last_arrival_time4_value'] : "";
        $next_day_take_off4_value = ($results) ? $results['next_day_take_off4_value'] : "";


        $data_array = [
            'id' => '',
            'user_id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight' => $date_of_flight4,
            'departure_aerodrome' => $departure_aerodrome4,
            'destination_aerodrome' => $destination_aerodrome4,
            'departure_time' => $departure_time4,
            'total_flying_time' => $total_flying_time4,
            'dep_time_total_time' => $dep_time_total_time,
            'reporting_time' => $reporting_time4_value,
            'flight_time' => $flight_time4_value,
            'chocks_off' => $chocks_off4_value,
            'chocks_on' => $chocks_on4_value,
            'duty_end_time' => $duty_end_time4_value,
            'flight_duty_period' => $flight_duty_period4_value,
            'split_duty' => $split_duty4_value,
            'is_split_duty' => $split_duty_condition_value,
            'total_ft' => $total_FT4_value,
            'is_total_ft' => $total_FT_condition_value,
            'total_flight_duty_period' => $total_fdp4_value,
            'is_total_fdp' => $total_fdp_condition_value,
            'today_next_plan_last_dep_time' => $last_dep_time4_value,
            'today_last_duty_end_time' => $last_arrival_time4_value,
            'next_day_earliest_dep_time' => $next_day_take_off4_value,
        ];

        $fdtl_api_details = FdtlAPIModel::create($data_array);
        $reporting_time = ($fdtl_api_details) ? $fdtl_api_details->reporting_time : '';
        $chocks_off = ($fdtl_api_details) ? $fdtl_api_details->chocks_off : "";
        $chocks_on = ($fdtl_api_details) ? $fdtl_api_details->chocks_on : "";
        $duty_end_time = ($fdtl_api_details) ? $fdtl_api_details->duty_end_time : "";
        $flight_time = ($fdtl_api_details) ? $fdtl_api_details->flight_time : "";
        $flight_duty_period = ($fdtl_api_details) ? $fdtl_api_details->flight_duty_period : "";
        $split_duty = ($fdtl_api_details) ? $fdtl_api_details->split_duty : "";
        $total_FT = ($fdtl_api_details) ? $fdtl_api_details->total_FT : "";
        $total_fdp = ($fdtl_api_details) ? $fdtl_api_details->total_flight_duty_period : "";
        $last_dep_time = ($fdtl_api_details) ? $fdtl_api_details->today_next_plan_last_dep_time : "";
        $last_arrival_time = ($fdtl_api_details) ? $fdtl_api_details->today_last_duty_end_time : "";
        $next_day_take_off = ($fdtl_api_details) ? $fdtl_api_details->next_day_earliest_dep_time : "";

        if ($fdtl_api_details) {
            $output = [
                'reporting_time' => $reporting_time_display,
                'chocks_off' => $chocks_off_display,
                'chocks_on' => $chocks_on_display,
                'duty_end_time' => $duty_end_time_display,
                'flight_time' => $flight_time_display,
                'flight_duty_period' => $flight_duty_period_display,
                'split_duty' => $split_duty_display,
                'split_duty_condition_value' => $split_duty_condition_value,
                'total_FT' => $total_FT_display,
                'total_FT_condition_value' => $total_FT_condition_value,
                'total_fdp' => $total_fdp_display,
                'total_fdp_condition_value' => $total_fdp_condition_value,
                'last_dep_time' => $last_dep_time_display,
                'last_arrival_time' => $last_arrival_time_display,
                'next_day_take_off' => $next_day_take_off_display,
            ];

            $response = response()->json([
                "STATUS" => "200",
                "STATUS_MESSAGE" => "Success",
                "data" => $output
            ]);
        } else {
            $output = [];
            $response = response()->json([
                "STATUS" => "404",
                "STATUS_MESSAGE" => "Not Found",
                "data" => $output
            ]);
        }



        return $response;
    }

    /**
     * @api {POST} /api/fdtl/fdtl_store_fifth_landing/{id}  Fifth Landing
     * @apiName Fifth Landing
     * @apiGroup fdtl API's
     *   
     * @apiParam {String} aircraft_callsign Aircraft Callsign
     * @apiParam {String} departure_aerodrome Departure Aerodrome
     * @apiParam {String} destination_aerodrome Destination Aerodrome
     * @apiParam {String} date_of_flight Date Of Flight
     * @apiParam {String} departure_time Departure Time
     * @apiParam {String} total_flying_time Total Flying Time
     *   
     * @apiSuccess {String} STATUS_MESSAGE  Success .
     * @apiSuccess {String} STATUS  200 .
     * 
     * * @apiSuccessExample Success-Response:
     *      
      {
      "STATUS": "200",
      "STATUS_MESSAGE": "Success",
      "data": {
      "reporting_time": "0515 GMT (1045 IST)",
      "chocks_off": "0555 GMT (1125 IST)",
      "chocks_on": "1005 GMT (1535 IST)",
      "duty_end_time": "1020 GMT (1550 IST)",
      "flight_time": "04 Hours 10 Minutes ",
      "flight_duty_period": "05 Hours 05 Minutes ",
      "split_duty": "NOT APPLICABLE",
      "split_duty_condition_value": "0",
      "total_FT": "04 Hours 10 Minutes ",
      "total_FT_condition_value": "0",
      "total_fdp": "05 Hours 05 Minutes ",
      "total_fdp_condition_value": "0",
      "last_dep_time": "21:05 (WITHOUT SPLIT DUTY)",
      "last_arrival_time": "22:45 (WITHOUT SPLIT DUTY)",
      "next_day_take_off": "00:50 GMT (0620 IST)"
      }
      }

     * @apiErrorExample Error-Response:
     *     
     *     {
      "STATUS" => "404",
     *       "STATUS_MESSAGE": "Not Found"
     *     }
     *    
     */
    public function fdtl_store_fifth_landing(Request $request, $id) {
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome5 = $request->departure_aerodrome;
        $destination_aerodrome5 = $request->destination_aerodrome;
        $date_of_flight5 = $request->date_of_flight;
        $departure_time5 = $request->departure_time;
        $total_flying_time5 = $request->total_flying_time;
        $current_landing = '5';

        $data = [
            'id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'departure_aerodrome5' => $departure_aerodrome5,
            'destination_aerodrome5' => $destination_aerodrome5,
            'date_of_flight5' => $date_of_flight5,
            'departure_time5' => $departure_time5,
            'total_flying_time5' => $total_flying_time5,
        ];

        $results = FifthLandingAPI::insert_data($data);

        $dep_time_total_time = ($results) ? $results['dep_time_total_time5'] : "";
        $reporting_time_display = ($results) ? $results['reporting_time5'] : "";
        $chocks_off_display = ($results) ? $results['chocks_off5'] : "";
        $chocks_on_display = ($results) ? $results['chocks_on5'] : "";
        $duty_end_time_display = ($results) ? $results['duty_end_time5'] : "";
        $flight_time_display = ($results) ? $results['flight_time5'] : "";
        $flight_duty_period_display = ($results) ? $results['flight_duty_period5'] : "";
        $split_duty_display = ($results) ? $results['split_duty5'] : "";
        $split_duty_condition_value = ($results) ? $results['split_duty5_condition_value'] : "";
        $total_FT_display = ($results) ? $results['total_FT5'] : "";
        $total_FT_condition_value = ($results) ? $results['total_FT_condition_value'] : "";
        $total_fdp_display = ($results) ? $results['total_fdp5'] : "";
        $total_fdp_condition_value = ($results) ? $results['total_fdp_condition_value'] : "";
        $last_dep_time_display = ($results) ? $results['last_dep_time5'] : "";
        $last_arrival_time_display = ($results) ? $results['last_arrival_time5'] : "";
        $next_day_take_off_display = ($results) ? $results['next_day_take_off5'] : "";

        $reporting_time5_value = ($results) ? $results['reporting_time5_value'] : "";
        $flight_time5_value = ($results) ? $results['flight_time5_value'] : "";
        $chocks_off5_value = ($results) ? $results['chocks_off5_value'] : "";
        $chocks_on5_value = ($results) ? $results['chocks_on5_value'] : "";
        $duty_end_time5_value = ($results) ? $results['duty_end_time5_value'] : "";
        $flight_duty_period5_value = ($results) ? $results['flight_duty_period5_value'] : "";
        $split_duty5_value = ($results) ? $results['split_duty5_value'] : "";
        $total_FT5_value = ($results) ? $results['total_FT5_value'] : "";
        $total_fdp5_value = ($results) ? $results['total_fdp5_value'] : "";
        $last_dep_time5_value = ($results) ? $results['last_dep_time5_value'] : "";
        $last_arrival_time5_value = ($results) ? $results['last_arrival_time5_value'] : "";
        $next_day_take_off5_value = ($results) ? $results['next_day_take_off5_value'] : "";


        $data_array = [
            'id' => '',
            'user_id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight' => $date_of_flight5,
            'departure_aerodrome' => $departure_aerodrome5,
            'destination_aerodrome' => $destination_aerodrome5,
            'departure_time' => $departure_time5,
            'total_flying_time' => $total_flying_time5,
            'dep_time_total_time' => $dep_time_total_time,
            'reporting_time' => $reporting_time5_value,
            'flight_time' => $flight_time5_value,
            'chocks_off' => $chocks_off5_value,
            'chocks_on' => $chocks_on5_value,
            'duty_end_time' => $duty_end_time5_value,
            'flight_duty_period' => $flight_duty_period5_value,
            'split_duty' => $split_duty5_value,
            'is_split_duty' => $split_duty_condition_value,
            'total_ft' => $total_FT5_value,
            'is_total_ft' => $total_FT_condition_value,
            'total_flight_duty_period' => $total_fdp5_value,
            'is_total_fdp' => $total_fdp_condition_value,
            'today_next_plan_last_dep_time' => $last_dep_time5_value,
            'today_last_duty_end_time' => $last_arrival_time5_value,
            'next_day_earliest_dep_time' => $next_day_take_off5_value,
        ];

        $fdtl_api_details = FdtlAPIModel::create($data_array);
        $reporting_time = ($fdtl_api_details) ? $fdtl_api_details->reporting_time : '';
        $chocks_off = ($fdtl_api_details) ? $fdtl_api_details->chocks_off : "";
        $chocks_on = ($fdtl_api_details) ? $fdtl_api_details->chocks_on : "";
        $duty_end_time = ($fdtl_api_details) ? $fdtl_api_details->duty_end_time : "";
        $flight_time = ($fdtl_api_details) ? $fdtl_api_details->flight_time : "";
        $flight_duty_period = ($fdtl_api_details) ? $fdtl_api_details->flight_duty_period : "";
        $split_duty = ($fdtl_api_details) ? $fdtl_api_details->split_duty : "";
        $total_FT = ($fdtl_api_details) ? $fdtl_api_details->total_FT : "";
        $total_fdp = ($fdtl_api_details) ? $fdtl_api_details->total_flight_duty_period : "";
        $last_dep_time = ($fdtl_api_details) ? $fdtl_api_details->today_next_plan_last_dep_time : "";
        $last_arrival_time = ($fdtl_api_details) ? $fdtl_api_details->today_last_duty_end_time : "";
        $next_day_take_off = ($fdtl_api_details) ? $fdtl_api_details->next_day_earliest_dep_time : "";

        if ($fdtl_api_details) {
            $output = [
                'reporting_time' => $reporting_time_display,
                'chocks_off' => $chocks_off_display,
                'chocks_on' => $chocks_on_display,
                'duty_end_time' => $duty_end_time_display,
                'flight_time' => $flight_time_display,
                'flight_duty_period' => $flight_duty_period_display,
                'split_duty' => $split_duty_display,
                'split_duty_condition_value' => $split_duty_condition_value,
                'total_FT' => $total_FT_display,
                'total_FT_condition_value' => $total_FT_condition_value,
                'total_fdp' => $total_fdp_display,
                'total_fdp_condition_value' => $total_fdp_condition_value,
                'last_dep_time' => $last_dep_time_display,
                'last_arrival_time' => $last_arrival_time_display,
                'next_day_take_off' => $next_day_take_off_display,
            ];
            $response = response()->json([
                "STATUS" => "200",
                "STATUS_MESSAGE" => "Success",
                "data" => $output
            ]);
        } else {
            $output = [];
            $response = response()->json([
                "STATUS" => "404",
                "STATUS_MESSAGE" => "Not Found",
                "data" => $output
            ]);
        }



        return $response;
    }

    /**
     * @api {POST} /api/fdtl/fdtl_store_sixth_landing/{id}  Sixth Landing
     * @apiName Sixth Landing
     * @apiGroup fdtl API's
     * 
     * @apiParam {String} aircraft_callsign Aircraft Callsign
     * @apiParam {String} departure_aerodrome Departure Aerodrome
     * @apiParam {String} destination_aerodrome Destination Aerodrome
     * @apiParam {String} date_of_flight Date Of Flight
     * @apiParam {String} departure_time Departure Time
     * @apiParam {String} total_flying_time Total Flying Time
     *     
     * @apiSuccess {String} STATUS_MESSAGE  Success .
     * @apiSuccess {String} STATUS  200 .
     * 
     * * @apiSuccessExample Success-Response:
     *      
      {
      "STATUS": "200",
      "STATUS_MESSAGE": "Success",
      "data": {
      "reporting_time": "0515 GMT (1045 IST)",
      "chocks_off": "0555 GMT (1125 IST)",
      "chocks_on": "1005 GMT (1535 IST)",
      "duty_end_time": "1020 GMT (1550 IST)",
      "flight_time": "04 Hours 10 Minutes ",
      "flight_duty_period": "05 Hours 05 Minutes ",
      "split_duty": "NOT APPLICABLE",
      "split_duty_condition_value": "0",
      "total_FT": "04 Hours 10 Minutes ",
      "total_FT_condition_value": "0",
      "total_fdp": "05 Hours 05 Minutes ",
      "total_fdp_condition_value": "0",
      "last_dep_time": "21:05 (WITHOUT SPLIT DUTY)",
      "last_arrival_time": "22:45 (WITHOUT SPLIT DUTY)",
      "next_day_take_off": "00:50 GMT (0620 IST)"
      }
      }

     * @apiErrorExample Error-Response:
     *     
     *     {
      "STATUS" => "404",
     *       "STATUS_MESSAGE": "Not Found"
     *     }
     *    
     */
    public function fdtl_store_sixth_landing(Request $request, $id) {
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome6 = $request->departure_aerodrome;
        $destination_aerodrome6 = $request->destination_aerodrome;
        $date_of_flight6 = $request->date_of_flight;
        $departure_time6 = $request->departure_time;
        $total_flying_time6 = $request->total_flying_time;
        $current_landing = '6';

        $data = [
            'id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'departure_aerodrome6' => $departure_aerodrome6,
            'destination_aerodrome6' => $destination_aerodrome6,
            'date_of_flight6' => $date_of_flight6,
            'departure_time6' => $departure_time6,
            'total_flying_time6' => $total_flying_time6,
        ];

        $results = SixthLandingAPI::insert_data($data);

        $dep_time_total_time = ($results) ? $results['dep_time_total_time6'] : "";
        $reporting_time_display = ($results) ? $results['reporting_time6'] : "";
        $chocks_off_display = ($results) ? $results['chocks_off6'] : "";
        $chocks_on_display = ($results) ? $results['chocks_on6'] : "";
        $duty_end_time_display = ($results) ? $results['duty_end_time6'] : "";
        $flight_time_display = ($results) ? $results['flight_time6'] : "";
        $flight_duty_period_display = ($results) ? $results['flight_duty_period6'] : "";
        $split_duty_display = ($results) ? $results['split_duty6'] : "";
        $split_duty_condition_value = ($results) ? $results['split_duty6_condition_value'] : "";
        $total_FT_display = ($results) ? $results['total_FT6'] : "";
        $total_FT_condition_value = ($results) ? $results['total_FT_condition_value'] : "";
        $total_fdp_display = ($results) ? $results['total_fdp6'] : "";
        $total_fdp_condition_value = ($results) ? $results['total_fdp_condition_value'] : "";
        $last_dep_time_display = ($results) ? $results['last_dep_time6'] : "";
        $last_arrival_time_display = ($results) ? $results['last_arrival_time6'] : "";
        $next_day_take_off_display = ($results) ? $results['next_day_take_off6'] : "";

        $reporting_time6_value = ($results) ? $results['reporting_time6_value'] : "";
        $flight_time6_value = ($results) ? $results['flight_time6_value'] : "";
        $chocks_off6_value = ($results) ? $results['chocks_off6_value'] : "";
        $chocks_on6_value = ($results) ? $results['chocks_on6_value'] : "";
        $duty_end_time6_value = ($results) ? $results['duty_end_time6_value'] : "";
        $flight_duty_period6_value = ($results) ? $results['flight_duty_period6_value'] : "";
        $split_duty6_value = ($results) ? $results['split_duty6_value'] : "";
        $total_FT6_value = ($results) ? $results['total_FT6_value'] : "";
        $total_fdp6_value = ($results) ? $results['total_fdp6_value'] : "";
        $last_dep_time6_value = ($results) ? $results['last_dep_time6_value'] : "";
        $last_arrival_time6_value = ($results) ? $results['last_arrival_time6_value'] : "";
        $next_day_take_off6_value = ($results) ? $results['next_day_take_off6_value'] : "";


        $data_array = [
            'id' => '',
            'user_id' => $id,
            'current_landing' => $current_landing,
            'aircraft_callsign' => $aircraft_callsign,
            'date_of_flight' => $date_of_flight6,
            'departure_aerodrome' => $departure_aerodrome6,
            'destination_aerodrome' => $destination_aerodrome6,
            'departure_time' => $departure_time6,
            'total_flying_time' => $total_flying_time6,
            'dep_time_total_time' => $dep_time_total_time,
            'reporting_time' => $reporting_time6_value,
            'flight_time' => $flight_time6_value,
            'chocks_off' => $chocks_off6_value,
            'chocks_on' => $chocks_on6_value,
            'duty_end_time' => $duty_end_time6_value,
            'flight_duty_period' => $flight_duty_period6_value,
            'split_duty' => $split_duty6_value,
            'is_split_duty' => $split_duty_condition_value,
            'total_ft' => $total_FT6_value,
            'is_total_ft' => $total_FT_condition_value,
            'total_flight_duty_period' => $total_fdp6_value,
            'is_total_fdp' => $total_fdp_condition_value,
            'today_next_plan_last_dep_time' => $last_dep_time6_value,
            'today_last_duty_end_time' => $last_arrival_time6_value,
            'next_day_earliest_dep_time' => $next_day_take_off6_value,
        ];

        $fdtl_api_details = FdtlAPIModel::create($data_array);
        $reporting_time = ($fdtl_api_details) ? $fdtl_api_details->reporting_time : '';
        $chocks_off = ($fdtl_api_details) ? $fdtl_api_details->chocks_off : "";
        $chocks_on = ($fdtl_api_details) ? $fdtl_api_details->chocks_on : "";
        $duty_end_time = ($fdtl_api_details) ? $fdtl_api_details->duty_end_time : "";
        $flight_time = ($fdtl_api_details) ? $fdtl_api_details->flight_time : "";
        $flight_duty_period = ($fdtl_api_details) ? $fdtl_api_details->flight_duty_period : "";
        $split_duty = ($fdtl_api_details) ? $fdtl_api_details->split_duty : "";
        $total_FT = ($fdtl_api_details) ? $fdtl_api_details->total_FT : "";
        $total_fdp = ($fdtl_api_details) ? $fdtl_api_details->total_flight_duty_period : "";
        $last_dep_time = ($fdtl_api_details) ? $fdtl_api_details->today_next_plan_last_dep_time : "";
        $last_arrival_time = ($fdtl_api_details) ? $fdtl_api_details->today_last_duty_end_time : "";
        $next_day_take_off = ($fdtl_api_details) ? $fdtl_api_details->next_day_earliest_dep_time : "";

        if ($fdtl_api_details) {
            $output = [
                'reporting_time' => $reporting_time_display,
                'chocks_off' => $chocks_off_display,
                'chocks_on' => $chocks_on_display,
                'duty_end_time' => $duty_end_time_display,
                'flight_time' => $flight_time_display,
                'flight_duty_period' => $flight_duty_period_display,
                'split_duty' => $split_duty_display,
                'split_duty_condition_value' => $split_duty_condition_value,
                'total_FT' => $total_FT_display,
                'total_FT_condition_value' => $total_FT_condition_value,
                'total_fdp' => $total_fdp_display,
                'total_fdp_condition_value' => $total_fdp_condition_value,
                'last_dep_time' => $last_dep_time_display,
                'last_arrival_time' => $last_arrival_time_display,
                'next_day_take_off' => $next_day_take_off_display,
            ];

            $response = response()->json([
                "STATUS" => "200",
                "STATUS_MESSAGE" => "Success",
                "data" => $output
            ]);
        } else {
            $output = [];

            $response = response()->json([
                "STATUS" => "404",
                "STATUS_MESSAGE" => "Not Found",
                "data" => $output
            ]);
        }



        return $response;
    }

}
