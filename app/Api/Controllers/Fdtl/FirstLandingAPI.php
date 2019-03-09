<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Api\Controllers\Fdtl;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\FDTLStaticTimeModel;
use App\models\TotalFTModel;
use App\models\TotalFDPModel;
use App\models\FirstLandingModel;

class FirstLandingAPI {

    public static function insert_data($data) {
        $id = $data['id'];
        $current_landing = $data['current_landing'];
        $aircraft_callsign = $data['aircraft_callsign'];
        $date_of_flight1 = $data['date_of_flight1'];
//        $departure_time_hours1 = $data['dep_time_hours1'];
//        $departure_time_minutes1 = $data['dep_time_minutes1'];
//        $total_flying_hours1 = $data['total_flying_hours1'];
//        $total_flying_minutes1 = $data['total_flying_minutes1'];


        $entered_departure_time = $data['departure_time1'];
        $combined_total_time = $data['total_flying_time1'];

        //$entered_departure_time = $departure_time_hours1 . '' . $departure_time_minutes1;
        $departure_time_date_format = strtotime($entered_departure_time);
        // $combined_total_time = $total_flying_hours1 . '' . $total_flying_minutes1;
        $total_flying_time = strtotime($combined_total_time);

        $fdtl_static_row = FDTLStaticTimeModel::get_single_row();
        $reporting_static_time = ($fdtl_static_row) ? $fdtl_static_row->reporting_time : "";
        $flight_static_time = ($fdtl_static_row) ? $fdtl_static_row->flight_time : "";
        $chocks_off_static_time = ($fdtl_static_row) ? $fdtl_static_row->chocks_off : "";
        $chocks_on_static_time = ($fdtl_static_row) ? $fdtl_static_row->chocks_on : "";
        $duty_end_static_time = ($fdtl_static_row) ? $fdtl_static_row->duty_end_time : "";

        $reporting_time = date('Hi', strtotime($reporting_static_time, strtotime($entered_departure_time)));
        $flight_time = date('Hi', strtotime($flight_static_time, $total_flying_time));
        $chocks_off = date('Hi', strtotime($chocks_off_static_time, $departure_time_date_format));


        //Add Dep Time and Total Flying Time
        $secs = strtotime($combined_total_time) - strtotime("0000");
        $dep_time_total_time = date('Hi', strtotime($entered_departure_time) + $secs);


        $chocks_on = date('Hi', strtotime($chocks_on_static_time, strtotime($dep_time_total_time)));

        $duty_end_time = date('Hi', strtotime($duty_end_static_time, strtotime($chocks_on)));

        //Subtract $duty_end_time - $reporting_time
        $secs1 = strtotime($reporting_time) - strtotime("0000");
        $flight_duty_time = date('Hi', strtotime($duty_end_time) - $secs1);

        //IST times
        $reporting_time_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($reporting_time))) . " IST)";
        $chocks_off_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($chocks_off))) . " IST)";
        $chocks_on_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($chocks_on))) . " IST)";
        $duty_end_time_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($duty_end_time))) . " IST)";

        //Display Hours and Minutes
        $flight_time_only_hours = substr($flight_time, 0, 2);
        $flight_time_hours_format = ($flight_time_only_hours <= "01") ? " Hour " : " Hours ";
        $flight_time_only_Minutes = substr($flight_time, 2, 2);
        $flight_time_minutes_format = ($flight_time_only_Minutes <= "01") ? " Minute " : " Minutes ";

        $flight_duty_time_only_hours = substr($flight_duty_time, 0, 2);
        $flight_duty_time_hours_format = ($flight_duty_time_only_hours <= "01") ? " Hour " : " Hours ";
        $flight_duty_time_only_Minutes = substr($flight_duty_time, 2, 2);
        $flight_duty_time_minutes_format = ($flight_duty_time_only_Minutes <= "01") ? " Minute " : " Minutes ";

        $split_duty_value = "NOT APPLICABLE";
        $split_duty1_condition_value = '0';
        $total_ft = $flight_time;
        $total_fdp = $flight_duty_time;

        $total_ft_model = TotalFTModel::getAll($current_landing);
        $day = ($total_ft_model) ? $total_ft_model->day : "";
        $night = ($total_ft_model) ? $total_ft_model->night : "";

        if ($total_ft > $day) {
            $total_FT_condition_value = '1';
            $total_FT_display_format = $flight_time_only_hours . '' . $flight_time_hours_format . '' . $flight_time_only_Minutes
                    . '' . $flight_time_minutes_format;
        } else {
            $total_FT_condition_value = '0';
            $total_FT_display_format = $flight_time_only_hours . '' . $flight_time_hours_format . '' . $flight_time_only_Minutes
                    . '' . $flight_time_minutes_format;
        }

        $total_fdp_model = TotalFDPModel::get_max_fdp_for_first_landing($current_landing);
        $fdp = ($total_fdp_model) ? $total_fdp_model->fdp : "";

        if ($total_fdp <= $fdp) {
            $total_fdp_condition_value = '0';
            $total_fdp_display_format = $flight_duty_time_only_hours . '' . $flight_duty_time_hours_format
                    . '' . $flight_duty_time_only_Minutes . '' . $flight_duty_time_minutes_format;
        } else {
            $total_fdp_condition_value = '1';
            $total_fdp_display_format = $flight_duty_time_only_hours . '' . $flight_duty_time_hours_format
                    . '' . $flight_duty_time_only_Minutes . '' . $flight_duty_time_minutes_format;
        }

        //echo $total_fdp;exit;

        $first_landing = FirstLandingModel::getAll();
        $ten_hours = ($first_landing) ? $first_landing->ten_hours : "";
        $fourty_five_min = ($first_landing) ? $first_landing->fourty_five_min : "";
        $twelve_thirty = ($first_landing) ? $first_landing->twelve_thirty : "";
        $five_hours = ($first_landing) ? $first_landing->five_hours : "";
        $twelve_hours = ($first_landing) ? $first_landing->twelve_hours : "";
        $one_hour_thirty_min = ($first_landing) ? $first_landing->one_hour_thirty_min : "";
        $fourteen_thirty = ($first_landing) ? $first_landing->fourteen_thirty : "";
        $two_thirty = ($first_landing) ? $first_landing->two_thirty : "";

        //last dep time
        $ten_hours = strtotime($ten_hours) - strtotime("0000");
        $fourty_five_min = strtotime($fourty_five_min) - strtotime("0000");
        $last_dep_time = date('H:i', strtotime($duty_end_time) + $ten_hours + $fourty_five_min);
        $last_dep_time_value = date('Hi', strtotime($duty_end_time) + $ten_hours + $fourty_five_min);
        $last_dep_time_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($last_dep_time))) . " IST)";

        //last arr time
        $twelve_thirty = strtotime($twelve_thirty) - strtotime("0000");
        $five_hours = strtotime($five_hours) - strtotime("0000");
        $last_arrival_time = date('H:i', strtotime($reporting_time) + $five_hours + $twelve_thirty);
        $last_arrival_time_value = date('Hi', strtotime($reporting_time) + $five_hours + $twelve_thirty);
        $last_arrival_time_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($last_arrival_time))) . " IST)";



        //NEW SCHEDULE EARLIEST DEP TIME
        $twelve_hours = strtotime($twelve_hours) - strtotime("0000");
        $one_hour_thirty_min = strtotime($one_hour_thirty_min) - strtotime("0000");
        $next_day_take_off = date('Hi', strtotime($duty_end_time) + $one_hour_thirty_min + $twelve_hours);
        $next_day_take_off_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($next_day_take_off))) . " IST)";

        //Next Day Earliest Dep Time

        if ($total_fdp < $twelve_hours) {
            $fourteen_thirty = strtotime($fourteen_thirty) - strtotime("0000");
            $next_day_earliest_dep_time = date('H:i', strtotime($duty_end_time) + $fourteen_thirty);
            $next_day_earliest_dep_time_value = date('Hi', strtotime($duty_end_time) + $fourteen_thirty);
            $next_day_earliest_dep_time_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($next_day_earliest_dep_time))) . " IST)";
        } else {
            $two_thirty = strtotime($two_thirty) - strtotime("0000");
            $total_fdp = strtotime($total_fdp) - strtotime("0000");
            $next_day_earliest_dep_time = date('H:i', strtotime($duty_end_time) + $two_thirty + $total_fdp);
            $next_day_earliest_dep_time_value = date('Hi', strtotime($duty_end_time) + $two_thirty + $total_fdp);
            $next_day_earliest_dep_time_ist = "(" . date('Hi', strtotime('+5 hour +30 minutes', strtotime($next_day_earliest_dep_time))) . " IST)";
        }


        $result = [
            "dep_time_total_time" => $dep_time_total_time,
            "reporting_time1" => $reporting_time . " GMT " . $reporting_time_ist,
            "chocks_off1" => $chocks_off . " GMT " . $chocks_off_ist,
            "chocks_on1" => $chocks_on . " GMT " . $chocks_on_ist,
            "duty_end_time1" => $duty_end_time . " GMT " . $duty_end_time_ist,
            "flight_time1" => $flight_time_only_hours . '' . $flight_time_hours_format . '' . $flight_time_only_Minutes
            . '' . $flight_time_minutes_format,
            "flight_duty_period1" => $flight_duty_time_only_hours . "" . $flight_duty_time_hours_format
            . "" . $flight_duty_time_only_Minutes . "" . $flight_duty_time_minutes_format,
            "split_duty1" => $split_duty_value,
            'split_duty1_condition_value' => $split_duty1_condition_value,
            "total_FT1" => $total_FT_display_format,
            'total_FT_condition_value' => $total_FT_condition_value,
            "total_fdp1" => $total_fdp_display_format,
            'total_fdp_condition_value' => $total_fdp_condition_value,
            "last_dep_time1" => $last_dep_time . " (WITHOUT SPLIT DUTY)",
            "last_arrival_time1" => $last_arrival_time . " (WITHOUT SPLIT DUTY)",
            "next_day_take_off1" => $next_day_earliest_dep_time . " GMT " . $next_day_earliest_dep_time_ist,
            
            
           
            
            'reporting_time1_value' => $reporting_time,
            'flight_time1_value' => $flight_time,
            'chocks_off1_value' => $chocks_off,
            'chocks_on1_value' => $chocks_on,
            'duty_end_time1_value' => $duty_end_time,
            'flight_duty_period1_value' => $total_fdp,
            'split_duty1_value' => $split_duty_value,
            'total_FT1_value' => $total_ft,
            'total_fdp1_value' => $total_fdp,
            'last_dep_time1_value' => $last_dep_time_value,
            'last_arrival_time1_value' => $last_arrival_time_value,
            'next_day_take_off1_value' => $next_day_earliest_dep_time_value,
        ];

        return $result;
    }

}
