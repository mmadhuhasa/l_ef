<?php

namespace App\Http\Controllers\Notams;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions\customException;
use Log;
use Redirect;
use App\models\NotamRecordsModel as NotamRecordsModel;
use App\models\RoutesModel;
use App\models\NotamIdModel;
use App\models\notams\FavouritesNotamsModel;
use App\models\notams\NotamsModel;
use App\models\notams\NotamsServerModel;
use App\models\NotamCoordinatesModel;
use App\models\CoordinatesModel;
use App\models\StationsModel;
use App\models\notamsops\StationwithNotamsModel;
use App\models\notams\NotamHelpCodeModel;
use PDF;
use Excel;
use DB;
use Mail;
use App;

class NotamsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // $this->sendNotamEmails();

        return view('notams.display_list');
        // $this->nearestAerodrome("VOBL",20);
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
        try {

            $notam = trim($request->notam);
            $notam = str_replace("'", "", $notam);
            $notam = str_replace('"', '', $notam);
            $notam = preg_replace('/[@#$%^&]/', 'and', $notam);
            $notam = preg_replace('/[?]/', '', $notam);

            $start_position = strpos($notam, "[Back to Top]") + 48;
            $end_position = strpos($notam, "Number of NOTAMs");
            $notam = substr($notam, $start_position, $end_position - $start_position);
            $notam = trim($notam);
            $notam_array = preg_split('/\n|\r/', $notam);
            $NewNotamArray = array();
            $x = 0;

            NotamRecordsModel::update_old_notams_to_null();
            RoutesModel::update_old_routes_to_null();
            NotamRecordsModel::delete_invalid_notams();

            foreach ($notam_array as $key => $notam_value) {
                if (strpos($notam_value, 'SOURCE') !== false) {
                    $x++;
                }
                $NewNotamArray[$x][] = $notam_value;
            }
//            echo '<pre>'; print_r($NewNotamArray);echo '</pre>';exit;  
            $notam_id = NotamIdModel::create(array('admin_name' => 'Operator', 'status' => '1'));
            $recent_id = $notam_id->id;

            $new_notam = 0;
            $total_dupes = 0;
            $dupe_num = 1;
            $notam_dupes_array = [];
            $notification = '';
            $routes_array = array('W', 'Q', 'V', 'L', 'N', 'P', 'R');
            $post = array();

            foreach ($NewNotamArray as $key => $values_array) {
                $value_filter = array_filter($values_array);
                $value = array_values($value_filter);
//      echo '<pre>';
//      print_r($value);
//      echo '</pre>';
//      exit;

                if (count($value) >= 5) {
                    foreach ($value as $value2) {
                        if (strpos($value[0], 'SOURCE') !== false && strpos($value[1], 'Back to Top') !== false && strpos($value[2], 'Check All') !== false) {

                            $notam_number = explode(" ", trim($value[3]));

                            $post['notam_number'] = $notam_number[0];

                            if ($notam_number[1] !== 'NOTAMN')
                                $post['revised_notam_number'] = $notam_number[2];
                            else
                                $post['revised_notam_number'] = $notam_number[1];

                            $fir = explode(" ", trim($value[4]));
                            $fir1 = explode("/", trim($fir[1]));

                            $line3 = explode(")", trim($value[5]));
                            $airport_txt = explode(' ', trim($line3['1']));
                            $from_date_txt = explode(' ', trim($line3['2']));
                            $to_date_txt = explode(' ', trim($line3['3']));

                            if (strpos($value[6], 'D)') !== false) {
                                $valid_time = $value[6]; //explode(" ", trim($value[6]));
                                unset($value[0], $value[1], $value[2], $value[3], $value[4], $value[5], $value[6]);
                            } else {
                                $valid_time = '';
                                unset($value[0], $value[1], $value[2], $value[3], $value[4], $value[5]);
                            }
                            $value3 = $value;
                            $text = '';

                            foreach ($value3 as $data) {
                                if (strpos($data, 'CREATED') !== false) {
                                    break;
                                }
                                $text .= $data;
                            }

                            $textarr = explode("E)", $text);
                            $e_text = $textarr[1];
                            if (!$e_text) {
                                $e_text = $text;
                            }

                            $f_text = explode("F)", trim($text));
                            $g_text = explode("G)", trim($text));

                            $post['fir'] = $fir1[0];
                            $post['q_code'] = $fir1[1];
                            $post['airport'] = $airport_txt[0];
                            $post['from_date'] = substr($from_date_txt[0], 0, 6);
                            $post['from_time'] = substr($from_date_txt[0], 6);
                            $post['to_date'] = substr($to_date_txt[0], 0, 6);
                            $post['to_time'] = substr($to_date_txt[0], 6);
                            $post['valid_timing'] = $valid_time; //$valid_time[1] . ' ' . $valid_time[2];
                            $post['notam_text'] = $e_text;
                            $post['recent_id'] = $recent_id;
                            $post['f_text'] = $f_text[1];

                            $post['g_text'] = $g_text[1];
                        } elseif ((strpos($value[0], 'SOURCE') !== false && strpos($value[1], 'Back to Top') !== false)) {

                            $value_after_backtotop = explode("[Back to Top]", trim($value[1]));
                            $notam_number = explode(" ", trim($value_after_backtotop[1]));
                            $post['notam_number'] = $notam_number[0];
                            if ($notam_number[1] !== 'NOTAMN')
                                $post['revised_notam_number'] = $notam_number[2];
                            else
                                $post['revised_notam_number'] = $notam_number[1];
                            $fir = explode(" ", trim($value[2]));
                            $fir1 = explode("/", trim($fir[1]));

                            $line3 = explode(")", trim($value[3]));
                            $airport_txt = explode(' ', trim($line3['1']));
                            $from_date_txt = explode(' ', trim($line3['2']));
                            $to_date_txt = explode(' ', trim($line3['3']));

                            if (strpos($value[4], 'D)') !== false) {
                                $valid_time = $value[4]; //explode(" ", trim($value[6]));
                                unset($value[0], $value[1], $value[2], $value[3], $value[4]);
                            } else {
                                $valid_time = '';
                                unset($value[0], $value[1], $value[2], $value[3]);
                            }
                            $value3 = $value;
                            $text = '';
                            foreach ($value3 as $data) {
                                if (strpos($data, 'CREATED') !== false) {
                                    break;
                                }
                                $text .= $data;
                            }
                            $textarr = explode("E)", $text);
                            $e_text = $textarr[1];
                            if (!$e_text) {
                                $e_text = $text;
                            }
                            $f_text = explode("F)", trim($text));
                            $g_text = explode("G)", trim($text));

                            $post['fir'] = $fir1[0];
                            $post['q_code'] = $fir1[1];

                            $post['airport'] = $airport_txt[0];
                            $post['from_date'] = substr($from_date_txt[0], 0, 6);
                            $post['from_time'] = substr($from_date_txt[0], 6);
                            $post['to_date'] = substr($to_date_txt[0], 0, 6);
                            $post['to_time'] = substr($to_date_txt[0], 6);
                            $post['valid_timing'] = $valid_time; //$valid_time[1] . ' ' . $valid_time[2];
                            $post['notam_text'] = $e_text;
                            $post['recent_id'] = $recent_id;
                            $post['f_text'] = $f_text[1];
                            $post['g_text'] = $g_text[1];
                        } elseif (strpos($value[0], 'SOURCE') !== false) {
                            $notam_number = explode(" ", trim($value[0]));

                            $post['notam_number'] = $notam_number[3];
                            if ($notam_number[4] !== 'NOTAMN')
                                $post['revised_notam_number'] = $notam_number[5];
                            else
                                $post['revised_notam_number'] = $notam_number[4];

                            $fir = explode(" ", trim($value[1]));
                            $fir1 = explode("/", trim($fir[1]));
//                $date_time = explode(" ", trim($value[2]));

                            $line3 = explode(")", trim($value[2]));   // print_r($date_time); 

                            $airport_txt = explode(' ', trim($line3['1']));
                            $from_date_txt = explode(' ', trim($line3['2']));
                            $to_date_txt = explode(' ', trim($line3['3']));

                            if (strpos($value[3], 'D)') !== false) {
                                $valid_time = trim($value[3]);
                                unset($value[0], $value[1], $value[2], $value[3]);
                            } else {
                                $valid_time = '';
                                unset($value[0], $value[1], $value[2]);
                            }

                            $value3 = $value;
                            $text = '';
                            foreach ($value3 as $data) {
                                if (strpos($data, 'CREATED') !== false) {
                                    break;
                                }
                                $text .= $data;
                            }
                            $textarr = explode("E)", $text);
                            $e_text = $textarr[1];
                            if (!$e_text) {
                                $e_text = $text;
                            }
                            $f_text = explode("F)", trim($text));
                            $g_text = explode("G)", trim($text));
                            $post['fir'] = $fir1[0];
                            $post['q_code'] = $fir1[1];
                            $post['airport'] = $airport_txt[0];
                            $post['from_date'] = substr($from_date_txt[0], 0, 6);
                            $post['from_time'] = substr($from_date_txt[0], 6);
                            $post['to_date'] = substr($to_date_txt[0], 0, 6);
                            $post['to_time'] = substr($to_date_txt[0], 6);
                            $post['valid_timing'] = $valid_time;
                            $post['notam_text'] = $e_text;

                            $post['recent_id'] = $recent_id;
                            $post['f_text'] = $f_text[1];
                            $post['g_text'] = $g_text[1];
                            //Routes
                        } else {
                            $notam_number = explode(" ", trim($value[0]));
                            $post['notam_number'] = $notam_number[0];
                            if ($notam_number[1] !== 'NOTAMN')
                                $post['revised_notam_number'] = $notam_number[2];
                            else
                                $post['revised_notam_number'] = $notam_number[1];

                            $fir = explode(" ", trim($value[1]));
                            $fir1 = explode("/", trim($fir[1]));
                            $line3 = explode(")", trim($value[2]));   // print_r($date_time); 

                            $airport_txt = explode(' ', trim($line3['1']));
                            $from_date_txt = explode(' ', trim($line3['2']));
                            $to_date_txt = explode(' ', trim($line3['3']));

                            if (strpos($value[3], 'D)') !== false) {
                                $valid_time = trim($value[5]);
                                unset($value[0], $value[1], $value[2], $value[3]);
                            } else {
                                $valid_time = '';
                                unset($value[0], $value[1], $value[2]);
                            }

                            $value3 = $value;
                            $text = '';
                            foreach ($value3 as $data) {
                                if (strpos($data, 'CREATED') !== false) {
                                    break;
                                }
                                $text .= $data;
                            }
                            $textarr = explode("E)", $text);
                            $e_text = $textarr[1];
                            if (!$e_text) {
                                $e_text = $text;
                            }

                            $f_text = explode("F)", trim($text));
                            $g_text = explode("G)", trim($text));

                            $post['fir'] = $fir1[0];
                            $post['q_code'] = $fir1[1];
                            $post['airport'] = $airport_txt[0];
                            $post['from_date'] = substr($from_date_txt[0], 0, 6);
                            $post['from_time'] = substr($from_date_txt[0], 6);
                            $post['to_date'] = substr($to_date_txt[0], 0, 6);
                            $post['to_time'] = substr($to_date_txt[0], 6);
                            $post['valid_timing'] = $valid_time;
                            $post['notam_text'] = $e_text;
                            $post['recent_id'] = $recent_id;
                            $post['f_text'] = (array_key_exists(1, $f_text)) ? $f_text[1] : ''; //$f_text[1];
                            $post['g_text'] = (array_key_exists(1, $g_text)) ? $g_text[1] : ''; //$g_text[1];
                        }

                        $from_date = trim($post['from_date']);
                        $from_time = trim($post['from_time']);
                        $to_date = trim($post['to_date']);
                        $to_time = trim($post['to_time']);

                        $monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                        $from_year = substr($from_date, 0, 2);
                        $from_month = substr($from_date, 2, 2);
                        $from_day = substr($from_date, 4, 2);
                        $from_hr = substr($from_time, 0, 2);
                        $from_min = substr($from_time, 2, 2);
                        $to_year = substr($to_date, 0, 2);
                        $to_month = substr($to_date, 2, 2);
                        $to_day = substr($to_date, 4, 2);
                        $to_hr = substr($to_time, 0, 2);
                        $to_min = substr($to_time, 2, 2);

                        $from_date_format = $from_day . ' ' . $monthNames[$from_month - 1] . ' 20' . $from_year;
                        $to_date_format = $to_day . ' ' . $monthNames[$to_month - 1] . ' 20' . $to_year;
                        $from_time_format = $from_hr . ':' . $from_min;
                        $to_time_format = $to_hr . ':' . $to_min;

                        $post['from_time_IST'] = date("H:i", strtotime("+330 minutes", strtotime($from_time_format)));
                        $post['to_time_IST'] = date("H:i", strtotime("+330 minutes", strtotime($to_time_format)));
                        $post['from_date_format'] = $from_date_format;
                        $post['from_time_format'] = $from_time_format;
                        if ($to_date != 'PERM') {
                            $post['to_date_format'] = $to_date_format;
                            $post['to_time_format'] = $to_time_format;
                        } else {
                            $post['to_date_format'] = 'PERMANENT';
                            $post['to_time_format'] = '';
                        }

                        if ($post['airport']) {
                            $airport = $post['airport'];
                            $notam_number = $post['notam_number'];
                            $timestamp = date('d-M-Y H:i:s');
//Anand New Design
//              $obj->deleteDupeNotams($post);
//              $obj->deleteRoute($post);
//              $obj->update_coordinates($post);
//              $notam_number_exist = count($obj->getcountofNotams($post));     
                            $notam_number_exist = NotamRecordsModel::notam_number_exist($post);

                            //Routes
                            $e_text_array = explode(" ", $post['notam_text']);
                            $routes_data = array();
                            foreach ($e_text_array as $routes) {
                                if (strlen($routes) <= 5 && in_array(substr($routes, 0, 1), $routes_array) && preg_match('/^[0-9]*$/', substr($routes, 1, 1)) && preg_match('/^[0-9]*$/', substr($routes, 2, 1))) {
                                    $routes = rtrim($routes, ",");
                                    $routes = rtrim($routes, ".");
                                    $routes = rtrim($routes, "-");
                                    $post['route_name'] = $routes;
                                    //Anand New Design
//                  $check_route_exist = $obj->check_route_exist($post['airport'], $post['notam_number'], $post['route_name']);
//                  if (!$check_route_exist) {
//                  $obj->insertRoutes($post);
//                  }
                                }
                            }
                            //Routes

                            if (!$notam_number_exist) {
                                $post['recent_added_number'] = 'RAN' . $post['notam_number'];
                                $new_notam++;
                                $notification = 'Mails have been sent to respective customers';
                                //Anand New Design
//              $update_routes = $obj->updateRoutes($post);
//              //Insert into notams report
//              $result = $obj->InsertNotams($post);
                                echo '<pre>';
                                print_r($post);
                                echo '</pre>';
                                exit;
                                $result = NotamRecordsModel::create($post);
                                $update_routes = RoutesModel::update_notam_routes($post);
                                echo '<pre>';
                                print_r($post);
                                echo '</pre>';
                                exit;
                            } else {
                                //check dupe notams
//              $recent_notam_number_exist = count($obj->getcountofNotams($post, $recent_id));
                                echo '<pre>';
                                print_r($post);
                                echo '</pre>';
                                exit;
                                $recent_notam_number_exist = NotamRecordsModel::notam_number_exist($post);
                                echo '<pre>';
                                print_r($post);
                                echo '</pre>';
                                exit;
                                if ($recent_notam_number_exist) {
                                    if (array_key_exists($post['airport'] . $post['notam_number'], $notam_dupes_array)) {
                                        $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''] = $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''] + 1;
                                    } else {
                                        $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''] = 1;
                                    }
                                    $post['dupe_notam_number'] = ' DUPE' . $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''];
                                    $dupe_records = NotamRecordsModel::create($post); //$obj->InsertNotams($post);
                                    $total_dupes++;
                                    $dupe_num++;
                                }
                                $post['recent_added_number'] = '';
                                $update = NotamRecordsModel::update_notams($post); //$obj->updateNotams($post);
                            }
                            //insert coordinates
                            echo '<pre>';
                            print_r($post);
                            echo '</pre>';
                            exit;
                            $co_arr = preg_split('/E/', $post['notam_text']);
                            foreach ($co_arr as $value) {
                                if (preg_match('/^[0-9]/', substr($value, -1))) {
                                    if (strpos($value, 'N') !== false && strlen($value) >= 12 && strpos($value, '/') === false) {
                                        $str = substr($value, -25);
                                        $str = ltrim($str, '-');
                                        for ($i = 0; $i <= 10; $i++) {
                                            if (!preg_match('/[0-9]/', substr($str, 0, 1)) || !preg_match('/[0-9]/', substr($str, 2, 1))) {
                                                $str = substr($str, 1);
                                            }
                                        }
                                        if (strpos($str, 'N') !== false) {
                                            for ($i = 0; $i <= 4; $i++) {
                                                if (strlen($str) <= 16) {
                                                    if (!preg_match('/[0-9]/', substr($str, 0, 1)) || !preg_match('/[0-9]/', substr($str, 2, 1))) {
                                                        $str = substr($str, 1);
                                                    }
                                                }
                                            }
//                                echo $str;echo'<br/>';
                                            $str_array = explode('N', trim($str));
                                            $lattitude = trim($str_array[0]);
                                            $longtitude = trim($str_array[1]);

                                            $lat_milli_secs_array = explode('.', $lattitude);
                                            $long_milli_secs_array = explode('.', $longtitude);

                                            $post['lattitude'] = $lattitude;
                                            $post['longtitude'] = $longtitude;
                                            $post['lat_degs'] = substr($lattitude, 0, 2);
                                            $post['lat_mins'] = substr($lattitude, 2, 2);
                                            $post['lat_secs'] = substr($lattitude, 4, 2);
                                            $post['lat_milli_secs'] = $lat_milli_secs_array[1];
                                            $post['long_degs'] = substr($longtitude, 0, 3);
                                            $post['long_mins'] = substr($longtitude, 3, 2);
                                            $post['long_secs'] = substr($longtitude, 5, 2);
                                            $post['long_milli_secs'] = $long_milli_secs_array[1];
                                            CoordinatesModel::create($post); //$obj->insert_coordinates($post);
                                        }
                                    }
                                }
                            }
                            $notification = 'Mails have been sent to respective customers';
                        }
                        break;
                    }
                }
            }
        } catch (\Exception $ex) {
            Log::error('Notams Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
        }
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

    public function store_notams($id) {
        $json = @file_get_contents("http://api.vateud.net/notams/" . $id . ".json");
        if ($json == false) {
            $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $id)->first();
            $airport = ($stations) ? $stations->aero_name : '';
            return view('notams.display_list', ['airport' => $airport, 'notams_array' => array(), 'status' => 'failed']);
        }
        $json = str_replace("\\n", '<br/>', $json);
        $notamsHelpCode = new NotamHelpCodeModel;

        $notams_array = array();
        if ($json == 'No notams found for this airport') {
            return $notams_array;
        }

        $notams_json_data = json_decode($json);
        $notamsObj = new NotamsModel;
        $notamsObj::setAllasDeleted($id, 1);

        foreach ($notams_json_data as $key) {

            $notams_raw_dataArray = explode("<br/>", $key->raw);
            if (strpos($notams_raw_dataArray[2], 'E)') !== false && strpos($notams_raw_dataArray[2], 'A)') !== false) {
                $notams_raw_dataArray[2] = explode('E)', $notams_raw_dataArray[2])[0];
            } else if (strpos($notams_raw_dataArray[2], 'E)') !== false) {
                $tempvar = "A)" . explode('A)', $notams_raw_dataArray[1])[1];
                array_splice($notams_raw_dataArray, 2, 0, $tempvar);
            }

            $notamsData = array();
            $type = substr($notams_raw_dataArray[0], 9, 6);
            $notamsData['notam_no'] = substr($notams_raw_dataArray[0], 0, 9);
            $notamsData['oldNum'] = 'NA';
            $notamsData['notam_type'] = str_replace("NOTAM", "", $type);
            if ($notamsData['notam_type'] == "R") {
                $notamsData['oldNum'] = trim(str_replace("NOTAMR", "", substr($notams_raw_dataArray[0], 9)));
                if (NotamsModel::where('notam_no', $notamsData['oldNum'])->first() == true) {
                    NotamsModel::where('notam_no', $notamsData['oldNum'])->delete();
                    // $notamsData['oldNum'] = $notamsData['oldNum'] . " Deleted Successfully";
                }
            }
            if (sizeof(explode("Q)", $notams_raw_dataArray[1])) == 1) {
                continue;
            }
            $notamsData['q_line'] = explode("Q)", $notams_raw_dataArray[1])[1];
            if (explode('/', $notamsData['q_line'])[1] == "QKKKK") {
                continue;
            }
            $notamsData['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $notamsData['q_line'])[1], 1, 2), 1)['signification'];
            $notamsData['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $notamsData['q_line'])[1], 3, 2), 2)['signification'];
            $notamsData['decoded_qline'] = trim($notamsData['notam_Qline1']) . " " . trim($notamsData['notam_Qline2']);
            if ($notamsData['decoded_qline'] == " ") {
                $notamsData['decoded_qline'] = "NA";
            }
            $notamsData['e_start_date'] = explode(" ", explode("C)", explode("B)", $notams_raw_dataArray[2])[1])[0])[1];
            $start_date_formatted = date_create("20" . $notamsData['e_start_date']);
            $start_date_formatted_ist = date_create("20" . $notamsData['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $notamsData['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $notamsData['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $notamsData['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            if (explode("C)", $notams_raw_dataArray[2])[1] == " PERM" || strpos(explode("C)", $notams_raw_dataArray[2])[1], 'PERM') !== false || explode("C)", $notams_raw_dataArray[2])[1] == " PERM E)") {
                $notamsData['e_end_date'] = "9999-12-31 23:59";
            } else {
                $notamsData['e_end_date'] = str_replace("EST", "", explode("C)", $notams_raw_dataArray[2])[1]);
            }
            $notamsData['e_end_date'] = trim($notamsData['e_end_date']);
            $end_date_formatted = date_create("20" . $notamsData['e_end_date']);
            $end_date_formatted_ist = date_create("20" . $notamsData['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $notamsData['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $notamsData['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $notamsData['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");

            if (sizeof(explode("E)", $key->raw)) == 2) {
                $notamsData['description'] = explode("F)", str_replace("<br/>", "", explode("E)", $key->raw)[1]))[0];
            } else {
                $dataSplittedWithE = explode("E)", $key->raw);
                $outputDescription = " ";
                for ($i = 1; $i < sizeof($dataSplittedWithE); $i++) {
                    $outputDescription = $outputDescription . " " . $dataSplittedWithE[$i];
                }
                $notamsData['description'] = explode("F)", str_replace("<br/>", "", $outputDescription))[0];
            }
            if (sizeof(explode("F) A", $key->raw)) > 1) {
                $notamsData['height'] = "A" . explode("G)", explode("F) A", $key->raw)[1])[0];
                $notamsData['level'] = explode("<br/>", explode(" G)", $key->raw)[1])[0];
            }
            $timePosition = strpos($key->raw, "D)");
            if ($timePosition != false) {
                if (sizeof(explode("<br/>D)", $key->raw)) > 1) {
                    $notamsData['time'] = $this->appendIst(explode("E)", explode("D)", $key->raw)[1])[0]);
                } else {
                    if (($notamsData['e_start_time_formatted'] == '0000' || $notamsData['e_start_time_formatted'] == '0001') && $notamsData['e_end_time_formatted'] == '2359') {
                        $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " IST)";
                    } else {
                        $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted_ist'] . " - " . $notamsData['e_end_time_formatted_ist'] . " IST)";
                    }
                }
            } else {
                if (($notamsData['e_start_time_formatted'] == '0000' || $notamsData['e_start_time_formatted'] == '0001') && $notamsData['e_end_time_formatted'] == '2359') {
                    $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " IST)";
                } else {
                    $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted_ist'] . " - " . $notamsData['e_end_time_formatted_ist'] . " IST)";
                }
            }
            if ($notamsData['time'] == " H-24") {
                $notamsData['time'] = "24 Hours";
            }
            $airportCodes = array();
            if (strlen($key->icao) > 4) {
                if (strpos($key->icao, '/') !== false) {
                    $airportCodes = explode('/', $key->icao);
                } else {
                    $airportCodes = explode(' ', $key->icao);
                }
            }
            for ($i = 0; $i < sizeof($airportCodes); $i++) {
                $notams = new NotamsModel;
                $notams->notam_no = $notamsData['notam_no'];
                $notams->notam_type = $notamsData['notam_type'];
                $notams->q_line = $notamsData['q_line'];
                $notams->e_start_date = $notamsData['e_start_date'];
                $notams->e_end_date = $notamsData['e_end_date'];
                $notams->time = $notamsData['time'];
                $notams->decoded_qline = $notamsData['decoded_qline'];

                if (isset($notamsData['height'])) {
                    $notams->height = $notamsData['height'];
                    $notams->level = $notamsData['level'];
                }
                $tempRaw = explode('<br/>', $key->raw);
                array_splice($tempRaw, 1, 1);
                $tempRaw = implode("<br/>", $tempRaw);
                $desc_raw = explode("E)", $tempRaw);

                if (sizeof($desc_raw) == 2) {
                    // $desc_raw[1] = str_replace("<br/>", " ", explode("F)", $desc_raw[1])[0]);
                    $tempDesc = explode("F)", $desc_raw[1]);
                    $tempDesc[0] = str_replace("<br/>", " ", $tempDesc[0]);
                    $desc_raw[1] = implode("F)", $tempDesc);

                    $notams->raw_data = implode("E)", $desc_raw);
                } else {
                    for ($j = 1; $j < sizeof($desc_raw); $j++) {
                        $tempDesc = explode("F)", $desc_raw[$i]);
                        $tempDesc[0] = str_replace("<br/>", " ", $tempDesc[0]);
                        $desc_raw[$i] = implode("F)", $tempDesc);

                        // $desc_raw[$j] = str_replace("<br/>", " ", explode("F)", $desc_raw[$j])[0]);
                    }
                    $notams->raw_data = implode("E)", $desc_raw);
                }

                $notams->icao = $key->icao;
                $endPartPosition = strpos($notamsData['description'], "END PART");
                if ($endPartPosition) {
                    $notams->description = substr($notamsData['description'], 0, $endPartPosition);
                } else {
                    $notams->description = substr($notamsData['description'], 0);
                }
                $notamsData['aerodrome'] = substr($key->icao, 0, 4);
                $notams->aerodrome = $notamsData['aerodrome'];
                if ($airportCodes[$i] == 'PART') {
                    break;
                }
                $notamsData['aerodrome'] = substr($airportCodes[$i], 0, 4);
                $notams->aerodrome = $notamsData['aerodrome'];
                if (NotamsModel::where('notam_no', $notams->notam_no)->where('aerodrome', $notamsData['aerodrome'])->first() == false) {
                    $notams->save();
                    if ($id == $notams->aerodrome) {
                        $this->newlyAdded++;
                    }
                } else if (strpos($key->icao, 'PART')) {
                    $previousDescription = NotamsModel::where('notam_no', $notams->notam_no)->where('aerodrome', $notams->aerodrome)->first()->description;
                    if (strpos($previousDescription, $notams->description) === false) {
                        $notams::updateDescription($previousDescription . " " . $notams->description, $notams->notam_no);
                    }
                    $notams::updatecancel($notams->notam_no, 0);
                } else {
                    $notams::updatecancel($notams->notam_no, 0);
                }
                array_push($notams_array, $notamsData);
            }
            if (sizeof($airportCodes) == 0) {
                $notams = new NotamsModel;
                $notams->notam_no = $notamsData['notam_no'];
                $notams->notam_type = $notamsData['notam_type'];
                $notams->q_line = $notamsData['q_line'];
                $notams->e_start_date = $notamsData['e_start_date'];
                $notams->e_end_date = $notamsData['e_end_date'];
                $notams->time = $notamsData['time'];
                $notams->decoded_qline = $notamsData['decoded_qline'];

                if (isset($notamsData['height'])) {
                    $notams->height = $notamsData['height'];
                    $notams->level = $notamsData['level'];
                }
                $tempRaw = explode('<br/>', $key->raw);
                array_splice($tempRaw, 1, 1);
                $tempRaw = implode("<br/>", $tempRaw);
                $desc_raw = explode("E)", $tempRaw);
                // echo $notamsData['notam_no']."<BR/>";
                if (sizeof($desc_raw) == 2) {
                    $tempDesc = explode("F)", $desc_raw[1]);
                    $tempDesc[0] = str_replace("<br/>", " ", $tempDesc[0]);
                    $desc_raw[1] = implode("F)", $tempDesc);
                    $notams->raw_data = implode("E)", $desc_raw);
                } else {
                    for ($i = 1; $i < sizeof($desc_raw); $i++) {
                        // $desc_raw[$i] = str_replace("<br/>", " ", explode("F)", $desc_raw[$i])[0]);
                        $tempDesc = explode("F)", $desc_raw[$i]);
                        $tempDesc[0] = str_replace("<br/>", " ", $tempDesc[0]);
                        $desc_raw[$i] = implode("F)", $tempDesc);
                    }
                    $notams->raw_data = implode("E)", $desc_raw);
                }

                $notams->icao = $key->icao;
                // $descriptionDelemiter="END ".substr($key->icao,5);
                // $notams->description = explode($descriptionDelemiter, $notamsData['description'])[0];
                $endPartPosition = strpos($notamsData['description'], "END PART");
                if ($endPartPosition) {
                    $notams->description = substr($notamsData['description'], 0, $endPartPosition);
                } else {
                    $notams->description = substr($notamsData['description'], 0);
                }
                $notamsData['aerodrome'] = substr($key->icao, 0, 4);
                $notams->aerodrome = $notamsData['aerodrome'];
                $notamsData['aerodrome'] = substr($key->icao, 0, 4);
                $notams->aerodrome = $notamsData['aerodrome'];
                if (NotamsModel::where('notam_no', $notams->notam_no)->where('aerodrome', $notams->aerodrome)->first() == false) {
                    $notams->save();
                    $this->newlyAdded++;
                } else if (strpos($key->icao, 'PART')) {
                    $previousDescription = NotamsModel::where('notam_no', $notams->notam_no)->where('aerodrome', $notams->aerodrome)->first()->description;
                    if (strpos($previousDescription, $notams->description) === false) {
                        $notams::updateDescription($previousDescription . " " . $notams->description, $notams->notam_no);
                    }
                    $notams::updatecancel($notams->notam_no, 0);
                } else {
                    $notams::updatecancel($notams->notam_no, 0);
                }
                array_push($notams_array, $notamsData);
            }
        }
        return $notams_array;
    }

    public function update_notams_description(Request $request) {
        $data = array("desc" => $request->desc);
        $data_string = json_encode($data);
        
        if (App::environment('local')) {
            $base_url = 'http://localhost:8080/navlogweb-ops/public/';
        }
        else{
            $base_url = 'http://notams.privateflight.co.in/';
        }

        $ch = curl_init($base_url . 'notams/update?id=' . $request->id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);
        $notams = new NotamsModel;
        $notams::updateDescription($request->desc, $request->id);
        return array('Status' => 'Success');
    }

    public function updatestatus(Request $request) {
        $notams = new NotamsModel;
        $notams::updatestatus($request->id, $request->status);
        return array('Status' => 'Success');
    }

    public function updateemailstatus(Request $request) {
        $notams = new NotamsModel;
        $notams::updateEmailStatus($request->id, $request->status);
        return array('Status' => 'Success');
    }

    public function api_notams_list_db(Request $request) {
        $id = $request->id;
        $notams = new NotamsModel;
        $result = $notams::getAll();
        foreach ($result as $key) {
            $start_date_formatted = date_create($key['e_start_date']);
            $start_date_formatted_ist = date_create($key['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $key['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $key['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($key['e_end_date']);
            $end_date_formatted_ist = date_create($key['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $key['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $key['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
        }
        $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $id)->first();
        $airport = ($stations) ? $stations->aero_name : '';

        return view('notams.display_list', ['airport' => $airport, 'notams_array' => $result]);
    }

    public function processNotamData($result, $code) {
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;
        $aerodrome_name = '';
        $lineCount = 0;
        $noOfRows = 0;
        $this->pageNumber = 1;
        $slno = 1;
        foreach ($result as $key) {
            $key['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 1, 2), 1)['signification'];
            $key['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 3, 2), 2)['signification'];

            if ($aerodrome_name != $key['aerodrome']) {
                $key['print_aerodrome'] = true;
                $aerodrome_name = $key['aerodrome'];
                $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $key['aerodrome'])->first();
                $key['aerodrome_name'] = ($stations) ? $stations->aero_name : '';
                $key['aerodrome_notam_count'] = $notams::getCountbyAerodrome($key['aerodrome']);
                $key['aerodrome_notam_count_email'] = NotamsModel::where('enable_email', '=', 1)->where('is_email_pending', '=', 1)->where('aerodrome', 'like', '%' . $key['aerodrome'] . '%')->count();
            } else {
                $key['print_aerodrome'] = false;
            }
            $start_date_formatted = date_create($key['e_start_date']);
            $start_date_formatted_ist = date_create($key['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $key['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $key['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($key['e_end_date']);
            $end_date_formatted_ist = date_create($key['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $key['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $key['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
            if ($key['is_daily']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'daily', $key['aerodrome']);
            } elseif ($key['is_weekly']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'weekly', $key['aerodrome']);
            } elseif ($key['is_date_specific']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'specificDate', $key['aerodrome']);
            } else {
                $key['formatted_time'] = " ";
            }
            // $key['formatted_time'] = trim($key['formatted_time']);

            $lineCount = $lineCount + round(strlen($key['description']) / 90) + 3;
            $noOfRows ++;
            if ($lineCount > 60 || $noOfRows > 10) {
                $lineCount = 0;
                $noOfRows = 0;
                $this->pageNumber++;
            }
            $key['line_count'] = $lineCount;
            $key['no_of_rows'] = $noOfRows;
            $key['sl_no'] = $slno;
            $slno++;
        }
        $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $code)->first();
        $airport = ($stations) ? strtoupper($code) . ' (' . $stations->aero_name . ') ' : '';

        return array('result' => $result, 'airport' => $airport, 'aero_code' => $code,);
    }

    public function fplnotamsfilter(Request $request) {
        $notams = new NotamsModel;

        $date1 = date_create("20" . $request->startDateFmt);
        $date2 = date_create("20" . $request->endDateFmt);
        $diff = date_diff($date1, $date2);
        $notamDatesArr = array(date_format($date1, "d-m-Y"));

        for ($i = 0; $i < $diff->format("%a"); $i++) {
            date_add($date1, date_interval_create_from_date_string("1 days"));
            array_push($notamDatesArr, date_format($date1, "d-m-Y"));
        }
        $resultArr = [];
        $airportCodesArr = explode(',', strtoupper($request->airportcode));
        $notamNumber = $request->notamNumber;
        $routeNotams = $request->routeNotams;
        $notamCategoryArr = array($request->notamCategory);
        $fromdate = date_format(date_create("20" . $request->startDateFmt), 'Y-m-d');
        $todate = date_format(date_create("20" . $request->endDateFmt), 'Y-m-d');
        $startTime = $request->startTime;
        $endTime = $request->endTime;
        $dateStartTime = date_create($request->startTime);
        $dateEndTime = date_create($request->endTime);
        if ($notamCategoryArr == "") {
            $notamCategoryArr = array();
        }
        $i = 0;
        foreach ($airportCodesArr as $aero_code) {
            if ($i == 0) {
                if (sizeof($this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, date("Hi", strtotime("+240 minutes", strtotime($startTime))), $notamDatesArr, $notams, "fpl")) > 0) {
                    array_push($resultArr, $this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, date("Hi", strtotime("+240 minutes", strtotime($startTime))), $notamDatesArr, $notams, "fpl")[0]);
                }
            }
            if ($i == 1) {
                $arrStartTime = date("Hi", strtotime("-240 minutes", strtotime($endTime)));
                $arrEndTime = date("Hi", strtotime("-60 minutes", strtotime($endTime)));
                if (sizeof($this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $arrStartTime, $arrEndTime, $notamDatesArr, $notams, "fpl")) > 0) {
                    array_push($resultArr, $this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $arrStartTime, $arrEndTime, $notamDatesArr, $notams, "fpl")[0]);
                }
            }
            if ($i > 1 && $aero_code[3] != "F") {
                $altnStartTime = date("Hi", strtotime("-180 minutes", strtotime($endTime)));
                if (sizeof($this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $altnStartTime, $endTime, $notamDatesArr, $notams, "fpl")) > 0) {
                    array_push($resultArr, $this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $altnStartTime, $endTime, $notamDatesArr, $notams, "fpl")[0]);
                }
            }
            if ($aero_code[3] == "F") {
                if (sizeof($this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr, $notams, "fpl")) > 0) {
                    array_push($resultArr, $this->getdataFromDb(array($aero_code), $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr, $notams, "fpl")[0]);
                }
            }
            $i++;
        }

        return ['notams_array' => $resultArr, 'status' => 'success'];
    }

    public function filter(Request $request) {
        $date1 = date_create("20" . $request->startDateFmt);
        $date2 = date_create("20" . $request->endDateFmt);
        $diff = date_diff($date1, $date2);
        $notamDatesArr = array(date_format($date1, "d-m-Y"));

        for ($i = 0; $i < $diff->format("%a"); $i++) {
            date_add($date1, date_interval_create_from_date_string("1 days"));
            array_push($notamDatesArr, date_format($date1, "d-m-Y"));
        }


        $resultArr = [];
        $val = array();
        $notams = new NotamsModel;
        if (!$request->advance_search) {
            $airportCodesArr = explode(',', strtoupper($request->airportcode));
        } else {
            $airportCodesArr = $this->nearestAerodrome($request->airportcode, $request->radius);
            // print_r($airportCodesArr);
        }


        $notamNumber = $request->notamNumber;
        $routeNotams = $request->routeNotams;
        $notamCategoryArr = array($request->notamCategory);
        $fromdate = date_format(date_create("20" . $request->startDateFmt), 'Y-m-d');
        $todate = date_format(date_create("20" . $request->endDateFmt), 'Y-m-d');
        $startTime = $request->startTime;
        $endTime = $request->endTime;
        $dateStartTime = date_create($request->startTime);
        $dateEndTime = date_create($request->endTime);
        if ($request->timeFormat == 'ist') {
            // $startTime = date_format(date_add($dateStartTime, date_interval_create_from_date_string("-330 minutes")),'Hi');
            // $endTime = date_format(date_add($dateEndTime, date_interval_create_from_date_string("-330 minutes")),'Hi');
        }

        if ($notamCategoryArr == "") {
            $notamCategoryArr = array();
        }
        $resultArr = $this->getdataFromDb($airportCodesArr, $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr, $notams, "filter");

        return ['notams_array' => $resultArr, 'status' => 'success'];
    }

    public function getdataFromDb($airportCodesArr, $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr, $notams, $from) {
        $resultArr = [];
        if ($from == "fpl") {
            $result = $notams::filterNotamsDataFpl($airportCodesArr, $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr);
        } else {
            $result = $notams::filterNotamsData($airportCodesArr, $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr);
        }

        // print_r(sizeof($result));
        $val = array();

        for ($i = 0; $i < sizeof($result); $i++) {

            if (isset($val[$result[$i]->aerodrome])) {
                array_push($val[$result[$i]->aerodrome], $result[$i]);
            } else {
                $val[$result[$i]->aerodrome] = array();
                array_push($val[$result[$i]->aerodrome], $result[$i]);
            }
        }
        foreach ($val as $key => $value) {
            if (sizeof($airportCodesArr) == 1 && $airportCodesArr[0] == "") {
                $data = array('aero_code' => $key, 'airport' => '', 'result' => $value);
                array_push($resultArr, $this->processNotamData($value, $key));
            } else {
                $data = array('aero_code' => $key, 'airport' => '', 'result' => $value);
                $resultArr[array_search(strtoupper($key), $airportCodesArr)] = $this->processNotamData($value, $key);
            }
        }
        return $resultArr;
    }

    public function combinedTimeForNotam($notam_no, $type, $aerodrome) {
        $weekDaysShortName = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
        $monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $sameTimingWeekDays = array();
        $notams = new NotamsModel;
        $res = $notams::getNotamByNum($notam_no, $aerodrome);
        $formatted_time = array();
        foreach ($res as $key) {
            if ($type == 'daily') {
                if (($key['start_time'] == "0000" || $key['start_time'] == "0001") && $key['end_time'] == "2359") {
                    $formatted_timeObj = array('notam_id' => $key->id, "time" => "24 Hours");
                } else {
                    $formatted_timeObj = array('notam_id' => $key->id, "time" => $key['start_time'] . "-" . $key['end_time'] . " UTC (" . date('Hi', strtotime($key['start_time'] . '+330 minute')) . "-" . date('Hi', strtotime($key['end_time'] . '+330 minute')) . " IST) ");
                }
                array_push($formatted_time, $formatted_timeObj);
            } elseif ($type == 'weekly') {

                $WeekDaysTiming = array();
                for ($i = 0; $i < 7; $i++) {
                    $keyNameStart = $weekDaysShortName[$i] . "_start_time";
                    $keyNameEnd = $weekDaysShortName[$i] . "_end_time";
                    if ($key[$keyNameStart]) {
                        $WeekDaysTiming[$weekDaysShortName[$i]] = $key[$keyNameStart] . "-" . $key[$keyNameEnd] . " UTC (" . date('Hi', strtotime($key[$keyNameStart] . '+330 minute')) . "-" . date('Hi', strtotime($key[$keyNameEnd] . '+330 minute')) . " IST) ";
                    }
                }

                foreach ($WeekDaysTiming as $key1 => $value) {
                    foreach ($WeekDaysTiming as $key2 => $value1) {
                        if ($value1 == $value) {
                            if (isset($sameTimingWeekDays[$value1]['time'])) {
                                if (strpos($sameTimingWeekDays[$value]['time'], $key1) === false) {
                                    $sameTimingWeekDays[$value1]['time'] = $sameTimingWeekDays[$value1]['time'] . "," . $key1;
                                }
                            } else {
                                $formatted_timeObj = array('notam_id' => $key->id, "time" => $key1);
                                $sameTimingWeekDays[$value1] = $formatted_timeObj;
                            }
                        }
                    }
                }
            } elseif ($type == 'specificDate') {
                $notam_dates = explode(',', $key['notam_dates']);
                $grpdNotamNumbers = array();

                for ($i = 0; $i < sizeof($notam_dates); $i++) {
                    $notam_dates[$i] = substr($notam_dates[$i], 0, 5);
                    if (isset($grpdNotamNumbers[substr($notam_dates[$i], 3, 5)])) {
                        array_push($grpdNotamNumbers[substr($notam_dates[$i], 3, 5)], substr($notam_dates[$i], 0, 2));
                    } else {
                        $grpdNotamNumbers[substr($notam_dates[$i], 3, 5)] = array();
                        array_push($grpdNotamNumbers[substr($notam_dates[$i], 3, 5)], substr($notam_dates[$i], 0, 2));
                    }
                }
                $availableDates = "";
                // print_r($grpdNotamNumbers);
                // echo "<br/>";
                foreach ($grpdNotamNumbers as $monthkey => $value) {
                    $value = join(',', $value);

                    if (intval($monthkey) != 0) {
                        $availableDates = $availableDates ."". $monthNames[intval($monthkey) - 1] . " : " . $value."\n";
                    }
                }
                $formatted_timeObj = array('notam_id' => $key->id, "time" => $key['datespecific_start_time'] . "-" . $key['datespecific_end_time'] . " UTC (" . date('Hi', strtotime($key['datespecific_start_time'] . '+330 minute')) . "-" . date('Hi', strtotime($key['datespecific_end_time'] . '+330 minute')) . " IST) " . $availableDates);
                array_push($formatted_time, $formatted_timeObj);
            }
        }

        if ($type == 'daily') {
            return $formatted_time;
        } elseif ($type == 'weekly') {
            // print_r($sameTimingWeekDays);
            // echo "<br/>";
            foreach ($sameTimingWeekDays as $key => $value) {
                $formatted_timeObj = array('notam_id' => $value['notam_id'], "time" => strtoupper($value['time']) . "  -  " . strtoupper($key));

                array_push($formatted_time, $formatted_timeObj);
            }

            return $formatted_time;
        } else {
            return $formatted_time;
        }
    }

    public function download(Request $request) {
        ini_set('max_execution_time', 300);
        $id = $request->id;
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;
        $date1 = date_create("20" . $request->startDateFmt);
        $date2 = date_create("20" . $request->endDateFmt);
        $diff = date_diff($date1, $date2);
        $notamDatesArr = array(date_format($date1, "d-m-Y"));

        for ($i = 0; $i < $diff->format("%a"); $i++) {
            date_add($date1, date_interval_create_from_date_string("1 days"));
            array_push($notamDatesArr, date_format($date1, "d-m-Y"));
        }

        // $result = $notams::getDataForPDF("%" . $request->id . "%");
        $this->pageNumber = 0;
        $total_page_number = 0;
        $resultArr = array();
        $airportCodesArr = explode(',', $request->airportcode);
        $notamNumber = $request->notamNumber;
        $routeNotams = $request->routeNotams;
        $notamCategoryArr = array($request->notamCategory);
        $fromdate = date_format(date_create("20" . $request->startDateFmt), 'Y-m-d');
        $todate = date_format(date_create("20" . $request->endDateFmt), 'Y-m-d');
        $startTime = $request->startTime;
        $endTime = $request->endTime;
        $dateStartTime = date_create($request->startTime);
        $dateEndTime = date_create($request->endTime);
        if ($request->timeFormat == 'ist') {
            // $startTime = date_format(date_add($dateStartTime, date_interval_create_from_date_string("-330 minutes")),'Hi');
            // $endTime = date_format(date_add($dateEndTime, date_interval_create_from_date_string("-330 minutes")),'Hi');
        }
        if (isset($id)) {
            $airportCodesArr = array($id);
        }
        for ($i = 0; $i < sizeof($airportCodesArr); $i++) {
            if ($notamCategoryArr == "") {
                $notamCategoryArr = array();
            }

            if ($airportCodesArr[$i] != "") {
                $result = $notams::getDataForPDF("%" . $airportCodesArr[$i] . "%", $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr, $startTime, $endTime, $notamDatesArr);
                array_push($resultArr, $this->processNotamData($result, $airportCodesArr[$i]));
                $total_page_number = $total_page_number + $this->pageNumber;
            }
        }




        $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $id)->first();
        $airport = ($stations) ? $id . ' (' . $stations->aero_name . ') ' : '';
        $filePath = public_path('media/pdf/notams/');
        date_default_timezone_set('Asia/Kolkata');
        if (isset($id)) {
            $fileName = strtoupper($id) . ' NOTAMS AS ON  ' . date('d-M-Y Hi') . ' IST.pdf';
            // $notams_pdf_content_new = view('emails.pdf.filtered_notam', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number]);
            $notams_pdf_content_new = view('emails.pdf.filtered_notam_new_design', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number, 'airportCodesArr' => $airportCodesArr, 'type' => 'individual']);
        } else {
            $fileName = 'NOTAMS FILTERED ' . strtoupper($id) . ' ' . date('d-M-Y') . ' DOWNLOADED ' . date('Hi') . ' IST.pdf';
            // $notams_pdf_content_new = view('emails.pdf.filtered_notam', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number]);
            if (isset($request->isPackage) && $request->isPackage = 1) {
                $notams_pdf_content_new = view('emails.pdf.filtered_notam_new_design', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number, 'airportCodesArr' => $airportCodesArr, 'type' => 'package','callsign'=>$request->callsign,'dof'=>$request->dof]);
            } else {
                $notams_pdf_content_new = view('emails.pdf.filtered_notam_new_design', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number, 'airportCodesArr' => $airportCodesArr, 'type' => 'individual']);
            }
        }
        // $notams_pdf_content = view('emails.display_list_report', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number]);
        // $notams_pdf_content_new = view('emails.pdf.filtered_notam', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number]);
        // $notams_pdf_content_new = view('emails.pdf.filtered_notam_new_design', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y'), 'total_page_number' => $total_page_number]);
        
        // delete previous files
        $files = glob(public_path('media/pdf/notams/*')); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
        // end 

        $this->pageNumber = 0;
        $pdf = PDF::loadHTML($notams_pdf_content_new)
                ->setPaper('a4', 'portrait')
                ->save($filePath . $fileName);
        $path = $filePath . $fileName;
        return response()->download($path);
        // return $notams_pdf_content_new;
    }

    public function nearestAerodrome($aero_code, $radius) {

        $requestAerodrome = StationsModel::where('aero_id', $aero_code)->first();
        $aerodrome_list = StationsModel::where('aero_id', '!=', 'ZZZZ')->where('aero_latlong', '!=', '')->get();
        $aerodromeWithBound = array();
        // echo $requestAerodrome->aero_latlong;
        foreach ($aerodrome_list as $value) {

            $distance = $this->distanceBetweenLatLong($requestAerodrome->aero_latlong, $value->aero_latlong);
            if ($distance <= $radius) {
                array_push($aerodromeWithBound, $value->aero_id);
            }
        }
        return $aerodromeWithBound;
    }

    public function distanceBetweenLatLong($cord1, $cord2) {
        $lat1 = $this->dmsToDecimal($cord1)[0];
        $lon1 = $this->dmsToDecimal($cord1)[1];
        $lat2 = $this->dmsToDecimal($cord2)[0];
        $lon2 = $this->dmsToDecimal($cord2)[1];

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515 * 0.8684;
        return round($miles);
    }

    public function dmsToDecimal($cord) {
        $latDms = explode("N", $cord)[0];
        $lngDms = explode("E", explode("N", $cord)[1])[0];
        $degreeLat = substr($latDms, 0, 2);
        $degreeLng = substr($lngDms, 1, 2);
        $minutesLat = substr($latDms, 2, 2);
        $minutesLng = substr($lngDms, 3, 2);
        // var degree = parseInt(cord.slice(0, 2));
        //     var minutes = parseInt(cord.slice(2, 4));
        //     var seconds = parseInt(cord.slice(4, 6));
        //     var decimalOp = degree + (minutes / 60) + (seconds / 3600);
        $decimalLat = $degreeLat + ($minutesLat / 60);
        $decimalLng = $degreeLng + ($minutesLng / 60);
        return array($decimalLat, $decimalLng);
    }

    public function sendNotamEmails() {
        $email_data_unique = NotamsModel::where('enable_email', '=', 1)->where('is_email_pending', '=', 1)->groupBy('aerodrome')->get(['aerodrome']);
        $emailArr = array();

        foreach ($email_data_unique as $key) {
            $users = FavouritesNotamsModel::getNotamUsersByAerodrome($key['aerodrome']);
            foreach ($users as $user) {
                if (isset($emailArr[$user['email']])) {
                    array_push($emailArr[$user['email']], $key['aerodrome']);
                } else {
                    $emailArr[$user['email']] = array();
                    array_push($emailArr[$user['email']], $key['aerodrome']);
                }
            }
        }

        // print_r($emailArr);

        foreach ($emailArr as $key => $value) {
            $res = NotamsModel::where('enable_email', '=', 1)->where('is_email_pending', '=', 1)->whereIn('aerodrome', $value)->orderBy('aerodrome')->get();
            $fmt_data = $this->processNotamData($res, 'NA');
            $notam_count = count($fmt_data['result']);
            $subject = $notam_count . " NEW NOTAM NOTIFICATION // " . date('d-M-Y');
            $filePath = public_path('media/pdf/notams/');
            $fileName = "NEW NOTAMS " . date('d-M-Y') . ".pdf";

            $view_variable = view('emails.pdf.new_notams_pdf', array('data' => $fmt_data));
            $pdf = PDF::loadHTML($view_variable)
                    ->setPaper('a4', 'portrait')
                    ->save($filePath . $fileName);
            $path = $filePath . $fileName;
            Mail::send('emails.notams.new_notam_notification', array(), function($message) use($subject, $key, $path, $fileName) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                $message->to("praveenkmr.t@gmail.com");
                // $message->to("praveen@sensomate.com");
                $message->cc("prem@eflight.aero");

                $message->attach($path, array(
                    'as' => $fileName,
                    'mime' => 'application/pdf'));

                // $message->cc("prem@eflight.aero");
                // $message->bcc($key);
            });
        }

        return "OK";
    }

    public function remainderEmail(Request $request) {
        date_default_timezone_set('Asia/Kolkata');
        $id = $request->id;
        // 9 am, 12 noon, 3 pm, 6 pm, 9 pm, 11.30 pm, 3.30 am
        $notamUpdateCycle = array("4 am to 9 am","9 am to 11 am", "12pm to 2pm", "3pm to 5pm ","6pm to 8pm ","9pm to 11pm ", "11pm to 4 am ");
        $notamUpdateCycleStartTime = array("0900", "1200", "1600", "2200");
        $subject = "NOTAM UPDATE REMINDER " . date('d-m-Y') . " : " . $notamUpdateCycle[$id];
        $cur_date = date('d-m-Y');

        $lastInsertedVIData = NotamsModel::where("aerodrome", "like", "%VI%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        $lastInsertedVAData = NotamsModel::where("aerodrome", "like", "%VA%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        $lastInsertedVEData = NotamsModel::where("aerodrome", "like", "%VE%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];
        $lastInsertedVOData = NotamsModel::where("aerodrome", "like", "%VO%")->orderBy("updated_at", "desc")->first(['updated_at'])['updated_at'];

        $VIdate = date_create($lastInsertedVIData->toDateTimeString());
        date_add($VIdate, date_interval_create_from_date_string("330 minutes"));

        $VAdate = date_create($lastInsertedVAData->toDateTimeString());
        date_add($VAdate, date_interval_create_from_date_string("330 minutes"));

        $VEdate = date_create($lastInsertedVEData->toDateTimeString());
        date_add($VEdate, date_interval_create_from_date_string("330 minutes"));

        $VOdate = date_create($lastInsertedVOData->toDateTimeString());
        date_add($VOdate, date_interval_create_from_date_string("330 minutes"));

        $thresholdDate = date_create($notamUpdateCycleStartTime[$id]);
        if ($id == 6) {
            date_add($thresholdDate, date_interval_create_from_date_string("-1 days"));
        }
        $diffVO = date_diff($thresholdDate, $VOdate);
        $diffVI = date_diff($thresholdDate, $VIdate);
        $diffVE = date_diff($thresholdDate, $VEdate);
        $diffVA = date_diff($thresholdDate, $VAdate);
        
        $missedRegions= ($diffVI->invert==1)?'VIDF':'';
        $missedRegions= $missedRegions .",".(($diffVO->invert==1)?'VOMF':'');
        $missedRegions= $missedRegions .",".(($diffVE->invert==1)?'VECF':'');
        $missedRegions= $missedRegions .",".(($diffVA->invert==1)?'VABF':'');
        if ($diffVI->invert == 1 || $diffVO->invert == 1 || $diffVE->invert == 1 || $diffVA->invert == 1) {
            Mail::send('emails.notam_remainder', array("cycle" => $notamUpdateCycle[$id], "cur_date" => $cur_date,"type"=>"upload","regions"=>$missedRegions), function($message) use($subject) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                $message->to("ops@eflight.aero");
                $message->cc("prem@eflight.aero");
                $message->cc("sumit.kumar@pravahya.com");
                $message->bcc("praveenkmr.t@gmail.com");
            });
            return "Email send";
        }

        return "Not send";
    }

    public function updatelasttime(Request $request) {
        $data = NotamsModel::where("aerodrome", "like", "%" . $request->fir . "%")->orderBy("updated_at", "desc")->first();
        // return $data->aerodrome;
        $updatedVal = NotamsModel::where("id", "=", $data->id)
                ->update(['aerodrome' => $data->aerodrome]);
        return $updatedVal;
    }

    public function uploadxls(Request $request) {
        ini_set('max_execution_time', 300);
        $this->newlyAddedNotamCount = 0;
        $newNotamsInfo = array();

        Excel::load($request->file('file'), function($reader) use($newNotamsInfo) {
            $results = $reader->get();
            foreach ($results as $key) {
                if (NotamsModel::where('id', $key['id'])->where('notam_no', $key['notam_no'])->where('aerodrome', $key['aerodrome'])->first() == false) {
                    $notams_server = new NotamsModel;
                    $notams_server->id = $key['id'];
                    $notams_server->notam_no = $key['notam_no'];
                    $notams_server->notam_type = $key['notam_type'];
                    $notams_server->q_line = $key['q_line'];
                    $notams_server->decoded_qline = $key['decoded_qline'];
                    $notams_server->aerodrome = $key['aerodrome'];
                    $notams_server->e_start_date = $key['e_start_date'];
                    $notams_server->e_end_date = $key['e_end_date'];
                    $notams_server->description = $key['description'];
                    $notams_server->time = $key['time'];
                    $notams_server->start_time = $key['start_time'];
                    $notams_server->end_time = $key['end_time'];
                    $notams_server->datespecific_start_time = $key['datespecific_start_time'];
                    $notams_server->datespecific_end_time = $key['datespecific_end_time'];
                    $notams_server->sun_start_time = $key['sun_start_time'];
                    $notams_server->sun_end_time = $key['sun_end_time'];
                    $notams_server->mon_start_time = $key['mon_start_time'];
                    $notams_server->mon_end_time = $key['mon_end_time'];
                    $notams_server->tue_start_time = $key['tue_start_time'];
                    $notams_server->tue_end_time = $key['tue_end_time'];
                    $notams_server->wed_start_time = $key['wed_start_time'];
                    $notams_server->wed_end_time = $key['wed_end_time'];
                    $notams_server->thu_start_time = $key['thu_start_time'];
                    $notams_server->thu_end_time = $key['thu_end_time'];
                    $notams_server->fri_start_time = $key['fri_start_time'];
                    $notams_server->fri_end_time = $key['fri_end_time'];
                    $notams_server->sat_start_time = $key['sat_start_time'];
                    $notams_server->sat_end_time = $key['sat_end_time'];
                    $notams_server->notam_dates = $key['notam_dates'];
                    $notams_server->height = $key['height'];
                    $notams_server->level = $key['level'];
                    $notams_server->raw_data = $key['raw_data'];
                    $notams_server->icao = $key['icao'];
                    $notams_server->is_primary = $key['is_primary'];
                    $notams_server->is_daily = $key['is_daily'];
                    $notams_server->is_weekly = $key['is_weekly'];
                    $notams_server->is_date_specific = $key['is_date_specific'];
                    $notams_server->is_active = 0;
                    $notams_server->is_delete = $key['is_delete'] || 0;
                    $notams_server->enable_email = $key['enable_email'] || 0;
                    $notams_server->is_updated = $key['is_updated'];
                    if ($key['enable_email'] == 1) {
                        $notams_server->is_email_pending = 1;
                    } else {
                        $notams_server->is_email_pending = 0;
                    }
                    $notams_server->save();
                    if ($key['is_primary'] == 1) {
                        $this->newlyAddedNotamCount++;
                    }


                    if (isset($newNotamsInfo[$key->aerodrome])) {
                        array_push($newNotamsInfo[$key->aerodrome], $key);
                    } else {
                        $newNotamsInfo[$key->aerodrome] = array();
                        array_push($newNotamsInfo[$key->aerodrome], $key);
                    }
                    // array_push($newNotamsInfo, $key);
                } else {
                    NotamsModel::where('id', $key['id'])->where('notam_no', $key['notam_no'])->where('aerodrome', $key['aerodrome'])
                            ->update(array('q_line' => $key['q_line'],
                                'decoded_qline' => $key['decoded_qline'],
                                'e_start_date' => $key['e_start_date'],
                                'e_end_date' => $key['e_end_date'],
                                'description' => $key['description'],
                                'time' => $key['time'],
                                'start_time' => $key['start_time'],
                                'end_time' => $key['end_time'],
                                'datespecific_start_time' => $key['datespecific_start_time'],
                                'datespecific_end_time' => $key['datespecific_end_time'],
                                'sun_start_time' => $key['sun_start_time'],
                                'sun_end_time' => $key['sun_end_time'],
                                'mon_start_time' => $key['mon_start_time'],
                                'mon_end_time' => $key['mon_end_time'],
                                'tue_start_time' => $key['tue_start_time'],
                                'tue_end_time' => $key['tue_end_time'],
                                'wed_start_time' => $key['wed_start_time'],
                                'wed_end_time' => $key['wed_end_time'],
                                'thu_start_time' => $key['thu_start_time'],
                                'thu_end_time' => $key['thu_end_time'],
                                'fri_start_time' => $key['fri_start_time'],
                                'fri_end_time' => $key['fri_end_time'],
                                'sat_start_time' => $key['sat_start_time'],
                                'sat_end_time' => $key['sat_end_time'],
                                'notam_dates' => $key['notam_dates'],
                                'is_daily' => $key['is_daily'],
                                'is_weekly' => $key['is_weekly'],
                                'is_date_specific' => $key['is_date_specific'],
                                'height' => $key['height'],
                                'level' => $key['level'],
                                'raw_data' => $key['raw_data'],
                                'icao' => $key['icao'],
                                // 'is_active' => $key['is_active'],
                                'is_delete' => $key['is_delete'],
                                'is_updated' => 0,
                                'is_update_skipped' => 0,
                                // 'enable_email' => $key['enable_email'],
                                'updated_at' => $key['updated_at']));
                }
            }
            $this->email_data = NotamsModel::where('enable_email', '=', 1)->where('is_email_pending', '=', 1)->get();

            // $this->sendNotamEmails();
            // NotamsModel::where('enable_email', '=', 1)->update(array("enable_email" => 0, "is_email_pending" => 0));
        });
        return array('Message' => 'Success', 'newlyAdded' => $this->newlyAddedNotamCount, 'email' => $this->email_data);
    }

    public function exportXls(Request $request) {
        $notams = new NotamsModel;
        $result = $notams::getByAerodrome("%" . $request->id . "%");
        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');

        $fileName = (@$region[$request->id]) . " Notams download on " . date('Hi') . " of " . date('d-M-y');
        Excel::create($fileName, function($excel) use ($result) {
            $excel->sheet('notam_sheet', function($sheet) use ($result) {
                $sheet->fromModel($result);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    public function api_notams_list(Request $request) {
        $id = $request->id;
        if (!isset($id)) {
            return view('notams.display_list', ['status' => 'success']);
        }
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;

        $result = $notams::getByAerodrome("%" . $request->id . "%");
        foreach ($result as $key) {
            $key['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 1, 2), 1)['signification'];
            $key['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 3, 2), 2)['signification'];

            $start_date_formatted = date_create($key['e_start_date']);
            $start_date_formatted_ist = date_create($key['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $key['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $key['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($key['e_end_date']);
            $end_date_formatted_ist = date_create($key['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $key['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $key['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
        }

        $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $id)->first();
        $airport = ($stations) ? $id . ' (' . $stations->aero_name . ') ' : '';

        return view('notams.display_list', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id]);
    }

    public function appendIst($time) {
        $time = str_replace("<br/>", " ", $time);
        if (strpos($time, "H24") !== false)
            return "24 hours";
        // temp code for fix ss issue
        if (strpos($time, "SS") !== false)
            return $time;
        // end
        preg_match_all('!\d+!', $time, $matches);
        $matchesMaster = $matches;
        if (sizeof($matches[0]) == 0) {
            return $time;
        }

        for ($i = 0; $i < sizeof($matches[0]); $i = $i + 2) {
            if (strlen($matches[0][$i]) != 4) {
                $i--;
                continue;
            }
            $dateTime1 = mktime(substr($matches[0][$i], 0, 2), substr($matches[0][$i], 2, 2));
            $matches[0][$i] = date("Hi", strtotime('+5 hours 30 minutes', $dateTime1));

            if (isset($matches[0][$i + 1])) {
                if (strlen($matches[0][$i + 1]) != 4) {
                    return $time;
                }
                $dateTime2 = mktime(substr($matches[0][$i + 1], 0, 2), substr($matches[0][$i + 1], 2, 2));
                $matches[0][$i + 1] = date("Hi", strtotime('+5 hours 30 minutes', $dateTime2));
                $time = substr_replace($time, " UTC (" . $matches[0][$i] . "-" . $matches[0][$i + 1] . " IST) ", (strpos($time, $matchesMaster[0][$i + 1]) + 4), 0);
            } else {
                $time = substr_replace($time, " UTC (" . $matches[0][$i] . " IST) ", (strpos($time, $matchesMaster[0][$i]) + 9), 0);
            }
        }

        return $time;
    }

    public function findNotamCount($data, $aerodrome) {
        $count = 0;
        foreach ($data as $key) {
            if ($key['aerodrome'] == $aerodrome) {
                $count++;
            }
        }
        return $count;
    }

    public function getCategorylist() {
        $categoryList = array();
        $result = NotamsModel::select('decoded_qline')->distinct()->orderBy('decoded_qline', 'asc')->get();
        foreach ($result as $key) {
            array_push($categoryList, trim($key->decoded_qline));
        }
        return $categoryList;
    }

    public function getrecentnotam(Request $request) {
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;

        $id = $request->id;
        $count = $request->count;

        $result = $notams::getLastInsertedNotams("%" . $id . "%", $count);
        $result = $result->sortByDesc('aerodrome');

        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');
        $aerodrome_name = '';
        foreach ($result as $key) {
            $key['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 1, 2), 1)['signification'];
            $key['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 3, 2), 2)['signification'];

            if ($aerodrome_name != $key['aerodrome']) {
                $key['print_aerodrome'] = true;
                $aerodrome_name = $key['aerodrome'];
                $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $key['aerodrome'])->first();
                $key['aerodrome_name'] = ($stations) ? $stations->aero_name : '';
                $key['aerodrome_notam_count'] = $this->findNotamCount($result, $key['aerodrome']);
            } else {
                $key['print_aerodrome'] = false;
            }

            $start_date_formatted = date_create($key['e_start_date']);
            $start_date_formatted_ist = date_create($key['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $key['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $key['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($key['e_end_date']);
            $end_date_formatted_ist = date_create($key['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $key['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $key['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");

            if ($key['is_daily']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'daily', $key['aerodrome']);
            } elseif ($key['is_weekly']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'weekly', $key['aerodrome']);
            } elseif ($key['is_date_specific']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'specificDate', $key['aerodrome']);
            } else {
                $key['formatted_time'] = " ";
            }
            // if($key['notam_no']=="A0306/17 "){
            //     print_r($key['formatted_time']);
            //     echo "<br/>";
            // }
            // $key['formatted_time'] = trim($key['formatted_time']);
        }
        $airport = @$region[strtolower($id)] || 'NA';
        return view('notams.display_list_fir', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id]);

        return $result;
    }

    public function expiredNotams() {
        $notams = new NotamsModel;
        $data = $notams::where('e_end_date', '<', date('Y-m-d'))->orderBy('e_end_date')->get();

        foreach ($data as $key) {
            $notams::where('id', '=', $key['id'])->delete();
        }
    }

    public function display_notams() {
        $data = DB::table('notam_info')->orderBy('notam_no')->orderBy('aerodrome')->get();
        echo "<table border='1' width='100%'>";
        foreach ($data as $value) {
            echo "<tr>";
            // foreach ($value as $val) {
            echo "<td>" . $value->notam_no . "</td>";
            echo "<td>" . $value->aerodrome . "</td>";
            echo "<td>" . $value->is_primary . "</td>";
            echo "<td>" . $value->description . "</td>";
            echo "<td>" . $value->raw_time . "</td>";
            // }
            echo "</tr>";
        }
        echo "</table>";
    }

    public function update_pending_view(Request $request) {
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;

        $id = $request->id;

        $result = $notams::getUpdatePendingNotams("%" . $id . "%");
        $result = $result->sortByDesc('aerodrome');

        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');
        $aerodrome_name = '';
        foreach ($result as $key) {
            $key['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 1, 2), 1)['signification'];
            $key['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 3, 2), 2)['signification'];

            if ($aerodrome_name != $key['aerodrome']) {
                $key['print_aerodrome'] = true;
                $aerodrome_name = $key['aerodrome'];
                $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $key['aerodrome'])->first();
                $key['aerodrome_name'] = ($stations) ? $stations->aero_name : '';
                $key['aerodrome_notam_count'] = $this->findNotamCount($result, $key['aerodrome']);
            } else {
                $key['print_aerodrome'] = false;
            }

            $start_date_formatted = date_create($key['e_start_date']);
            $start_date_formatted_ist = date_create($key['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $key['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $key['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($key['e_end_date']);
            $end_date_formatted_ist = date_create($key['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $key['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $key['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
            if ($key['is_daily']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'daily', $key['aerodrome']);
            } elseif ($key['is_weekly']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'weekly', $key['aerodrome']);
            } elseif ($key['is_date_specific']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'specificDate', $key['aerodrome']);
            } else {
                $key['formatted_time'] = " ";
            }

            // $key['formatted_time'] = trim($key['formatted_time']);
        }
        $airport = @$region[strtolower($id)] || 'NA';
        return view('notams.display_list_fir', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id]);
    }

    public function getnotambyfir(Request $request) {
        $id = $request->id;
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;

        $result = $notams::getByAerodrome("%" . $id . "%");
        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');
        $aerodrome_name = '';
        foreach ($result as $key) {
            $key['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 1, 2), 1)['signification'];
            $key['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 3, 2), 2)['signification'];
            // $key['qline']=explode('/',$key['q_line'])[1];

            if ($aerodrome_name != $key['aerodrome']) {
                $key['print_aerodrome'] = true;
                $aerodrome_name = $key['aerodrome'];
                $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $key['aerodrome'])->first();
                $key['aerodrome_name'] = ($stations) ? $stations->aero_name : '';
                $key['aerodrome_notam_count'] = $notams::getCountbyAerodrome($key['aerodrome']);
            } else {
                $key['print_aerodrome'] = false;
            }

            $start_date_formatted = date_create($key['e_start_date']);
            $start_date_formatted_ist = date_create($key['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $key['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $key['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            $end_date_formatted = date_create($key['e_end_date']);
            $end_date_formatted_ist = date_create($key['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $key['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $key['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $key['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");

            if ($key['is_daily']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'daily', $key['aerodrome']);
            } elseif ($key['is_weekly']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'weekly', $key['aerodrome']);
            } elseif ($key['is_date_specific']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'specificDate', $key['aerodrome']);
            } else {
                $key['formatted_time'] = " ";
            }

            // $key['formatted_time'] = trim($key['formatted_time']);
        }

        $airport = $region[strtolower($id)];
        return view('notams.display_list_fir', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id]);
    }

    public function notam_fetch_ui(Request $request) {
        $notams = new NotamsModel;
        $lastUpdatedTime = array('va' => $this->convertDateFormat($notams::getLastupdateTime('va%')->updated_at),
            've' => $this->convertDateFormat($notams::getLastupdateTime('ve%')->updated_at),
            'vi' => $this->convertDateFormat($notams::getLastupdateTime('vi%')->updated_at),
            'vo' => $this->convertDateFormat($notams::getLastupdateTime('vo%')->updated_at));
        return view('notams.airport_list', $lastUpdatedTime);
    }

    public function notam_upload_ui(Request $request) {
        $notams = new NotamsModel;
        $lastUpdatedTime = array('va' => $this->convertDateFormat($notams::getLastupdateTime('va%')->updated_at),
            've' => $this->convertDateFormat($notams::getLastupdateTime('ve%')->updated_at),
            'vi' => $this->convertDateFormat($notams::getLastupdateTime('vi%')->updated_at),
            'vo' => $this->convertDateFormat($notams::getLastupdateTime('vo%')->updated_at));
        return view('notams.uploadnotamsui', $lastUpdatedTime);
    }

    public function convertDateFormat($date) {
        if ($date == 'NA')
            return $date;
        else
            return date_format($date, "d-M-Y H:i:s");
    }

    public function getNotamCountForAirport(Request $request) {
        $notams = new NotamsModel;
        return $notams::getNotamCountForAirport($request->id);
    }

    public function getNotamCount() {
        $delhiFir = "%VI%";
        $kolkataFir = "%VE%";
        $chennaiFir = "%VO%";
        $mumbaiFir = "%VA%";
        $notams = new NotamsModel;
        $lastUpdatedTime = array('va' => $this->convertDateFormat($notams::getLastupdateTime('va%')->updated_at),
            've' => $this->convertDateFormat($notams::getLastupdateTime('ve%')->updated_at),
            'vi' => $this->convertDateFormat($notams::getLastupdateTime('vi%')->updated_at),
            'vo' => $this->convertDateFormat($notams::getLastupdateTime('vo%')->updated_at));
        $notamsCount = array('va' => NotamsModel::where('aerodrome', 'like', $mumbaiFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count(),
            've' => NotamsModel::where('aerodrome', 'like', $kolkataFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count(),
            'vi' => NotamsModel::where('aerodrome', 'like', $delhiFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count(),
            'vo' => NotamsModel::where('aerodrome', 'like', $chennaiFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count()
        );
        $notUpdatedNotamsCount = array('va' => NotamsModel::where('aerodrome', 'like', $mumbaiFir)->where('is_update_skipped', '=', 1)->count(),
            've' => NotamsModel::where('aerodrome', 'like', $kolkataFir)->where('is_update_skipped', '=', 1)->count(),
            'vi' => NotamsModel::where('aerodrome', 'like', $delhiFir)->where('is_update_skipped', '=', 1)->count(),
            'vo' => NotamsModel::where('aerodrome', 'like', $chennaiFir)->where('is_update_skipped', '=', 1)->count()
        );

        return array('lastUpdatedTime' => $lastUpdatedTime, 'notamsCount' => $notamsCount, 'notUpdatedNotamsCount' => $notUpdatedNotamsCount, 'individualAirportNotamCount' => $notams::getNotamCount());
    }

    public function fetch_notams_fir(Request $request) {
        ini_set('max_execution_time', 300);
        $fir = $request->fir;
        $StationsModel = new StationwithNotamsModel;
        $stations = $StationsModel::get_airport_names_based_on_fir($fir . "%");
        $updatedCount = 0;
        $this->newlyAdded = 0;
        foreach ($stations as $key) {
            $this->store_notams($key->aero_id);
        }
        $fir = "%" . $fir . "%";
        $totalCount = NotamsModel::where('aerodrome', 'like', $fir)->count();
        return array('message' => 'success', 'updated_count' => $this->newlyAdded, 'total_count' => $totalCount);
    }

    public function api_notams_list2(Request $request) {
        $id = $request->id;
        $json = file_get_contents("http://api.vateud.net/notams/" . $id . ".json");
        $json = str_replace("\\n", '<br/>   ', $json);

        $notams_array = json_decode($json);

        foreach ($notams_array as $key => $object) {
            $notam_split_array = preg_split('/\n|\r/', $object->raw);
            $notam_split_array = array_filter($notam_split_array);
            $notam_split_array = array_values($notam_split_array);
            $post = [];

            $notam_split_data = str_replace("<", '', trim($notam_split_array[0]));
            $notam_split_data = str_replace(">", '', trim($notam_split_data));
            $notam_split_array2 = preg_split('<br/>', $notam_split_data);

            $notam_split_array = array_filter($notam_split_array2);
            $notam_split_array = array_values($notam_split_array);
            $notam_split_array = array_map('trim', $notam_split_array);

            $notam_number = explode(" ", trim($notam_split_array[0]));
            $post['notam_number'] = $notam_number[0];
            if ($notam_number[1] !== 'NOTAMN') {
                $post['revised_notam_number'] = $notam_number[2];
            } else {
                $post['revised_notam_number'] = $notam_number[1];
            }

            $fir = explode(" ", trim($notam_split_array[1]));
            $fir1 = explode("/", trim($fir[1]));
            $line3 = explode(")", trim($notam_split_array[2]));   // print_r($date_time); 

            $airport_txt = explode(' ', trim($line3['1']));
            $from_date_txt = explode(' ', trim($line3['2']));
            $to_date_txt = explode(' ', trim($line3['3']));

            print_r($to_date_txt);
            echo '<br/>';

            if (strpos($notam_split_array[3], 'D)') !== false) {
                $valid_time = trim($notam_split_array[3]);
                unset($notam_split_array[0], $notam_split_array[1], $notam_split_array[2], $notam_split_array[3]);
            } else {
                $valid_time = '';
                unset($notam_split_array[0], $notam_split_array[1], $notam_split_array[2]);
            }

            $value3 = $notam_split_array;

            $text = '';
            foreach ($value3 as $data) {
                $text .= $data;
            }
            $textarr = explode("E)", $text);

            $e_text = $textarr[1];
            if (!$e_text) {
                $e_text = $text;
            }
            $f_text = explode("F)", trim($text));
            $g_text = explode("G)", trim($text));

            $post['fir'] = (array_key_exists('0', $fir1)) ? $fir1[0] : '';
            $post['q_code'] = (array_key_exists('1', $fir1)) ? $fir1[1] : '';
            $post['airport'] = (array_key_exists('0', $airport_txt)) ? $airport_txt[0] : '';
            $post['from_date'] = (array_key_exists('0', $from_date_txt)) ? substr($from_date_txt[0], 0, 6) : '1';
            $post['from_time'] = (array_key_exists('0', $from_date_txt)) ? substr($from_date_txt[0], 6) : '';
            $post['to_date'] = (array_key_exists('0', $to_date_txt)) ? substr($to_date_txt[0], 0, 6) : '1';
            $post['to_time'] = (array_key_exists('0', $to_date_txt)) ? substr($to_date_txt[0], 6) : '';
            $post['valid_timing'] = $valid_time;
            $post['notam_text'] = $e_text;
            $post['f_text'] = (array_key_exists('1', $f_text)) ? $f_text[1] : '';
            $post['g_text'] = (array_key_exists('1', $g_text)) ? $g_text[1] : '';

            $from_date = trim($post['from_date']);
            $from_time = trim($post['from_time']);
            $to_date = trim($post['to_date']);
            $to_time = trim($post['to_time']);

            $monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            $from_year = substr($from_date, 0, 2);
            $from_month = substr($from_date, 2, 2);
            $from_day = substr($from_date, 4, 2);
            $from_hr = substr($from_time, 0, 2);
            $from_min = substr($from_time, 2, 2);
            $to_year = substr($to_date, 0, 2);
            $to_month = substr($to_date, 2, 2);
            $to_day = substr($to_date, 4, 2);
            $to_hr = substr($to_time, 0, 2);
            $to_min = substr($to_time, 2, 2);

            $from_mon_name = (array_key_exists("$from_month - 1", $monthNames)) ? $monthNames[$from_month - 1] : 'Jan';
            $to_mon_name = (array_key_exists("$to_month - 1", $monthNames)) ? $monthNames[$to_month - 1] : 'Jan';

            $from_date_format = $from_day . ' ' . $from_mon_name . ' 20' . $from_year;
            $to_date_format = $to_day . ' ' . $to_mon_name . ' 20' . $to_year;
            $from_time_format = $from_hr . ':' . $from_min;
            $to_time_format = $to_hr . ':' . $to_min;

            $post['from_time_IST'] = date("H:i", strtotime("+330 minutes", strtotime($from_time_format)));
            $post['to_time_IST'] = date("H:i", strtotime("+330 minutes", strtotime($to_time_format)));
            $post['from_date_format'] = $from_date_format;
            $post['from_time_format'] = $from_time_format;

            if ($to_date != 'PERM') {
                $post['to_date_format'] = $to_date_format;
                $post['to_time_format'] = $to_time_format;
            } else {
                $post['to_date_format'] = 'PERMANENT';
                $post['to_time_format'] = '';
            }

            if ($post['airport']) {
                $airport = $post['airport'];
                $notam_number = $post['notam_number'];
                $timestamp = date('d-M-Y H:i:s');
                $notam_number_exist = NotamRecordsModel::notam_number_exist($post);
                if (!$notam_number_exist) {
                    $post['recent_added_number'] = 'RAN' . $post['notam_number'];
                    $result = NotamRecordsModel::create($post);
                } else {
                    $recent_notam_number_exist = NotamRecordsModel::notam_number_exist($post);
                    if ($recent_notam_number_exist) {
                        if (array_key_exists($post['airport'] . $post['notam_number'], $notam_dupes_array)) {
                            $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''] = $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''] + 1;
                        } else {
                            $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''] = 1;
                        }
                        $post['dupe_notam_number'] = ' DUPE' . $notam_dupes_array['' . $post['airport'] . $post['notam_number'] . ''];
                        $dupe_records = NotamRecordsModel::create($post); //$obj->InsertNotams($post);
                        $total_dupes++;
                        $dupe_num++;
                    }
                    $post['recent_added_number'] = '';
                    $update = NotamRecordsModel::update_notams($post); //$obj->updateNotams($post);
                }
            }
        }

        return 'Success';
    }

    public function fplnotams(Request $request) {
        $id = $request->data_value;
        if (!empty($id)) {

            $fpl_results = \App\models\FlightPlanDetailsModel::where('id', $id)->first();

            $departure_aerodrome = ($fpl_results) ? $fpl_results->departure_aerodrome : '';
            $destination_aerodrome = ($fpl_results) ? $fpl_results->destination_aerodrome : '';
            $first_alternate_aerodrome = ($fpl_results) ? $fpl_results->first_alternate_aerodrome : '';
            $second_alternate_aerodrome = ($fpl_results) ? $fpl_results->second_alternate_aerodrome : '';
            $departure_time_hours = ($fpl_results) ? $fpl_results->departure_time_hours : '';
            $departure_time_minutes = ($fpl_results) ? $fpl_results->departure_time_minutes : '';
            $date_of_flight = ($fpl_results) ? $fpl_results->date_of_flight : '';
            $total_flying_hours = ($fpl_results) ? $fpl_results->total_flying_hours : '';
            $total_flying_minutes = ($fpl_results) ? $fpl_results->total_flying_minutes : '';

            $departure_aerodrome = ($departure_aerodrome != 'ZZZZ') ? $departure_aerodrome : '';
            $destination_aerodrome = ($destination_aerodrome != 'ZZZZ') ? $destination_aerodrome : '';
            $first_alternate_aerodrome = ($first_alternate_aerodrome != 'ZZZZ') ? $first_alternate_aerodrome : '';
            $second_alternate_aerodrome = ($second_alternate_aerodrome != 'ZZZZ') ? $second_alternate_aerodrome : '';
            $date_of_flight = date('d-M-Y', strtotime('20' . $date_of_flight));

            $dept_time = $departure_time_hours . '' . $departure_time_minutes;
            $total_flying_time = ($total_flying_hours * 60) + $total_flying_minutes + 180;
            $endTime = strtotime("+$total_flying_time minutes", strtotime($dept_time));
            // $endTime = date('Hi', $endTime);

            $startTime = strtotime("-120 minutes", strtotime($dept_time));
            // $startTime = date('Hi', $startTime);
            // round off

            $minutes_end_time = date('i', $endTime);
            $endTimeRemainder = 30 - ($minutes_end_time % 30);
            if ($endTimeRemainder > 15) {
                $endTime = strtotime("-" . ($minutes_end_time % 30) . " minutes", $endTime);
            } else {
                $endTime = strtotime("+" . ($endTimeRemainder) . " minutes", $endTime);
            }

            $endTime = date('Hi', $endTime);


            $minutes_start_time = date('i', $startTime);
            $startTimeRemainder = 30 - ($minutes_start_time % 30);
            if ($startTimeRemainder > 15) {
                $startTime = strtotime("-" . ($minutes_start_time % 30) . " minutes", $startTime);
            } else {
                $startTime = strtotime("+" . ($startTimeRemainder) . " minutes", $startTime);
            }

            $startTime = date('Hi', $startTime);


            //  end


            $airportcode = $departure_aerodrome . "," . $destination_aerodrome .
                    "," . $first_alternate_aerodrome . "," . $second_alternate_aerodrome;

            $firList = array("VI" => "VIDF", "VE" => "VECF", "VA" => "VABF", "VO" => "VOMF");
            $firArr = array();
            if (!empty($departure_aerodrome)) {
                array_push($firArr, $firList[substr($departure_aerodrome, 0, 2)]);
            }
            if (!empty($destination_aerodrome)) {
                array_push($firArr, $firList[substr($destination_aerodrome, 0, 2)]);
            }
            if (!empty($first_alternate_aerodrome)) {
                array_push($firArr, $firList[substr($first_alternate_aerodrome, 0, 2)]);
            }
            if (!empty($second_alternate_aerodrome)) {
                array_push($firArr, $firList[substr($second_alternate_aerodrome, 0, 2)]);
            }


            $start_date = date_create("20" . $fpl_results->date_of_flight . " " . $dept_time);
            $end_date = date_create("20" . $fpl_results->date_of_flight . " " . $dept_time);

            date_add($start_date, date_interval_create_from_date_string("-120 minutes"));
            date_add($end_date, date_interval_create_from_date_string("+300 minutes"));

            $firArr = array_unique($firArr);
            $joinedFir = join(",", $firArr);
            $airportcode = trim($airportcode, ',');
            $data = ['airportcode' => $airportcode . "," . $joinedFir,
                'fromdate' => date_format($start_date, "d-M-Y"),
                'todate' => date_format($end_date, "d-M-Y"),
                'startTime' => $startTime,
                'endTime' => $endTime,
                'dof'=>$date_of_flight,
                'callsign'=>$fpl_results->aircraft_callsign];
//        print_r($data);exit;
        } else {
            $data = $request->all();
        }
        return view('notams.fpl_notams', $data);
    }

    public function notamsbyairport(Request $request) {

        $data = ['airportcode' => $request->airportcode];
        return view('notams.display_list', $data);
    }

    public function weatherdownload() {
        $path = public_path('media/pdf/WEATHER_VTZOA VIDP-VABB 18-OCT-2016_2016.pdf');
        return response()->download($path);
    }
    public function findAirport(Request $request) {

        
         $term = trim($request->q);
            if (empty($term)) {
                return \Response::json([]);
            }
            $formatted_tags=[];
            $airports_names = StationwithNotamsModel::where('aero_id','like',"%$term%")->get();
            foreach ($airports_names as $airports_name) {
                $formatted_tags[] = ['id' => $airports_name->aero_id, 'text' => $airports_name->aero_id."-".$airports_name->aero_name];
            }
            return \Response::json($formatted_tags);
    }
    public function sendEmailBackup(Request $request) {
        $notams = new NotamsModel;
        $result = $notams::getByAerodrome("%" . $request->id . "%");
        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');

        $fileName = $region[$request->id];
        Excel::create($fileName, function($excel) use ($result) {
            $excel->sheet('notam_sheet', function($sheet) use ($result) {
                $sheet->fromModel($result);
                $sheet->setOrientation('landscape');
            });
        })->store();
        $subject= 'BACK UP';
            $filePath = storage_path('exports/');
        $path =$filePath.$fileName.'.xls'; 


     Mail::send('emails.notams.notam_notification', array('customer_name'=>'Admin'), function($message) use($subject, $fileName,$path) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                $message->to("praveenkmr.t@gmail.com");
                $message->cc("sumit.kumar@pravahya.com");
                $message->cc("prem@eflight.aero");

                 $message->attach($path, array(
                    'as' => $fileName));
                
            });
        return array('message' => 'success' );

 }

}
