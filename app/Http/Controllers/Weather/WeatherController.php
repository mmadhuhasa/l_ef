<?php

namespace App\Http\Controllers\weather;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\weather\Weather;
use Session;
use DB;

class WeatherController extends Controller {

    public function divideClouds($explode_clouds) {
        foreach ($explode_clouds as $clouds) {
            $data['cloud_sky'] = substr($clouds, 0, 3);
            if (strlen(substr($clouds, 3, 3)) > 1) {
                $data['cloud_height'] = (int) ltrim(substr($clouds, 3, 3), '0') * 100;
            } else {
                $data['cloud_height'] = NULL;
            }
            if (strlen(substr($clouds, 6)) > 1) {
                $data['cloud_type'] = substr($clouds, 6);
            } else {
                $data['cloud_type'] = NULL;
            }
            $d[] = array($data['cloud_sky'], $data['cloud_height'], $data['cloud_type']);
        }
        return $d;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->path();
        if (isset($request->ap_code)) {
            $ap_code = $request->ap_code;
            $weathers = Weather::orderBy('created_at', 'desc')->where('airport_code', $ap_code)->get();
        } else {
            $weathers = Weather::orderBy('created_at', 'desc')->get();
        }
        $get_taf = \App\models\weather\LongTaf::all();
        $get_taf = $get_taf->unique('airport_code');
        

        $weathers = $weathers->unique('airport_code');

        foreach ($weathers as $weather) {
            $airport_taf = $get_taf->where('airport_code', $weather->airport_code)->first();
            if(isset($airport_taf->raw_taf)) {
                $weather->raw_taf = $airport_taf->raw_taf;
            }
            else {
                $weather->raw_taf = NULL;
            }
       
            $wx_gmt_hours = substr(trim($weather->wx_time_gmt), 0, 2);
            $wx_gmt_minutes = substr(trim($weather->wx_time_gmt), 2, 2);
            $formatted_date = date_create($weather->wx_date);

            $wx_combined_date = $weather->wx_date . ' ' . $wx_gmt_hours . ':' . $wx_gmt_minutes . ':' . '00';

            $formatted_date_time = date_create($wx_combined_date);
            $current_date = date_create(date('Y-m-d H:i:s'));

            date_add($formatted_date_time, date_interval_create_from_date_string("330 minutes"));
            $weather->wx_time_ist = date_format($formatted_date_time, 'H:i');
            date_add($current_date, date_interval_create_from_date_string("330 minutes"));

//            dd($current_date);
//            dd(date_diff($current_date, $formatted_date_time));
            if (((date_diff($current_date, $formatted_date_time)->h) > 1 && (date_diff($current_date, $formatted_date_time)->i) > 0 && (date_diff($current_date, $formatted_date_time)->s) > 0) || ((date_diff($current_date, $formatted_date_time)->days) === '0')) {
                $weather->less_than_twohours = NULL;
            } else {
                $weather->less_than_twohours = true;
            }
            if ((date_diff($current_date, $formatted_date_time)->days) > 0) {
                $weather->previous_date = date_format($formatted_date_time, "d-M-Y");
            } else {
                $weather->previous_date = NULL;
            }
            $weather->formatted_date = date_format($formatted_date, "d-M-Y");
            if (isset($weather->var_wind_direction)) {
                $weather->var_wind1 = ltrim(explode("V", $weather->var_wind_direction)[0], '0');
                $weather->var_wind2 = ltrim(explode("V", $weather->var_wind_direction)[1], '0');
            }
            if (isset($weather->runway_visibility1)) {
                $weather->runway_no1 = substr($weather->runway_visibility1, 1, 2);
                $weather->rv1 = substr($weather->runway_visibility1, 5, 4);
            }
            if (isset($weather->runway_visibility2)) {
                $weather->runway_no2 = substr($weather->runway_visibility2, 1, 2);
                $weather->rv2 = substr($weather->runway_visibility2, 5, 4);
            }
            if (isset($weather->wx)) {
                if (substr($weather->wx, 0, 1) == '-' || substr($weather->wx, 0, 1) == '+') {
                    $weather->wx_intensity = substr($weather->wx, 0, 1);
                    $weather->wx_main = substr($weather->wx, 1);
                } else {
                    $weather->wx_intensity = NULL;
                    $weather->wx_main = $weather->wx;
                }
            } else {
                $weather->wx_intensity = NULL;
                $weather->wx_main = NULL;
            }

            if (isset($weather->temperature)) {
                if (strpos($weather->temperature, 'M') !== false) {
                    $weather->temp_minus = '-';
                    $weather->temperature = substr($weather->temperature, 1);
                } else {
                    $weather->temp_minus = NULL;
                    $weather->temperature = $weather->temperature;
                }
            }
            if (isset($weather->dew_point)) {
                if (strpos($weather->dew_point, 'M') !== false) {
                    $weather->dew_minus = '-';
                    $weather->dew_point = substr($weather->dew_point, 1);
                } else {
                    $weather->dew_minus = NULL;
                    $weather->dew_point = $weather->dew_point;
                }
            }
            if (isset($weather->trend_wx)) {
                if (substr($weather->trend_wx, 0, 1) == '-' || substr($weather->trend_wx, 0, 1) == '+') {
                    $weather->trend_wx_intensity = substr($weather->trend_wx, 0, 1);
                    $weather->trend_wx = substr($weather->trend_wx, 1);
                } else {
                    $weather->trend_wx_intensity = NULL;
                    $weather->trend_wx = $weather->trend_wx;
                }
            } else {
                $weather->trend_wx_intensity = NULL;
                $weather->trend_wx = NULL;
            }
            if (isset($weather->clouds)) {
                $explode_clouds = explode(" ", $weather->clouds);
                $weather->clouds_data = $this->divideClouds($explode_clouds);
            }
        }
        if ($request->path() == 'weather') {
            return view('weather.weather_v.index', ["data" => $weathers, 'data_taf' => $get_taf]);
        } else {
            return view('weather.weather_v.indexnew', ["data" => $weathers, 'data_taf' => $get_taf]);
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

    public function upload() {
        return view('weather.weather_v.weather_upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //dd($request->wx);
//            $get_content = file_get_contents("http://121.241.116.157/Palam1.php");
//        $remove_tags = strip_tags($get_content);
        $error = false;
        $remove_tags = strip_tags($request->wx);

        if (strpos($remove_tags, 'METARS') !== false) {
            $split_metars = explode("METARS", $remove_tags);
            $split_equalto = explode("=", $split_metars[1]);
            array_pop($split_equalto);
        } else if (strpos($remove_tags, 'METAR') !== false) {
            if (substr_count($remove_tags, 'METAR') > 1) {
                $replace_metar = str_replace('METAR', '', $remove_tags);
                $replace_slash_n = trim(preg_replace('/\s\s+/', ' ', $replace_metar)); //Multiple spaces and newlines are replaced with a single space
                $split_equalto = explode("=", $replace_slash_n);
                array_pop($split_equalto);
            } else {
                $split_metars = explode("METAR", $remove_tags);
                $split_equalto = explode("=", $split_metars[1]);
                array_pop($split_equalto);
            }
        } else {
            $split_equalto = explode('=', $remove_tags);
            array_pop($split_equalto);
        }
        $weathers = array();
        foreach ($split_equalto as $split_first) {

            if ((strpos($split_first, 'VA') !== false)) {
                $indian_airports[] = substr($split_first, strpos($split_first, 'VA'));
            } else if ((strpos($split_first, 'VE') !== false)) {
                $indian_airports[] = substr($split_first, strpos($split_first, 'VE'));
            } else if ((strpos($split_first, 'VI') !== false)) {
                $indian_airports[] = substr($split_first, strpos($split_first, 'VI'));
            } else if ((strpos($split_first, 'VO') !== false)) {
                $indian_airports[] = substr($split_first, strpos($split_first, 'VO'));
            }
        }

        $indian_airports_filtered = array();
        foreach ($indian_airports as $key) { // Removing Airports with NIL
            $key = trim(preg_replace('/\s+/', ' ', $key)); //Remove unwanted spaces between words
            $split_key_spaces[] = explode(' ', $key);
        }
        foreach ($split_key_spaces as $key => $split_key_spaces_val) {
            if (in_array('NIL', $split_key_spaces_val)) {
                unset($split_key_spaces[$key]);
            }
            if (sizeof($split_key_spaces_val) > 0) {
                foreach ($split_key_spaces_val as $split_key_spaces_checklength) {
                    if (strlen($split_key_spaces_checklength) > 12) {
                        unset($split_key_spaces[$key]);
                        break;
                    }
                }
            }
        }
        if (sizeof($split_key_spaces) > 0) {
            foreach ($split_key_spaces as $key => $implode_key) {
                $indian_airports1[] = implode(" ", $implode_key);
            }

            foreach ($indian_airports1 as $replace_km) {
                if (strpos($replace_km, 'KM') !== false) {
                    $replace_km = str_replace('KM', '000', $replace_km);
                }
                array_push($indian_airports_filtered, $replace_km);
            }

            foreach ($indian_airports_filtered as $key) {
                if (strpos(substr($key, 0, 30), 'KT') === false) {
                    continue;
                }
                if ((strpos(substr($key, 0, 15), 'Z') !== false)) {
                    $split_data = array();
                    $split_data['raw_data'] = trim($key);
                    $current_date = getdate();
                    $current_year = $current_date['year'];
                    $current_month = sprintf('%02d', $current_date['mon']);
                    $split_data['airport_code'] = substr($key, 0, 4);
                    $split_data['wx_date'] = $current_year . '-' . $current_month . '-' . substr($key, 5, 2);
                    $split_data['wx_time_gmt'] = substr($key, 7, 4);

                    /* Start of Wind */
                    $split_wind = substr($key, 13, 20);
                    if ((strpos($split_wind, 'KT')) !== false) {
                        $split_wind_kt = explode('KT', $split_wind);
                        $split_wind_kt_first = trim($split_wind_kt[0]);
                        $split_wind_kt_second = trim($split_wind_kt[1]);
                        $split_wind_check_v = strtok($split_wind_kt_second, " "); //To get Variable Wind

                        if (strlen($split_wind_kt_first) < 7) {
                            $split_data['wind_direction'] = substr($split_wind_kt_first, 0, 3);
                            $split_data['wind_speed'] = substr($split_wind_kt_first, 3);
                            $split_data['wind_gust'] = NULL;
                        } else {
                            $split_wind_gust = explode('G', $split_wind_kt_first);
                            $split_wind_gust_first = trim($split_wind_gust[0]);
                            if (sizeof($split_wind_gust) > 1) {
                                $split_wind_gust_value = trim($split_wind_gust[1]);
                            } else {
                                continue;
                            }
                            $split_data['wind_direction'] = substr($split_wind_kt_first, 0, 3);
                            $split_data['wind_speed'] = substr($split_wind_gust_first, 3);
                            $split_data['wind_gust'] = trim($split_wind_gust_value);
                        }
                    } else {
                        $split_data['wind_direction'] = NULL;
                        $split_data['wind_speed'] = NULL;
                        $split_data['wind_gust'] = NULL;
                    }

                    if (strpos($split_wind_check_v, 'V') !== false) {
                        if (strpos($split_wind_check_v, 'CAVOK') !== false) {
                            $split_data['var_wind_direction'] = NULL;
                        } else {
                            $split_data['var_wind_direction'] = trim($split_wind_check_v);
                        }
                    } else {
                        $split_data['var_wind_direction'] = NULL;
                    }
                    /* End of Wind */
                    //
                    if (strpos($key, 'CAVOK') !== false) { //If CAVOK is present in data
                        $split_data['visibility'] = 9999;
                        $split_data['runway_visibility1'] = NULL;
                        $split_data['runway_visibility2'] = NULL;
                        $split_data['wx'] = NULL;
                        $split_data['clouds'] = 'SKC';
                        $explode_using_cavok_slash = explode('/', $key);
                        if (sizeof($explode_using_cavok_slash) > 1) {//After CAVOK if nothing is there
                            if (strripos($key, '/') !== false) {
                                $split_data['temperature'] = trim(substr($explode_using_cavok_slash[0], -3));
                                $split_data['dew_point'] = trim(substr($explode_using_cavok_slash[1], 0, 3));
                            } else {
                                $split_data['temperature'] = NULL;
                                $split_data['dew_point'] = NULL;
                            }
                            if (strpos($explode_using_cavok_slash[1], 'Q') !== false) {
                                $split_data['pressure'] = trim(substr($explode_using_cavok_slash[1], strpos($explode_using_cavok_slash[1], 'Q') + 1, 5));
                                $explode_cavok_after_pressure = explode($split_data['pressure'], $explode_using_cavok_slash[1]);
                                $split_data_trend = trim($explode_cavok_after_pressure[1], " ");
                                //Start of Trend

                                if ($split_data_trend == '') {
                                    $split_data['trend_sky'] = NULL;
                                    $split_data['trend_wind_direction'] = NULL;
                                    $split_data['trend_wind_speed'] = NULL;
                                    $split_data['trend_wind_gust'] = NULL;
                                    $split_data['trend_visibility'] = NULL;
                                    $split_data['trend_wx'] = NULL;
                                    $split_data['remarks'] = NULL;
                                    $split_data['caution'] = NULL;
                                } else {
                                    $split_data['trend_sky'] = strtok($split_data_trend, " ");

                                    if (strpos($split_data_trend, 'RMK') !== false) {
                                        $split_rmk = explode('RMK', $split_data_trend);
                                        $split_data_trend = trim($split_rmk[0]);
                                        $split_data['remarks'] = trim($split_rmk[1]);
                                        $split_data['caution'] = NULL;
                                    } else if (strpos($split_data_trend, 'CAUTION') !== false) {
                                        $split_caution = explode('CAUTION', $split_data_trend);
                                        $split_data_trend = trim($split_caution[0]);
                                        $split_data['caution'] = trim($split_caution[1]);
                                        $split_data['remarks'] = NULL;
                                    } else {
                                        $split_data_trend = $split_data_trend;
                                        $split_data['remarks'] = NULL;
                                        $split_data['caution'] = NULL;
                                    }

                                    if (strpos($split_data_trend, 'KT') !== false) {
                                        $split_data_trend_kt = explode(' ', $split_data_trend);

                                        if (sizeof($split_data_trend_kt) > 1) {
                                            if (strpos($split_data_trend_kt[1], 'G') !== false) {
                                                $split_data['trend_wind_direction'] = substr(trim($split_data_trend_kt[1]), 0, 3);
                                                $split_data['trend_wind_speed'] = substr(trim($split_data_trend_kt[1]), 3, 2);
                                                $split_data['trend_wind_gust'] = substr(trim($split_data_trend_kt[1]), -4, 2);
                                            } else {
                                                $split_data['trend_wind_direction'] = substr(trim($split_data_trend_kt[1]), 0, 3);
                                                $split_data['trend_wind_speed'] = substr(trim($split_data_trend_kt[1]), 3, 2);
                                                $split_data['trend_wind_gust'] = NULL;
                                            }

                                            if (sizeof($split_data_trend_kt) > 2) {
                                                if (is_numeric(trim($split_data_trend_kt[2]))) {
                                                    $split_data['trend_visibility'] = trim($split_data_trend_kt[2]);
                                                } else {
                                                    $split_data['trend_visibility'] = NULL;
                                                }
                                            } else {
                                                $split_data['trend_visibility'] = NULL;
                                            }
                                        }
                                    } else {
                                        $split_data['trend_wind_direction'] = NULL;
                                        $split_data['trend_wind_speed'] = NULL;
                                        $split_data['trend_wind_gust'] = NULL;
                                        $split_trend = explode(" ", $split_data_trend);

                                        if (sizeof($split_trend) > 1) {
                                            if (is_numeric($split_trend[1])) {
                                                $split_data['trend_visibility'] = $split_trend[1];
                                            } else {
                                                $split_data['trend_visibility'] = NULL;
                                            }
                                        } else {
                                            $split_data['trend_visibility'] = NULL;
                                        }
                                    }

                                    if ($split_data['trend_visibility'] !== NULL) {
                                        $split_data_trend_wx = explode($split_data['trend_visibility'], $split_data_trend);

                                        if (sizeof($split_data_trend_wx) > 1) {
                                            $split_trend_wx = strtok($split_data_trend_wx[1], " ");
                                            if ((strpos($split_trend_wx, 'SKC') !== false) || (strpos($split_trend_wx, 'FEW') !== false) || (strpos($split_trend_wx, 'SCT') !== false) || (strpos($split_trend_wx, 'BKN') !== false) || (strpos($split_trend_wx, 'OVC') !== false) || (strpos($split_trend_wx, 'NSC') !== false)) {
                                                $split_data['trend_wx'] = NULL;
                                            } else {
                                                $split_data['trend_wx'] = $split_trend_wx;
                                            }
                                        } else {
                                            $split_data['trend_wx'] = NULL;
                                        }
                                    } else {
                                        $split_data_trend_wx = explode(" ", $split_data_trend);
                                        if (sizeof($split_data_trend_wx) > 1) {
                                            if (strpos($split_data_trend_wx[1], 'KT') === false) {
                                                $split_data['trend_wx'] = trim($split_data_trend_wx[1]);
                                            } else {
                                                $split_data['trend_wx'] = NULL;
                                            }
                                        } else {
                                            $split_data['trend_wx'] = NULL;
                                        }
                                    }
                                }

                                //End of Trend
                            } else {
                                $error = true;
                                Session::flash('error', 'Error in pressure for: ' . $split_data['airport_code']);
                                break;
                            }
                        } else {
                            $split_data['temperature'] = NULL;
                            $split_data['dew_point'] = NULL;
                            $split_data['wx'] = NULL;
                            $split_data['pressure'] = NULL;
                            $split_data['trend_sky'] = NULL;
                            $split_data['trend_wind_direction'] = NULL;
                            $split_data['trend_wind_speed'] = NULL;
                            $split_data['trend_wind_gust'] = NULL;
                            $split_data['trend_visibility'] = NULL;
                            $split_data['trend_wx'] = NULL;
                        }
                    } else {//If CAVOK not present in data
                        if (!empty($split_data['var_wind_direction'])) {
                            $split_data_using_wind = explode($split_data['var_wind_direction'], $key);
                        } else {
                            $split_data_using_wind = explode('KT', $key);

                            if (sizeof($split_data_using_wind) > 2) {
                                $split_data_using_wind_first = $split_data_using_wind[0];
                                unset($split_data_using_wind[0]);
                                $split_data_using_wind[1] = implode('KT', $split_data_using_wind);
                                $split_data_using_wind[0] = $split_data_using_wind_first;
                                ksort($split_data_using_wind);
                                array_pop($split_data_using_wind);
                            }
                        }
                        $explode_using_wind_second = explode(" ", trim($split_data_using_wind[1]));

                        if ((is_numeric($explode_using_wind_second[0])) && (strlen($explode_using_wind_second[0]) == 4)) {
                            $split_data['visibility'] = trim($explode_using_wind_second[0]);

                            if ((strpos($explode_using_wind_second[1], 'R') === 0 ) && (strpos($explode_using_wind_second[1], '/') !== false)) {

                                $split_data['runway_visibility1'] = trim($explode_using_wind_second[1]);
                                if ((strpos($explode_using_wind_second[2], 'R') === 0) && (strpos($explode_using_wind_second[2], '/') !== false)) {
                                    $split_data['runway_visibility2'] = trim($explode_using_wind_second[2]);
                                } else {
                                    $split_data['runway_visibility2'] = NULL;
                                }
                            } else {
                                $split_data['runway_visibility1'] = NULL;
                                $split_data['runway_visibility2'] = NULL;
                                $split_data['trend_sky'] = NULL;
                                $split_data['trend_wind_direction'] = NULL;
                                $split_data['trend_wind_speed'] = NULL;
                                $split_data['trend_wind_gust'] = NULL;
                                $split_data['trend_visibility'] = NULL;
                                $split_data['trend_wx'] = NULL;
                            }

                            $clouds_values = ['FEW', 'NSC', 'SKC', 'BKN', 'OVC', 'SCT'];
                            $str_pos_cloud_values = array();
                            for ($i = 0; $i < sizeof($clouds_values); $i++) {
                                if (strpos($split_data_using_wind[1], $clouds_values[$i]) !== false) {
                                    $str_pos_cloud_values[] = strpos($split_data_using_wind[1], $clouds_values[$i]);
                                }
                            }



                            if (sizeof($str_pos_cloud_values) < 1) {//If Clouds data doesn't exist
                                $split_data['clouds'] = NULL;
                                $explode_from_wind_using_spaces = explode(' ', trim($split_data_using_wind[1]));
                                //Start of Weather
                                if (!empty($split_data['runway_visibility2'])) {
                                    if ((strpos($explode_from_wind_using_spaces[3], '/') !== false) || (strpos($explode_from_wind_using_spaces[3], 'Q') !== false)) {
                                        $split_data['wx'] = NULL;
                                    } else {
                                        $split_data['wx'] = $explode_from_wind_using_spaces[3];
                                    }
                                } else if ((!empty($split_data['runway_visibility1'])) && (empty($split_data['runway_visibility2']))) {
                                    if ((strpos($explode_from_wind_using_spaces[2], '/') !== false) || (strpos($explode_from_wind_using_spaces[2], 'Q') !== false)) {
                                        $split_data['wx'] = NULL;
                                    } else {
                                        $split_data['wx'] = $explode_from_wind_using_spaces[2];
                                    }
                                } else if ((empty($split_data['runway_visibility1'])) && (empty($split_data['runway_visibility2']))) {
                                    if ((strpos($explode_from_wind_using_spaces[1], '/') !== false) || (strpos($explode_from_wind_using_spaces[1], 'Q') !== false)) {
                                        $split_data['wx'] = NULL;
                                    } else {
                                        $split_data['wx'] = $explode_from_wind_using_spaces[1];
                                    }
                                }

                                //End of Weather
                                if (strripos($split_data_using_wind[1], 'Q') !== false) {

                                    $split_no_clouds_using_q = explode('Q', $split_data_using_wind[1]);

                                    $split_data['pressure'] = strtok(trim($split_no_clouds_using_q[1]), " ");
                                    $split_data_trend = trim(strstr(trim($split_no_clouds_using_q[1]), " "));


                                    // Start of Temperature and Dewpoint
                                    if (strpos($split_no_clouds_using_q[0], '/') !== false) {
                                        $split_using_slash_no_clouds_to_q = explode('/', $split_no_clouds_using_q[0]);
                                        $split_data['temperature'] = trim(substr($split_using_slash_no_clouds_to_q[0], -3));
                                        $split_data['dew_point'] = trim($split_using_slash_no_clouds_to_q[1]);
                                    } else {
                                        $split_data['temperature'] = NULL;
                                        $split_data['dew_point'] = NULL;
                                    }

                                    //Start of trend
                                    if ($split_data_trend == '') {
                                        $split_data['trend_sky'] = NULL;
                                        $split_data['trend_wind_direction'] = NULL;
                                        $split_data['trend_wind_speed'] = NULL;
                                        $split_data['trend_wind_gust'] = NULL;
                                        $split_data['trend_visibility'] = NULL;
                                        $split_data['trend_wx'] = NULL;
                                        $split_data['remarks'] = NULL;
                                        $split_data['caution'] = NULL;
                                    } else {
                                        $split_data['trend_sky'] = strtok($split_data_trend, " ");

                                        if (strpos($split_data_trend, 'RMK') !== false) {
                                            $split_rmk = explode('RMK', $split_data_trend);
                                            $split_data_trend = trim($split_rmk[0]);
                                            $split_data['remarks'] = trim($split_rmk[1]);
                                            $split_data['caution'] = NULL;
                                        } else if (strpos($split_data_trend, 'CAUTION') !== false) {
                                            $split_caution = explode('CAUTION', $split_data_trend);
                                            $split_data_trend = trim($split_caution[0]);
                                            $split_data['caution'] = trim($split_caution[1]);
                                            $split_data['remarks'] = null;
                                        } else {
                                            $split_data_trend = $split_data_trend;
                                            $split_data['remarks'] = NULL;
                                            $split_data['caution'] = NULL;
                                        }

                                        if (strpos($split_data_trend, 'KT') !== false) {
                                            $split_data_trend_kt = explode(' ', $split_data_trend);

                                            if (sizeof($split_data_trend_kt) > 1) {
                                                if (strpos($split_data_trend_kt[1], 'G') !== false) {
                                                    $split_data['trend_wind_direction'] = substr(trim($split_data_trend_kt[1]), 0, 3);
                                                    $split_data['trend_wind_speed'] = substr(trim($split_data_trend_kt[1]), 3, 2);
                                                    $split_data['trend_wind_gust'] = substr(trim($split_data_trend_kt[1]), -4, 2);
                                                } else {
                                                    $split_data['trend_wind_direction'] = substr(trim($split_data_trend_kt[1]), 0, 3);
                                                    $split_data['trend_wind_speed'] = substr(trim($split_data_trend_kt[1]), 3, 2);
                                                    $split_data['trend_wind_gust'] = NULL;
                                                }

                                                if (sizeof($split_data_trend_kt) > 2) {
                                                    if (is_numeric(trim($split_data_trend_kt[2]))) {
                                                        $split_data['trend_visibility'] = trim($split_data_trend_kt[2]);
                                                    } else {
                                                        $split_data['trend_visibility'] = NULL;
                                                    }
                                                } else {
                                                    $split_data['trend_visibility'] = NULL;
                                                }
                                            }
                                        } else {
                                            $split_data['trend_wind_direction'] = NULL;
                                            $split_data['trend_wind_speed'] = NULL;
                                            $split_data['trend_wind_gust'] = NULL;
                                            $split_trend = explode(" ", $split_data_trend);

                                            if (sizeof($split_trend) > 1) {
                                                if (is_numeric($split_trend[1])) {
                                                    $split_data['trend_visibility'] = $split_trend[1];
                                                } else {
                                                    $split_data['trend_visibility'] = NULL;
                                                }
                                            } else {
                                                $split_data['trend_visibility'] = NULL;
                                            }
                                        }

                                        if ($split_data['trend_visibility'] !== NULL) {
                                            $split_data_trend_wx = explode($split_data['trend_visibility'], $split_data_trend);

                                            if (sizeof($split_data_trend_wx) > 1) {
                                                $split_trend_wx = strtok($split_data_trend_wx[1], " ");
                                                if ((strpos($split_trend_wx, 'SKC') !== false) || (strpos($split_trend_wx, 'FEW') !== false) || (strpos($split_trend_wx, 'SCT') !== false) || (strpos($split_trend_wx, 'BKN') !== false) || (strpos($split_trend_wx, 'OVC') !== false) || (strpos($split_trend_wx, 'NSC') !== false)) {
                                                    $split_data['trend_wx'] = NULL;
                                                } else {
                                                    $split_data['trend_wx'] = $split_trend_wx;
                                                }
                                            } else {
                                                $split_data['trend_wx'] = NULL;
                                            }
                                        } else {
                                            $split_data_trend_wx = explode(" ", $split_data_trend);
                                            if (sizeof($split_data_trend_wx) > 1) {
                                                if (strpos($split_data_trend_wx[1], 'KT') === false) {
                                                    $split_data['trend_wx'] = trim($split_data_trend_wx[1]);
                                                } else {
                                                    $split_data['trend_wx'] = NULL;
                                                }
                                            } else {
                                                $split_data['trend_wx'] = NULL;
                                            }
                                        }
                                    }
                                    //End of Trend
                                } else {
                                    $error = true;
                                    Session::flash('error', 'Error in pressure for: ' . $split_data['airport_code']);
                                    break;
                                }
                            } else {//If clouds data exists
                                $split_data_from_clouds = substr($split_data_using_wind[1], min($str_pos_cloud_values));

                                $split_upto_clouds_from_kt = substr($split_data_using_wind[1], 0, min($str_pos_cloud_values));

                                if (!empty($split_data['runway_visibility2'])) {
                                    $explode_upto_clouds_from_kt = explode(" ", trim($split_upto_clouds_from_kt));
                                    if (sizeof($explode_upto_clouds_from_kt) > 3) {
                                        $split_data['wx'] = $explode_upto_clouds_from_kt[3];
                                    } else {
                                        $split_data['wx'] = NULL;
                                    }
                                } else if ((!empty($split_data['runway_visibility1'])) && (empty($split_data['runway_visibility2']))) {
                                    $explode_upto_clouds_from_kt = explode(" ", trim($split_upto_clouds_from_kt));
                                    if (sizeof($explode_upto_clouds_from_kt) > 2) {
                                        $split_data['wx'] = $explode_upto_clouds_from_kt[2];
                                    } else {
                                        $split_data['wx'] = NULL;
                                    }
                                } else if ((empty($split_data['runway_visibility1'])) && (empty($split_data['runway_visibility2']))) {
                                    if (trim(substr($split_upto_clouds_from_kt, 5)) !== '') {
                                        $split_data['wx'] = trim(substr($split_upto_clouds_from_kt, 5));
                                    } else {
                                        $split_data['wx'] = NULL;
                                    }
                                }

//                                if (strripos($split_data_from_clouds, '/') !== false) {
//                                    $str_pos_slash = strripos($split_data_from_clouds, '/');
//                                    $str_clouds = trim(substr($split_data_from_clouds, 0, $str_pos_slash - 3));
//                                } else if (strpos($split_data_from_clouds, 'Q') !== false) {
//                                    $str_pos_q = strpos($split_data_from_clouds, 'Q');
//                                    $str_clouds = trim(substr($split_data_from_clouds, 0, $str_pos_q - 1));
//                                }
//                                $split_data['clouds'] = $str_clouds;

                                $split_data['clouds'] = $this->getClouds($key);

                                if (strripos($split_data_using_wind[1], 'Q') !== false) {
                                    $split_from_clouds_to_q = explode('Q', $split_data_from_clouds);

                                    // Start of Temperature and Dewpoint
                                    if (strpos($split_from_clouds_to_q[0], '/') !== false) {
                                        $split_using_slash_from_clouds_to_q = explode('/', $split_from_clouds_to_q[0]);
                                        $split_data['temperature'] = trim(substr($split_using_slash_from_clouds_to_q[0], -3));
                                        $split_data['dew_point'] = trim($split_using_slash_from_clouds_to_q[1]);
                                    } else {
                                        $split_data['temperature'] = NULL;
                                        $split_data['dew_point'] = NULL;
                                    }
                                    // End of Temperature and Dewpoint
                                    $split_using_q = explode('Q', $split_data_using_wind[1]);
                                    $split_data['pressure'] = trim(strtok(trim($split_using_q[1]), " "));
                                    $split_data_trend = trim(strstr(trim($split_using_q[1]), " "));

                                    //Start of Trend

                                    if ($split_data_trend == '') {
                                        $split_data['trend_sky'] = NULL;
                                        $split_data['trend_wind_direction'] = NULL;
                                        $split_data['trend_wind_speed'] = NULL;
                                        $split_data['trend_wind_gust'] = NULL;
                                        $split_data['trend_visibility'] = NULL;
                                        $split_data['trend_wx'] = NULL;
                                        $split_data['remarks'] = NULL;
                                        $split_data['caution'] = NULL;
                                    } else {
                                        $split_data['trend_sky'] = strtok($split_data_trend, " ");

                                        if (strpos($split_data_trend, 'RMK') !== false) {
                                            $split_rmk = explode('RMK', $split_data_trend);
                                            $split_data_trend = trim($split_rmk[0]);
                                            $split_data['remarks'] = trim($split_rmk[1]);
                                            $split_data['caution'] = NULL;
                                        } else if (strpos($split_data_trend, 'CAUTION') !== false) {
                                            $split_caution = explode('CAUTION', $split_data_trend);
                                            $split_data_trend = trim($split_caution[0]);
                                            $split_data['caution'] = trim($split_caution[1]);
                                            $split_data['remarks'] = NULL;
                                        } else {
                                            $split_data_trend = $split_data_trend;
                                            $split_data['remarks'] = NULL;
                                            $split_data['caution'] = NULL;
                                        }

                                        if (strpos($split_data_trend, 'KT') !== false) {
                                            $split_data_trend_kt = explode(' ', $split_data_trend);

                                            if (sizeof($split_data_trend_kt) > 1) {
                                                if (strpos($split_data_trend_kt[1], 'G') !== false) {
                                                    $split_data['trend_wind_direction'] = substr(trim($split_data_trend_kt[1]), 0, 3);
                                                    $split_data['trend_wind_speed'] = substr(trim($split_data_trend_kt[1]), 3, 2);
                                                    $split_data['trend_wind_gust'] = substr(trim($split_data_trend_kt[1]), -4, 2);
                                                } else {
                                                    $split_data['trend_wind_direction'] = substr(trim($split_data_trend_kt[1]), 0, 3);
                                                    $split_data['trend_wind_speed'] = substr(trim($split_data_trend_kt[1]), 3, 2);
                                                    $split_data['trend_wind_gust'] = NULL;
                                                }

                                                if (sizeof($split_data_trend_kt) > 2) {
                                                    if (is_numeric(trim($split_data_trend_kt[2]))) {
                                                        $split_data['trend_visibility'] = trim($split_data_trend_kt[2]);
                                                    } else {
                                                        $split_data['trend_visibility'] = NULL;
                                                    }
                                                } else {
                                                    $split_data['trend_visibility'] = NULL;
                                                }
                                            }
                                        } else {
                                            $split_data['trend_wind_direction'] = NULL;
                                            $split_data['trend_wind_speed'] = NULL;
                                            $split_data['trend_wind_gust'] = NULL;
                                            $split_trend = explode(" ", $split_data_trend);

                                            if (sizeof($split_trend) > 1) {
                                                if (is_numeric($split_trend[1])) {
                                                    $split_data['trend_visibility'] = $split_trend[1];
                                                } else {
                                                    $split_data['trend_visibility'] = NULL;
                                                }
                                            } else {
                                                $split_data['trend_visibility'] = NULL;
                                            }
                                        }

                                        if ($split_data['trend_visibility'] !== NULL) {
                                            $split_data_trend_wx = explode($split_data['trend_visibility'], $split_data_trend);

                                            if (sizeof($split_data_trend_wx) > 1) {
                                                $split_trend_wx = strtok($split_data_trend_wx[1], " ");
                                                if ((strpos($split_trend_wx, 'SKC') !== false) || (strpos($split_trend_wx, 'FEW') !== false) || (strpos($split_trend_wx, 'SCT') !== false) || (strpos($split_trend_wx, 'BKN') !== false) || (strpos($split_trend_wx, 'OVC') !== false) || (strpos($split_trend_wx, 'NSC') !== false)) {
                                                    $split_data['trend_wx'] = NULL;
                                                } else {
                                                    $split_data['trend_wx'] = $split_trend_wx;
                                                }
                                            } else {
                                                $split_data['trend_wx'] = NULL;
                                            }
                                        } else {
                                            $split_data_trend_wx = explode(" ", $split_data_trend);
                                            if (sizeof($split_data_trend_wx) > 1) {
                                                if (strpos($split_data_trend_wx[1], 'KT') === false) {
                                                    $split_data['trend_wx'] = trim($split_data_trend_wx[1]);
                                                } else {
                                                    $split_data['trend_wx'] = NULL;
                                                }
                                            } else {
                                                $split_data['trend_wx'] = NULL;
                                            }
                                        }
                                    }

                                    //End of Trend
                                } else {
                                    $error = true;
                                    Session::flash('error', 'Error in pressure for: ' . $split_data['airport_code']);
                                    break;
                                }
                            }
                        } else {
                            $error = true;
                            Session::flash('error', 'Error in visibility for: ' . $split_data['airport_code']);
                            break;
                        }
                    }
                    /* Start of Visibility */

                    /* End of Visibility */
                }
                array_push($weathers, $split_data);
            }
        } else {
            $error = true;
            Session::flash('error', 'No Data (or) Data is not in Correct Format');
        }

        if ($error == false) {
//            echo "<pre>";
//            print_r($weathers);
//            echo "</pre>";
            foreach ($weathers as $weather) {
                $weather_cnt = Weather::where('airport_code', $weather['airport_code'])->where('wx_date', $weather['wx_date'])->where('wx_time_gmt', $weather['wx_time_gmt'])->first();
                if (count($weather_cnt) > 0) {
                    Weather::find($weather_cnt->id)->delete();
                }
            }

            Weather::insert($weathers);
            Session::flash('message', 'Succesfully uploaded');
            return redirect("/weather");
        }
        return view("weather.weather_v.weather_upload", ["data" => []]);
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

    public function getClouds($data) {
        $split_data = explode(" ", $data);
        $cloudsTypes = ['NSC', 'SKC', 'FEW', 'SCT', 'BKN', 'OVC'];
        $cloudTypeIndex = array();
        for ($i = 0; $i < sizeof($cloudsTypes); $i++) {
            if (strpos($data, $cloudsTypes[$i]) !== false) {
                array_push($cloudTypeIndex, strpos($data, $cloudsTypes[$i]));
            }
        }
        sort($cloudTypeIndex);
        if (sizeof($cloudTypeIndex) == 0) {
            return "NA";
        }
        $lastCloudValue = explode(" ", substr($data, $cloudTypeIndex[sizeof($cloudTypeIndex) - 1]))[0];
        $lastCloudValueLen = strlen($lastCloudValue);
        $lastCloudValuepos = strpos(substr($data, $cloudTypeIndex[0]), $lastCloudValue);
        $cloudEndPos = $lastCloudValuepos + $lastCloudValueLen;

        return substr($data, $cloudTypeIndex[0], $cloudEndPos);
    }
    
    public function autoSuggest() {
        $airports_code = DB::table('weather_metars')->distinct('airport_code')->pluck('airport_code');
        return json_encode($airports_code);
    }

}
