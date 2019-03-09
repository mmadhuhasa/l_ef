<?php 
namespace App\Http\Controllers\NotamsOps;
if (env('APP_ENV') != 'local') 
ini_set('memory_limit', '512M');

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions\customException;
use Log;
use Redirect;
use App\models\NotamRecordsModel as NotamRecordsModel;
use App\models\RoutesModel;
use App\models\NotamIdModel;
use App\models\notamsops\NotamsModel;
use App\models\notams\NotamsModel as NotamsServerModel;
use App\models\notamsops\NotamStatsModel;
use App\models\notamsops\NotamsLogModel;
use App\models\NotamCoordinatesModel;
use App\models\CoordinatesModel;
use App\models\notamsops\StationsModel;
use App\models\notamsops\StationwithNotamsModel;
use App\models\notamsops\NotamHelpCodeModel;
use PDF;
use Excel;
use Auth;
use Mail;

class NotamsOpsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('notams_ops.display_list');
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
//		echo '<pre>';
//		print_r($value);
//		echo '</pre>';
//		exit;

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
//			    $obj->deleteDupeNotams($post);
//			    $obj->deleteRoute($post);
//			    $obj->update_coordinates($post);
//			    $notam_number_exist = count($obj->getcountofNotams($post));	    
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
//				    $check_route_exist = $obj->check_route_exist($post['airport'], $post['notam_number'], $post['route_name']);
//				    if (!$check_route_exist) {
//					$obj->insertRoutes($post);
//				    }
                                }
                            }
                            //Routes

                            if (!$notam_number_exist) {
                                $post['recent_added_number'] = 'RAN' . $post['notam_number'];
                                $new_notam++;
                                $notification = 'Mails have been sent to respective customers';
                                //Anand New Design
//				$update_routes = $obj->updateRoutes($post);
//				//Insert into notams report
//				$result = $obj->InsertNotams($post);
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
//				$recent_notam_number_exist = count($obj->getcountofNotams($post, $recent_id));
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
            return view('notams_ops.display_list', ['airport' => $airport, 'notams_array' => array(), 'status' => 'failed']);
        }
        $json = str_replace("\\n", '<br/>', $json);
        $notamsHelpCode = new NotamHelpCodeModel;

        $notams_array = array();
        if ($json == 'No notams found for this airport') {
            return $notams_array;
        }
        // echo $id;
        // echo "<br/>";
        $notams_json_data = json_decode($json);
        $notamsObj = new NotamsModel;
        $notamsObj::setAllasDeleted($id, 1);

        foreach ($notams_json_data as $key) {
            // echo "=============";
            // echo "<br/>";
            // echo $key->raw;
            // echo "<br/>";
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
            // echo "<br/>";

            // print_r($notams_raw_dataArray);
            // echo "<br/>";
            // echo sizeof(explode("B)", $notams_raw_dataArray[2]));
            if(sizeof(explode("B)", $notams_raw_dataArray[2]))!=1){
               
                            $notamsData['e_start_date'] = explode(" ", explode("C)", explode("B)", $notams_raw_dataArray[2])[1])[0])[1];                
            }
            else{
             $notams_raw_dataArray[2]= $notams_raw_dataArray[2] .' ' .$notams_raw_dataArray[3];
                unset($notams_raw_dataArray[3]);
                            $notamsData['e_start_date'] = explode(" ", explode("C)", explode("B)", $notams_raw_dataArray[2])[1])[0])[1];   
             }

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

            if ($notamsData['e_end_date'] != "9999-12-31 23:59" && strtotime(date("d-m-Y")) > strtotime(date_format($end_date_formatted_ist, "d-m-Y"))) {

                continue;
            }
            if (sizeof(explode("<br/>E)", $key->raw)) == 2) {

                // if($this->isAnyIndexEmpty(explode("<br/>",explode("<br/>E)", $key->raw)[1]))){
                // $notamsData['description'] = explode("F)", explode("E)", $key->raw)[1])[0];
                // }
                // else{
                $notamsData['description'] = explode("F)", str_replace("<br/>", "\n", explode("<br/>E)", $key->raw)[1]))[0];
                // }
            } else {

                $dataSplittedWithE = explode("E)", $key->raw);

                $outputDescription = " ";
                for ($i = 1; $i < sizeof($dataSplittedWithE); $i++) {
                    $outputDescription = $outputDescription . " " . $dataSplittedWithE[$i];
                }
                // if($this->isAnyIndexEmpty(explode("<br/>", $outputDescription)[1])){
                // $notamsData['description'] = explode("F)", $outputDescription)[0];
                // }
                // else{
                $notamsData['description'] = explode("F)", str_replace("<br/>", "\n", $outputDescription))[0];
                // }
            }
            if (sizeof(explode("F)", $key->raw)) > 1) {
                $notamsData['height'] = explode("G)", explode("F)", $key->raw)[1])[0];
                // $notamsData['level'] = explode("<br/>", explode("G)", $key->raw)[1])[0];
                // echo "<br/> ".$notamsData['notam_no'] ." --  ".$key->icao." --";
                // print_r(explode("G)", explode("F)", $key->raw)[1]));
                // echo "<br/>";
                if(sizeof(explode("G)", explode("F)", $key->raw)[1]))>1){
                    $notamsData['level'] = explode("<br/>", explode("G)", explode("F)", $key->raw)[1])[1])[0];
                }
                else{
                    $notamsData['level'] = '';
                }


                // $notamsData['level'] = 'A';

                // echo "<br/>";
                // print_r(explode("G)", explode("F)", $key->raw)[1]));
                // echo "<br/>";
                // $notamsData['level'] = 'explode("G)", explode("F)", $key->raw)[1])[1]';
            }
            $timePosition = strpos($key->raw, "D)");
            if ($timePosition != false) {
                // if($notamsData['notam_no']=="G0409/13 "){
                // }
                if (sizeof(explode("<br/>D)", $key->raw)) > 1 && sizeof(explode("E)", explode("<br/>D)", $key->raw)[1])) > 1 && sizeof(explode("<br/>D)", explode("E)", $key->raw)[0])) > 1) {
                    $notamsData['raw_time'] = explode("E)", explode("<br/>D)", $key->raw)[1])[0];
                    $notamsData['time'] = $this->appendIst(explode("E)", explode("D)", $key->raw)[1])[0]);
                    $time_daily_pos = 0;
                    $time_daily_pos = strpos($notamsData['time'], 'DLY');
                    if($time_daily_pos != 0 ){
                        $time_data = explode('-', $notamsData['raw_time']);
                        if(sizeof($time_data) == 2) {
                            $notamsData['is_daily'] = 1;
                            $notamsData['time'] = str_replace('DLY',' ',$notamsData['raw_time']);
                            $notamsData['time'] = $this->appendIst(explode("E)", explode("D)", $key->raw)[1])[0]);
                            $notamsData['raw_time'] = '';
                            $notamsData['start_time'] = explode('-', $notamsData['time'])[0];
                            if(isset(explode('-', $notamsData['time'])[1])){
                             $notamsData['end_time'] =  explode('-', $notamsData['time'])[1];
                            }
                        }
                    }

                
                } else {
                    $notamsData['raw_time'] = '';
                    if (($notamsData['e_start_time_formatted'] == '0000' || $notamsData['e_start_time_formatted'] == '0001') && $notamsData['e_end_time_formatted'] == '2359') {
                        $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " IST)";
                        $notamsData['start_time'] = $notamsData['e_start_time_formatted'];
                        $notamsData['end_time'] = $notamsData['e_end_time_formatted'];
                        $notamsData['is_daily'] = 1;
                    } else {
                        $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted_ist'] . " - " . $notamsData['e_end_time_formatted_ist'] . " IST)";
                        $notamsData['start_time'] = $notamsData['e_start_time_formatted'];
                        $notamsData['end_time'] = $notamsData['e_end_time_formatted'];
                        $notamsData['is_daily'] = 1;
                    }
                }
            } else {
                $notamsData['raw_time'] = '';
                if (($notamsData['e_start_time_formatted'] == '0000' || $notamsData['e_start_time_formatted'] == '0001') && $notamsData['e_end_time_formatted'] == '2359') {
                    $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " IST)";
                    $notamsData['start_time'] = $notamsData['e_start_time_formatted'];
                    $notamsData['end_time'] = $notamsData['e_end_time_formatted'];
                    $notamsData['is_daily'] = 1;
                } else {
                    $notamsData['time'] = $notamsData['e_start_time_formatted'] . " - " . $notamsData['e_end_time_formatted'] . " UTC  (" . $notamsData['e_start_time_formatted_ist'] . " - " . $notamsData['e_end_time_formatted_ist'] . " IST)";
                    $notamsData['start_time'] = $notamsData['e_start_time_formatted'];
                    $notamsData['end_time'] = $notamsData['e_end_time_formatted'];
                    $notamsData['is_daily'] = 1;
                }
            }
            if(strpos($notamsData['description'], 'HR OF OPS: H24')!==false){
                    $notamsData['time'] = ' H24';
            }
            if ($notamsData['time'] == " H-24" || $notamsData['time'] == " H24" || $notamsData['time'] == "24 hours") {
                $notamsData['time'] = "24 Hours";
                $notamsData['start_time'] = "0000";
                $notamsData['end_time'] = "2359";
                $notamsData['is_daily'] = 1;
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
                if (isset($notamsData['start_time'])) {
                    $notams->start_time = $notamsData['start_time'];
                    $notams->end_time = $notamsData['end_time'];
                    $notams->is_daily = $notamsData['is_daily'];
                }
                $notams->decoded_qline = $notamsData['decoded_qline'];
                $notams->raw_time = $notamsData['raw_time'];
                $notams->is_primary = 1;
                $notams->is_active = 1;

                if (isset($notamsData['height'])) {
                    $notams->height = $notamsData['height'];
                    $notams->level = $notamsData['level'];
                }
                $tempRaw = explode('<br/>', $key->raw);
                array_splice($tempRaw, 1, 1);
                $tempRaw = implode("<br/>", $tempRaw);
                $desc_raw = explode("E)", $tempRaw);

                // if (sizeof($desc_raw) == 2) {
                //     $desc_raw[1] = str_replace("<br/>", " ", explode("F)", $desc_raw[1])[0]);
                //     $notams->raw_data = implode("E)", $desc_raw);
                // } else {
                //     for ($j = 1; $j < sizeof($desc_raw); $j++) {
                //         $desc_raw[$j] = str_replace("<br/>", " ", explode("F)", $desc_raw[$j])[0]);
                //     }
                //     $notams->raw_data = implode("E)", $desc_raw);
                // }
                if (sizeof($desc_raw) == 2) {
                    // $desc_raw[1] = str_replace("<br/>", " ", explode("F)", $desc_raw[1])[0]);
                    $tempDesc = explode("F)", $desc_raw[1]);
                    $tempDesc[0] = str_replace("<br/>", " ", $tempDesc[0]);
                    $desc_raw[1] = implode("F)", $tempDesc);

                    $notams->raw_data = implode("E)", $desc_raw);
                } else {
                    for ($j = 1; $j < sizeof($desc_raw); $j++) {
                        $tempDesc = explode("F)", $desc_raw[$j]);
                        $tempDesc[0] = str_replace("<br/>", " ", $tempDesc[0]);
                        $desc_raw[$j] = implode("F)", $tempDesc);

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
                    if(isset($notamsData['height'])){
                        $notams->description=$notams->description. "FROM ".$notamsData['height']." TO ".$notamsData['level'];
                    }  
                    $notams->save();
                    if ($id == $notams->aerodrome) {
                        $this->newlyAdded++;
                        if(!isset($this->newNotamsCount[$notamsData['aerodrome']])){
                            $this->newNotamsCount[$notamsData['aerodrome']]=1;
                        }
                        else {
                            $this->newNotamsCount[$notamsData['aerodrome']]++;
                        }
                    }
                } else if (strpos($key->icao, 'PART')) {
                    $previousDescription = NotamsModel::where('notam_no', $notams->notam_no)->where('aerodrome', $notams->aerodrome)->first()->description;
                    if (strpos($previousDescription, $notams->description) === false) {
                        $notams::updateDescription($previousDescription . " " . $notams->description, $notams->notam_no, 0);
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
                if (isset($notamsData['start_time'])) {
                    $notams->start_time = $notamsData['start_time'];
                    $notams->end_time = $notamsData['end_time'];
                    $notams->is_daily = $notamsData['is_daily'];
                }
                $notams->decoded_qline = $notamsData['decoded_qline'];
                $notams->raw_time = $notamsData['raw_time'];
                $notams->is_primary = 1;
                $notams->is_active = 1;
                if (isset($notamsData['height'])) {
                    $notams->height = $notamsData['height'];
                    $notams->level = $notamsData['level'];
                }
                $tempRaw = explode('<br/>', $key->raw);
                array_splice($tempRaw, 1, 1);
                $tempRaw = implode("<br/>", $tempRaw);
                $desc_raw = explode("E)", $tempRaw);
                // if (sizeof($desc_raw) == 2) {
                //     $desc_raw[1] = str_replace("<br/>", " ", explode("F)", $desc_raw[1])[0]);
                //     $notams->raw_data = implode("E)", $desc_raw);
                // } else {
                //     for ($i = 1; $i < sizeof($desc_raw); $i++) {
                //         $desc_raw[$i] = str_replace("<br/>", " ", explode("F)", $desc_raw[$i])[0]);
                //     }
                //     $notams->raw_data = implode("E)", $desc_raw);
                // }
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
                    if(isset($notamsData['height'])){
                        $notams->description= $notams->description ."FROM ".$notamsData['height']." TO ".$notamsData['level'];
                    }   
                    $notams->save();
                    $this->newlyAdded++;
                    if(!isset($this->newNotamsCount[$notamsData['aerodrome']])){
                            $this->newNotamsCount[$notamsData['aerodrome']]=1;
                        }
                        else {
                            $this->newNotamsCount[$notamsData['aerodrome']]++;
                        }
                } else if (strpos($key->icao, 'PART')) {
                    $previousDescription = NotamsModel::where('notam_no', $notams->notam_no)->where('aerodrome', $notams->aerodrome)->first()->description;
                    if (strpos($previousDescription, $notams->description) === false) {
                        $notams::updateDescription($previousDescription . " " . $notams->description, $notams->notam_no, 0);
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

    public function isAnyIndexEmpty($array) {

        $empty = 0;
        for ($i = 0; $i < sizeof($array); $i++) {
            if (empty($array[$i])) {
                $empty++;
            }
        }
        if ($empty > 1) {
            return true;
        }
        return false;
    }

    public function update_notams_description(Request $request) {
        $notams = new NotamsModel;
        $updateData = array('notam_number' => $request->id,'user_id'=>Auth::id(),'name'=>Auth::user()->name,'type'=>'description change' );
        NotamsLogModel::insert($updateData);
        // print_r($updateData);
        $notams::updateDescription($request->desc, $request->id, 1);
        return array('Status' => 'Success');
    }

    public function editNotamtime(Request $request) {
        $weekDaysShortName = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
        $notams = new NotamsModel;

        if ($request->isDaily) {
            // echo "daily";
            $notams::updateNotamTime($request->notam_id, $request->notamTime[0]);
        } elseif ($request->isWeekly) {
            echo "weekly";
            $updateInfo = array();
            for ($i = 0; $i < 7; $i++) {
                if ($request->weekDaysStatus[$i]) {
                    $keyNameStart = $weekDaysShortName[$i] . "_start_time";
                    $keyNameEnd = $weekDaysShortName[$i] . "_end_time";
                    $updateInfo[$keyNameStart] = $request->notamTime[0]['start'];
                    $updateInfo[$keyNameEnd] = $request->notamTime[0]['end'];
                } else {
                    $keyNameStart = $weekDaysShortName[$i] . "_start_time";
                    $keyNameEnd = $weekDaysShortName[$i] . "_end_time";
                    $updateInfo[$keyNameStart] = null;
                    $updateInfo[$keyNameEnd] = null;
                }
            }
            $updateInfo['is_weekly'] = 1;
            $updateInfo['is_daily'] = 0;
            $updateInfo['is_date_specific'] = 0;
            $updateInfo['start_time'] = "";
            $updateInfo['end_time'] = "";
            $updateInfo['notam_dates'] = "";

            $notams::updateNotamTimeForWeekDays($request->notam_id, $updateInfo);

            // print_r($updateInfo);
        } elseif ($request->specificDateOnly) {
            // echo "specificDateOnly";
            $notams::updateNotamSpecificDays($request->notam_id, $request->notamTime[0], $request->selectedNotamDates);
        }
        $updateData = array('notam_number' => $request->notam_id,'user_id'=>Auth::id(),'name'=>Auth::user()->name,'type'=>'time change' );
        NotamsLogModel::insert($updateData);
        $datas=NotamsModel::where('notam_no',$request->notam_no)->get();
          
            $start_date_formatted = date_create($datas[0]['e_start_date']);
            $start_date_formatted_ist = date_create($datas[0]['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $datas[0]['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $datas[0]['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $datas[0]['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            // $datas[0]['raw_time'] = str_replace("<br/>", "", $datas[0]['raw_time']);
            // $datas[0]['raw_data'] = str_replace("<br/>", " ", $datas[0]['raw_data']);

            $end_date_formatted = date_create($datas[0]['e_end_date']);
            $end_date_formatted_ist = date_create($datas[0]['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $datas[0]['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $datas[0]['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $datas[0]['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
            if ($datas[0]['is_daily']) {

            $datas[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $datas[0]['notam_no'] . "%", 'daily', $datas[0]['aerodrome']);
            } elseif ($datas[0]['is_weekly']) {
                $datas[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $datas[0]['notam_no'] . "%", 'weekly', $datas[0]['aerodrome']);
            } elseif ($datas[0]['is_date_specific']) {
                $datas[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $datas[0]['notam_no'] . "%", 'specificDate', $datas[0]['aerodrome']);
            }

        return view('notams_ops.notam_timing',["key"=>$datas[0]]);

        return $request->notam_id;
    }

    public function updatetime(Request $request) {

        $notams = new NotamsModel;
        $weekDaysShortName = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
        // return $request;
        if ($request->isDaily) {

            $notams::updateNotamTime($request->notam_id, $request->notamTime[0]);
            for ($i = 1; $i < sizeof($request->notamTime); $i++) {

                $datas = NotamsModel::where('notam_no', 'like', $request->notam_no)->where('aerodrome', 'like', $request->aerodrome)->first();
                // foreach ($notamRow as $datas) {
                $notams_server = new NotamsModel;
                if (NotamsModel::where('notam_no', $datas['notam_no'])->where('start_time', $request->notamTime[$i]['start'])->where('end_time', $request->notamTime[$i]['end'])->first() == false) {

                    $notams_server->notam_no = $datas['notam_no'];
                    $notams_server->notam_type = $datas['notam_type'];
                    $notams_server->q_line = $datas['q_line'];
                    $notams_server->decoded_qline = $datas['decoded_qline'];
                    $notams_server->aerodrome = $datas['aerodrome'];
                    $notams_server->e_start_date = $datas['e_start_date'];
                    $notams_server->e_end_date = $datas['e_end_date'];
                    $notams_server->raw_time = $datas['raw_time'];
                    $notams_server->time = $datas['time'];
                    $notams_server->start_time = $request->notamTime[$i]['start'];
                    $notams_server->end_time = $request->notamTime[$i]['end'];
                    $notams_server->description = $datas['description'];
                    $notams_server->height = $datas['height'];
                    $notams_server->level = $datas['level'];
                    $notams_server->raw_data = $datas['raw_data'];
                    $notams_server->icao = $datas['icao'];
                    $notams_server->is_primary = 0;
                    $notams_server->is_daily = $datas['is_daily'];
                    $notams_server->is_active = $datas['is_active'];
                    $notams_server->is_delete = $datas['is_delete'] || 0;
                    $notams_server->is_updated = $datas['is_updated'];
                    $notams_server->is_update_skipped = $datas['is_update_skipped'];
                    $notams_server->enable_email = $datas['enable_email'] || 0;
                    $notams_server->save();
                }
                // }
            }
        } else if ($request->isWeekly) {
            $updateInfo = array();
            for ($i = 0; $i < 7; $i++) {
                if ($request->weekDaysStatus[$i]) {
                    $keyNameStart = $weekDaysShortName[$i] . "_start_time";
                    $keyNameEnd = $weekDaysShortName[$i] . "_end_time";
                    $updateInfo[$keyNameStart] = $request->notamTime[0]['start'];
                    $updateInfo[$keyNameEnd] = $request->notamTime[0]['end'];
                }
            }

            $updateInfo['is_weekly'] = 1;
            $notams::updateNotamTimeForWeekDays($request->notam_id, $updateInfo);
            $datas = NotamsModel::where('notam_no', 'like', $request->notam_no)->where('aerodrome', 'like', $request->aerodrome)->first();

            for ($i = 1; $i < sizeof($request->notamTime); $i++) {
                $notams_server = new NotamsModel;
                $notams_server->notam_no = $datas['notam_no'];
                $notams_server->notam_type = $datas['notam_type'];
                $notams_server->q_line = $datas['q_line'];
                $notams_server->decoded_qline = $datas['decoded_qline'];
                $notams_server->aerodrome = $datas['aerodrome'];
                $notams_server->e_start_date = $datas['e_start_date'];
                $notams_server->e_end_date = $datas['e_end_date'];
                $notams_server->raw_time = $datas['raw_time'];
                $notams_server->time = $datas['time'];
                $notams_server->description = $datas['description'];
                $notams_server->height = $datas['height'];
                $notams_server->level = $datas['level'];
                $notams_server->raw_data = $datas['raw_data'];
                $notams_server->icao = $datas['icao'];
                $notams_server->is_primary = 0;
                $notams_server->is_daily = $datas['is_daily'];
                $notams_server->is_weekly = $datas['is_weekly'];
                $notams_server->is_active = $datas['is_active'];
                $notams_server->is_delete = $datas['is_delete'] || 0;
                $notams_server->is_updated = $datas['is_updated'];
                $notams_server->is_update_skipped = $datas['is_update_skipped'];
                $notams_server->enable_email = $datas['enable_email'] || 0;
                for ($j = 0; $j < 7; $j++) {
                    if ($request->weekDaysStatus[$j]) {
                        $keyNameStart = $weekDaysShortName[$j] . "_start_time";
                        $keyNameEnd = $weekDaysShortName[$j] . "_end_time";
                        $notams_server[$keyNameStart] = $request->notamTime[$i]['start'];
                        $notams_server[$keyNameEnd] = $request->notamTime[$i]['end'];
                    }
                }
                $notams_server->save();
            }
        } else if ($request->specificDateOnly) {

            $datas = NotamsModel::where('notam_no', 'like', $request->notam_no)->where('aerodrome', 'like', $request->aerodrome)->first();

            if (!empty($datas['notam_dates'])) {
                for ($i = 0; $i < sizeof($request->notamTime); $i++) {
                    $notams_server = new NotamsModel;
                    $notams_server->notam_no = $datas['notam_no'];
                    $notams_server->notam_type = $datas['notam_type'];
                    $notams_server->q_line = $datas['q_line'];
                    $notams_server->decoded_qline = $datas['decoded_qline'];
                    $notams_server->aerodrome = $datas['aerodrome'];
                    $notams_server->e_start_date = $datas['e_start_date'];
                    $notams_server->e_end_date = $datas['e_end_date'];
                    $notams_server->raw_time = $datas['raw_time'];
                    $notams_server->time = $datas['time'];
                    $notams_server->datespecific_start_time = $request->notamTime[$i]['start'];
                    $notams_server->datespecific_end_time = $request->notamTime[$i]['end'];
                    $notams_server->description = $datas['description'];
                    $notams_server->height = $datas['height'];
                    $notams_server->level = $datas['level'];
                    $notams_server->raw_data = $datas['raw_data'];
                    $notams_server->icao = $datas['icao'];
                    $notams_server->is_primary = 0;
                    $notams_server->is_daily = $datas['is_daily'];
                    $notams_server->is_weekly = $datas['is_weekly'];
                    $notams_server->notam_dates = $request->selectedNotamDates;
                    $notams_server->is_date_specific = $datas['is_date_specific'];
                    $notams_server->is_active = $datas['is_active'];
                    $notams_server->is_delete = $datas['is_delete'] || 0;
                    $notams_server->is_updated = $datas['is_updated'];
                    $notams_server->is_update_skipped = $datas['is_update_skipped'];
                    $notams_server->enable_email = $datas['enable_email'] || 0;
                    $notams_server->save();
                }
            } else {
                $notams::updateNotamSpecificDays($request->notam_id, $request->notamTime[0], $request->selectedNotamDates);
                for ($i = 1; $i < sizeof($request->notamTime); $i++) {
                    $notams_server = new NotamsModel;
                    $notams_server->notam_no = $datas['notam_no'];
                    $notams_server->notam_type = $datas['notam_type'];
                    $notams_server->q_line = $datas['q_line'];
                    $notams_server->decoded_qline = $datas['decoded_qline'];
                    $notams_server->aerodrome = $datas['aerodrome'];
                    $notams_server->e_start_date = $datas['e_start_date'];
                    $notams_server->e_end_date = $datas['e_end_date'];
                    $notams_server->raw_time = $datas['raw_time'];
                    $notams_server->time = $datas['time'];
                    $notams_server->datespecific_start_time = $request->notamTime[$i]['start'];
                    $notams_server->datespecific_end_time = $request->notamTime[$i]['end'];
                    $notams_server->description = $datas['description'];
                    $notams_server->height = $datas['height'];
                    $notams_server->level = $datas['level'];
                    $notams_server->raw_data = $datas['raw_data'];
                    $notams_server->icao = $datas['icao'];
                    $notams_server->is_primary = 0;
                    $notams_server->is_daily = $datas['is_daily'];
                    $notams_server->is_weekly = $datas['is_weekly'];
                    $notams_server->is_date_specific = $datas['is_date_specific'];
                    $notams_server->is_active = $datas['is_active'];
                    $notams_server->is_delete = $datas['is_delete'] || 0;
                    $notams_server->is_updated = $datas['is_updated'];
                    $notams_server->is_update_skipped = $datas['is_update_skipped'];
                    $notams_server->enable_email = $datas['enable_email'] || 0;
                    $notams_server->save();
                }
            }
        } else {
            echo "NA";
        }
        $updateData = array('notam_number' => $request->notam_id,'user_id'=>Auth::id(),'name'=>Auth::user()->name,'type'=>'time change' );
        NotamsLogModel::insert($updateData);
        $notam_time_data=NotamsModel::where('notam_no',$request->notam_no)->get();
          $start_date_formatted = date_create($notam_time_data[0]['e_start_date']);
            $start_date_formatted_ist = date_create($notam_time_data[0]['e_start_date']);
            date_add($start_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $notam_time_data[0]['e_start_date_formatted'] = date_format($start_date_formatted, "d-M-Y");
            $notam_time_data[0]['e_start_time_formatted'] = date_format($start_date_formatted, "Hi");
            $notam_time_data[0]['e_start_time_formatted_ist'] = date_format($start_date_formatted_ist, "Hi");
            // $notam_time_data[0]['raw_time'] = str_replace("<br/>", "", $notam_time_data[0]['raw_time']);
            // $notam_time_data[0]['raw_data'] = str_replace("<br/>", " ", $notam_time_data[0]['raw_data']);

            $end_date_formatted = date_create($notam_time_data[0]['e_end_date']);
            $end_date_formatted_ist = date_create($notam_time_data[0]['e_end_date']);
            date_add($end_date_formatted_ist, date_interval_create_from_date_string("330 minutes"));
            $notam_time_data[0]['e_end_date_formatted'] = date_format($end_date_formatted, "d-M-Y");
            $notam_time_data[0]['e_end_time_formatted'] = date_format($end_date_formatted, "Hi");
            $notam_time_data[0]['e_end_time_formatted_ist'] = date_format($end_date_formatted_ist, "Hi");
            if ($notam_time_data[0]['is_daily']) {

            $notam_time_data[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $notam_time_data[0]['notam_no'] . "%", 'daily', $notam_time_data[0]['aerodrome']);
            } elseif ($notam_time_data[0]['is_weekly']) {
                $notam_time_data[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $notam_time_data[0]['notam_no'] . "%", 'weekly', $notam_time_data[0]['aerodrome']);
            } elseif ($notam_time_data[0]['is_date_specific']) {
                $notam_time_data[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $notam_time_data[0]['notam_no'] . "%", 'specificDate', $notam_time_data[0]['aerodrome']);
            }
        return view('notams_ops.notam_timing',["key"=>$notam_time_data[0]]);
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

        return view('notams_ops.display_list', ['airport' => $airport, 'notams_array' => $result]);
    }

    public function processNotamData($result, $code) {
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;
        $aerodrome_name = '';
        $lineCount = 0;
        foreach ($result as $key) {
            $key['notam_Qline1'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 1, 2), 1)['signification'];
            $key['notam_Qline2'] = $notamsHelpCode::getSignification(substr(explode('/', $key['q_line'])[1], 3, 2), 2)['signification'];

            if ($aerodrome_name != $key['aerodrome']) {
                $key['print_aerodrome'] = true;
                $aerodrome_name = $key['aerodrome'];
                $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $key['aerodrome'])->first();
                $key['aerodrome_name'] = ($stations) ? $stations->aero_name : '';
                $key['aerodrome_notam_count'] = $notams::getCountbyAerodrome($key['aerodrome']);
            } else {
                $key['print_aerodrome'] = false;
            }
            preg_match_all('!\d\d\d\d\d\d.\w+!', $key->description, $match);

            if (sizeof($match[0]) > 0) {
                $key['enable_map'] = true;
            } else {
                $key['enable_map'] = false;
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
            $lineCount = $lineCount + sizeof(explode("<br/>", $key['raw_data']));
            if ($lineCount > 30) {
                $lineCount = 0;
            }
            $key['line_count'] = $lineCount;
        }
        $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $code)->first();
        $airport = ($stations) ? strtoupper($code) . ' (' . $stations->aero_name . ') ' : '';

        return array('result' => $result, 'airport' => $airport, 'aero_code' => $code);
    }

    public function filter(Request $request) {

        $resultArr = array();
        $val = array();
        $notams = new NotamsModel;
        $airportCodesArr = explode(',', $request->airportcode);
        $notamNumber = $request->notamNumber;
        $routeNotams = $request->routeNotams;
        $notamCategoryArr = array($request->notamCategory);
        $fromdate = date_format(date_create("20" . $request->startDateFmt), 'Y-m-d');
        $todate = date_format(date_create("20" . $request->endDateFmt), 'Y-m-d');


        if ($notamCategoryArr == "") {
            $notamCategoryArr = array();
        }
        $result = $notams::filterNotamsData($airportCodesArr, $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr);

        for ($i = 0; $i < sizeof($result); $i++) {

            if (isset($val[$result[$i]->aerodrome])) {
                array_push($val[$result[$i]->aerodrome], $result[$i]);
            } else {
                $val[$result[$i]->aerodrome] = array();
                array_push($val[$result[$i]->aerodrome], $result[$i]);
            }
        }
        foreach ($val as $key => $value) {

            $data = array('aero_code' => $key, 'airport' => '', 'result' => $value);
            array_push($resultArr, $this->processNotamData($value, $key));
        }

        return ['notams_array' => $resultArr, 'status' => 'success'];
    }

    public function download(Request $request) {
        ini_set('max_execution_time', 300);
        $id = $request->id;
        $notams = new NotamsModel;
        $notamsHelpCode = new NotamHelpCodeModel;

        // $result = $notams::getDataForPDF("%" . $request->id . "%");
        $resultArr = array();
        $airportCodesArr = explode(',', $request->airportcode);
        $notamNumber = $request->notamNumber;
        $routeNotams = $request->routeNotams;
        $notamCategoryArr = array($request->notamCategory);
        $fromdate = date_format(date_create("20" . $request->startDateFmt), 'Y-m-d');
        $todate = date_format(date_create("20" . $request->endDateFmt), 'Y-m-d');
        if (isset($id)) {
            $airportCodesArr = array($id);
        }
        for ($i = 0; $i < sizeof($airportCodesArr); $i++) {
            if ($notamCategoryArr == "") {
                $notamCategoryArr = array();
            }
            $result = $notams::getDataForPDF("%" . $airportCodesArr[$i] . "%", $fromdate, $todate, $notamNumber, $routeNotams, $notamCategoryArr);

            array_push($resultArr, $this->processNotamData($result, $airportCodesArr[$i]));
        }




        $stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $id)->first();
        $airport = ($stations) ? $id . ' (' . $stations->aero_name . ') ' : '';
        $filePath = public_path('media/pdf/notams/');
        date_default_timezone_set('Asia/Kolkata');
        if (isset($id)) {
            $fileName = strtoupper($id) . ' NOTAMS as on ' . date('Hi') . ' IST of ' . date('d-M-Y') . '.pdf';
        } else {
            $fileName = date('Hi') . ' IST EFLIGHT NOTAMS of ' . date('d-M-Y') . '.pdf';
        }
        $flight_plan_pdf_content = view('emails.display_list_report', ['airport' => $airport, 'notams_array' => $resultArr, 'status' => 'success', 'headerText' => 'as on ' . date('Hi') . ' IST of ' . date('d-M-Y')]);

        $pdf = PDF::loadHTML($flight_plan_pdf_content)
                ->setPaper('a4', 'portrait')
                ->save($filePath . $fileName);
        $path = $filePath . $fileName;
        return response()->download($path);
    }

    public function uploadxls(Request $request) {
        ini_set('max_execution_time', 300);

        $filePath = public_path('media/');
        $this->newlyAddedNotamCount = 0;
        Excel::load($request->file('file'), function($reader) {
            $results = $reader->get();
            foreach ($results as $key) {
                if (NotamsServerModel::where('notam_no', $key['notam_no'])->where('aerodrome', $key['aerodrome'])->first() == false) {
                    $notams_server = new NotamsServerModel;
                    $notams_server->notam_no = $key['notam_no'];
                    $notams_server->notam_type = $key['notam_type'];
                    $notams_server->q_line = $key['q_line'];
                    $notams_server->decoded_qline = $key['decoded_qline'];
                    $notams_server->aerodrome = $key['aerodrome'];
                    $notams_server->e_start_date = $key['e_start_date'];
                    $notams_server->e_end_date = $key['e_end_date'];
                    $notams_server->time = $key['time'];
                    $notams_server->height = $key['height'];
                    $notams_server->level = $key['level'];
                    $notams_server->raw_data = $key['raw_data'];
                    $notams_server->icao = $key['icao'];
                    $notams_server->is_active = $key['is_active'];
                    $notams_server->is_delete = $key['is_delete'] || 0;
                    $notams_server->enable_email = $key['enable_email'] || 0;
                    $notams_server->save();
                    $this->newlyAddedNotamCount++;
                } else {

                    NotamsModel::where('notam_no', $key['notam_no'])->where('aerodrome', $key['aerodrome'])
                            ->update(array('q_line' => $key['q_line'], 'decoded_qline' => $key['decoded_qline'], 'e_start_date' => $key['e_start_date'], 'e_end_date' => $key['e_end_date'], 'description' => $key['description'], 'time' => $key['time'], 'height' => $key['height'], 'level' => $key['level'], 'raw_data' => $key['raw_data'], 'icao' => $key['icao'], 'is_active' => $key['is_active'], 'is_delete' => $key['is_delete'], 'enable_email' => $key['enable_email']));
                }
            }
        });
        // print_r("Hello");
        // print_r();
        // print_r($request->input('file'));
        // return $request->pics_0;
        return array('Message' => 'Success', 'newlyAdded' => $this->newlyAddedNotamCount);
    }
    
    public function checkPendingEdit(Request $request) {

       $pendingCount = NotamsModel::where('aerodrome', 'like', "%".$request->code."%")->where('is_delete', '=', 0)->where('is_daily', '=', 0)->where('is_weekly', '=', 0)->where('is_date_specific', '=', 0)->orderBy('created_at', 'desc')->limit($request->count)->count();
       return array('count' => $pendingCount);
    }

    public function pushNotamtoLive(Request $request){
      
       $dataToSend =  $this->getrecentnotam($request);
       
       foreach ($dataToSend['notams_array'] as $key => $value) {
            if (NotamsServerModel::where('notam_no', $value['notam_no'])->where('aerodrome', $value['aerodrome'])->first() == false) {
                    $notams_server = new NotamsServerModel;
                    $notams_server->id = $value['id'];
                    $notams_server->notam_no = $value['notam_no'];
                    $notams_server->notam_type = $value['notam_type'];
                    $notams_server->q_line = $value['q_line'];
                    $notams_server->decoded_qline = $value['decoded_qline'];
                    $notams_server->aerodrome = $value['aerodrome'];
                    $notams_server->e_start_date = $value['e_start_date'];
                    $notams_server->e_end_date = $value['e_end_date'];
                    $notams_server->description = $value['description'];
                    $notams_server->time = $value['time'];
                    $notams_server->start_time = $value['start_time'];
                    $notams_server->end_time = $value['end_time'];
                    $notams_server->datespecific_start_time = $value['datespecific_start_time'];
                    $notams_server->datespecific_end_time = $value['datespecific_end_time'];
                    $notams_server->sun_start_time = $value['sun_start_time'];
                    $notams_server->sun_end_time = $value['sun_end_time'];
                    $notams_server->mon_start_time = $value['mon_start_time'];
                    $notams_server->mon_end_time = $value['mon_end_time'];
                    $notams_server->tue_start_time = $value['tue_start_time'];
                    $notams_server->tue_end_time = $value['tue_end_time'];
                    $notams_server->wed_start_time = $value['wed_start_time'];
                    $notams_server->wed_end_time = $value['wed_end_time'];
                    $notams_server->thu_start_time = $value['thu_start_time'];
                    $notams_server->thu_end_time = $value['thu_end_time'];
                    $notams_server->fri_start_time = $value['fri_start_time'];
                    $notams_server->fri_end_time = $value['fri_end_time'];
                    $notams_server->sat_start_time = $value['sat_start_time'];
                    $notams_server->sat_end_time = $value['sat_end_time'];
                    $notams_server->notam_dates = $value['notam_dates'];
                    $notams_server->height = $value['height'];
                    $notams_server->level = $value['level'];
                    $notams_server->raw_data = $value['raw_data'];
                    $notams_server->icao = $value['icao'];
                    $notams_server->is_primary = $value['is_primary'];
                    $notams_server->is_daily = $value['is_daily'];
                    $notams_server->is_weekly = $value['is_weekly'];
                    $notams_server->is_date_specific = $value['is_date_specific'];
                    $notams_server->is_active = 1;
                    $notams_server->is_delete = $value['is_delete'] || 0;
                    $notams_server->enable_email = $value['enable_email'] || 0;
                    $notams_server->is_updated = $value['is_updated'];
                    // $notams_server->notam_no = $value['notam_no'];
                    // $notams_server->notam_type = $value['notam_type'];
                    // $notams_server->q_line = $value['q_line'];
                    // $notams_server->decoded_qline = $value['decoded_qline'];
                    // $notams_server->aerodrome = $value['aerodrome'];
                    // $notams_server->e_start_date = $value['e_start_date'];
                    // $notams_server->e_end_date = $value['e_end_date'];
                    // $notams_server->time = $value['time'];
                    // $notams_server->height = $value['height'];
                    // $notams_server->level = $value['level'];
                    // $notams_server->raw_data = $value['raw_data'];
                    // $notams_server->icao = $value['icao'];
                    // $notams_server->is_active = $value['is_active'];
                    // $notams_server->is_daily = $value['is_daily'];
                    // $notams_server->is_delete = $value['is_delete'] || 0;
                    // $notams_server->is_primary = $value['is_primary'];


                    // $notams_server->enable_email = $value['enable_email'] || 0;
                    $notams_server->save();
                    // $this->newlyAddedNotamCount++;
                } else {
                        NotamsServerModel::where('id', $value['id'])->where('notam_no', $value['notam_no'])->where('aerodrome', $value['aerodrome'])
                            ->update(array('q_line' => $value['q_line'],
                                'decoded_qline' => $value['decoded_qline'],
                                'e_start_date' => $value['e_start_date'],
                                'e_end_date' => $value['e_end_date'],
                                'description' => $value['description'],
                                'time' => $value['time'],
                                'start_time' => $value['start_time'],
                                'end_time' => $value['end_time'],
                                'datespecific_start_time' => $value['datespecific_start_time'],
                                'datespecific_end_time' => $value['datespecific_end_time'],
                                'sun_start_time' => $value['sun_start_time'],
                                'sun_end_time' => $value['sun_end_time'],
                                'mon_start_time' => $value['mon_start_time'],
                                'mon_end_time' => $value['mon_end_time'],
                                'tue_start_time' => $value['tue_start_time'],
                                'tue_end_time' => $value['tue_end_time'],
                                'wed_start_time' => $value['wed_start_time'],
                                'wed_end_time' => $value['wed_end_time'],
                                'thu_start_time' => $value['thu_start_time'],
                                'thu_end_time' => $value['thu_end_time'],
                                'fri_start_time' => $value['fri_start_time'],
                                'fri_end_time' => $value['fri_end_time'],
                                'sat_start_time' => $value['sat_start_time'],
                                'sat_end_time' => $value['sat_end_time'],
                                'notam_dates' => $value['notam_dates'],
                                'is_daily' => $value['is_daily'],
                                'is_weekly' => $value['is_weekly'],
                                'is_date_specific' => $value['is_date_specific'],
                                'height' => $value['height'],
                                'level' => $value['level'],
                                'raw_data' => $value['raw_data'],
                                'icao' => $value['icao'],
                                // 'is_active' => $value['is_active'],
                                'is_delete' => $value['is_delete'],
                                'is_updated' => 0,
                                'is_update_skipped' => 0,
                                'enable_email' => $value['enable_email'],
                                'updated_at' => $value['updated_at']));
                    // NotamsServerModel::where('notam_no', $value['notam_no'])->where('aerodrome', $value['aerodrome'])
                    //         ->update(array('q_line' => $value['q_line'], 'decoded_qline' => $value['decoded_qline'], 'e_start_date' => $value['e_start_date'], 'e_end_date' => $value['e_end_date'], 'description' => $value['description'], 'time' => $value['time'], 'height' => $value['height'], 'level' => $value['level'], 'raw_data' => $value['raw_data'], 'icao' => $value['icao'],  'is_primary' => $value['is_primary'], 'is_active' => $value['is_active'], 'is_delete' => $value['is_delete']));
                }

       }
       return array('message'=>"Success");
        
    }
    public function exportXls(Request $request) {
        $notams = new NotamsModel;
        $id = $request->id;
        $count = $request->count;
        if (isset($count)) {
            $result = $notams::getLastInsertedNotamsForExcel("%" . $id . "%", $count);
            $result = $result->sortByDesc('aerodrome');
        } else {
            $result = $notams::getByAerodrome("%" . $request->id . "%");
        }
        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');
        if (empty($region[$request->id])) {
            $fileName = $request->id . " Notams download on " . date('Hi') . " of " . date('d-M-y');
        } else {
            $fileName = (@$region[$request->id]) . " Notams download on " . date('Hi') . " of " . date('d-M-y');
        }
        Excel::create($fileName, function($excel) use ($result) {
            $excel->sheet('notam_sheet', function($sheet) use ($result) {
                $sheet->fromModel($result, null, 'A1', true);
                // $sheet->fromModel($result);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    public function api_notams_list(Request $request) {
        $id = $request->id;
        if (!isset($id)) {
            return view('notams_ops.display_list', ['status' => 'success']);
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

        return view('notams_ops.display_list', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id]);
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
        $type = $request->type;

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
            // $key['raw_time'] = str_replace("<br/>", "", $key['raw_time']);
            // $key['raw_data'] = str_replace("<br/>", " ", $key['raw_data']);

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
            }
        }
        if (strlen($id) == 2) {
            $airport = $region[strtolower($id)];
        } else {
            $airport = 'NA';
        }
        if(isset($type)){
            return ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id, 'type' => 'new'];
        }
        // $this->combinedTimeForNotam("%C0034/06%",'weekly');
        // dd($result[0]);
        return view('notams_ops.display_list_fir', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id, 'type' => 'new']);

        return $result;
    }

    public function getNotamTiming(Request $request) {
        $notams = new NotamsModel;
        $res = $notams::getNotamById($request->id);
        if ($res[0]['is_daily']) {
                $res[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $res[0]['notam_no'] . "%", 'daily', $res[0]['aerodrome']);
            } elseif ($res[0]['is_weekly']) {
                $res[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $res[0]['notam_no'] . "%", 'weekly', $res[0]['aerodrome']);
            } elseif ($res[0]['is_date_specific']) {
                $res[0]['formatted_time'] = $this->combinedTimeForNotam("%" . $res[0]['notam_no'] . "%", 'specificDate', $res[0]['aerodrome']);
            }
        return $res;
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
                $formatted_timeObj = array('notam_id' => $key->id, "time" => $key['start_time'] . "-" . $key['end_time'] . " UTC (" . date('Hi', strtotime($key['start_time'] . '+330 minute')) . "-" . date('Hi', strtotime($key['end_time'] . '+330 minute')) . " IST) ");
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
                        $availableDates = $availableDates . $monthNames[intval($monthkey) - 1] . " : " . $value;
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
            preg_match_all('!\d\d\d\d\d\d.\w+!', $key->description, $match);

            if (sizeof($match[0]) > 0) {
                $key['enable_map'] = true;
            } else {
                $key['enable_map'] = false;
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
            }
        }

        $airport = $region[strtolower($id)];
        return view('notams_ops.display_list_fir', ['airport' => $airport, 'notams_array' => $result, 'status' => 'success', 'aero_code' => $id]);
    }

    public function notam_fetch_ui(Request $request) {
        $notams = new NotamsModel;
        $lastUpdatedTime = array('va' => $this->convertDateFormat($notams::getLastupdateTime('va%')->created_at),
            've' => $this->convertDateFormat($notams::getLastupdateTime('ve%')->created_at),
            'vi' => $this->convertDateFormat($notams::getLastupdateTime('vi%')->created_at),
            'vo' => $this->convertDateFormat($notams::getLastupdateTime('vo%')->created_at));
        return view('notams_ops.airport_list', $lastUpdatedTime);
    }

    public function notam_upload_ui(Request $request) {
        $notams = new NotamsModel;
        $lastUpdatedTime = array('va' => $this->convertDateFormat($notams::getLastupdateTime('va%')->created_at),
            've' => $this->convertDateFormat($notams::getLastupdateTime('ve%')->created_at),
            'vi' => $this->convertDateFormat($notams::getLastupdateTime('vi%')->created_at),
            'vo' => $this->convertDateFormat($notams::getLastupdateTime('vo%')->created_at));
        return view('notams_ops.uploadnotamsui', $lastUpdatedTime);
    }

    public function convertDateFormat($date) {
    	// if(!isset($date)){
     //        return $date;

    	// }
        if ($date == 'NA')
            return $date;
        else
            return date_format($date, "d-M-Y H:i:s");
    }

    public function getNotamCount() {
        $delhiFir = "%VI%";
        $kolkataFir = "%VE%";
        $chennaiFir = "%VO%";
        $mumbaiFir = "%VA%";
        $notams = new NotamsModel;
        $lastUpdatedTime = array('va' => $this->convertDateFormat($notams::getLastupdateTime('va%')->created_at),
            've' => $this->convertDateFormat($notams::getLastupdateTime('ve%')->created_at),
            'vi' => $this->convertDateFormat($notams::getLastupdateTime('vi%')->created_at),
            'vo' => $this->convertDateFormat($notams::getLastupdateTime('vo%')->created_at));
        $notamsCount = array('va' => NotamsModel::where('aerodrome', 'like', $mumbaiFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count(),
            've' => NotamsModel::where('aerodrome', 'like', $kolkataFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count(),
            'vi' => NotamsModel::where('aerodrome', 'like', $delhiFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count(),
            'vo' => NotamsModel::where('aerodrome', 'like', $chennaiFir)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->count()
        );
        $notam_airport_count = array('va' => StationwithNotamsModel::where('aero_id', 'like', $mumbaiFir)->where('is_active', '=', 1)->count(),
            've' => StationwithNotamsModel::where('aero_id', 'like', $kolkataFir)->where('is_active', '=', 1)->count(),
            'vi' => StationwithNotamsModel::where('aero_id', 'like', $delhiFir)->where('is_active', '=', 1)->count(),
            'vo' => StationwithNotamsModel::where('aero_id', 'like', $chennaiFir)->where('is_active', '=', 1)->count()
        );
        
        $notUpdatedNotamsCount = array('va' => NotamsModel::where('aerodrome', 'like', $mumbaiFir)->where('is_update_skipped', '=', 1)->count(),
            've' => NotamsModel::where('aerodrome', 'like', $kolkataFir)->where('is_update_skipped', '=', 1)->count(),
            'vi' => NotamsModel::where('aerodrome', 'like', $delhiFir)->where('is_update_skipped', '=', 1)->count(),
            'vo' => NotamsModel::where('aerodrome', 'like', $chennaiFir)->where('is_update_skipped', '=', 1)->count()
        );
        $StationsModel = new StationwithNotamsModel;
        $stations = $StationsModel::get_airport_names_based_on_fir("v%");
        $notams = new NotamsModel;
        $aero_count =  array();
        $aero_count['VE'] =  array();
        $aero_count['VO'] =  array();
        $aero_count['VI'] =  array();
        $aero_count['VA'] =  array();
        foreach ($stations as $key1 => $value1) {
            $result = $notams::getByAerodrome("%" . $value1->aero_id. "%");
            

            array_push($aero_count[substr($value1->aero_id, 0,2)], array('aero_name' => $value1->aero_name,'aerodrome' => $value1->aero_id,'count'=> count($result)));
        }

        return array('lastUpdatedTime' => $lastUpdatedTime, 'airport_count'=>$notam_airport_count,'notamsCount' => $notamsCount, 'notUpdatedNotamsCount' => $notUpdatedNotamsCount, 'individualAirportNotamCount' => $aero_count);
    }

    public function fetch_notams_fir(Request $request) {
        //ini_set('max_execution_time', 300);
        $fir = $request->fir;
        $StationsModel = new StationwithNotamsModel;
        $stations = $StationsModel::get_airport_names_based_on_fir($fir . "%");
        // print_r($stations);
        $updatedCount = 0;
        $this->newlyAdded = 0;
        $this->newNotamsCount = array();
        foreach ($stations as $key) {
        
            $this->store_notams($key->aero_id);
        
        }
        $fir = "%" . $fir . "%";
        $totalCount = NotamsModel::where('aerodrome', 'like', $fir)->count();
        
        $region = array('vi' => 'VIDF (DELHI REGION)', 've' => 'VECF (KOLKATA REGION)', 'vo' => 'VOMF (CHENNAI REGION)', 'va' => 'VABF (MUMBAI REGION)');

        $statsData = array('user_id' => Auth::id(), 
            'name' =>Auth::user()->name , 
            'region' => $region[$request->fir], 
            'count' => $this->newlyAdded);

        NotamStatsModel::insert($statsData);
        return array('message' => 'success', 'updated_count' => $this->newlyAdded, 'total_count' => $totalCount,
            'newNotamsCount'=>$this->newNotamsCount);
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

        return view('notams_ops.display_list', $request);
    }

    public function updateLatLong(Request $request) {
        $id = $request->id;
        $notams = NotamsModel::getNotamById($id);
        $notamsHelpCode=new NotamHelpCodeModel;
        $notamsLatLng = array();
        // echo "<pre/>";
        // print_r($notams);

        foreach ($notams as $key) {

            // preg_match_all('!\d\d\d\d\d\d\w\d\w+!', $key->description, $match);
            preg_match_all('!\d\d\d\d\d\d.\w+!', $key->description, $match);
            preg_match_all('!\d\d\d\d.\w+!', $key->description, $match_short);
            // print_r($match[0]);
            if (sizeof($match[0]) > 0) {
                foreach ($match[0] as $val) {
                    if (strpos($val, "N") !== false || strpos($val, "E") !== false) {

                        if (isset($notamsLatLng[$key->notam_no . "," . $key->aerodrome])) {
                            array_push($notamsLatLng[$key->notam_no . "," . $key->aerodrome], $val);
                        } else {
                            $notamsLatLng[$key->notam_no . "," . $key->aerodrome] = array();
                            array_push($notamsLatLng[$key->notam_no . "," . $key->aerodrome], $val);
                        }
                    }
                }
            }
            else if (sizeof($match_short[0]) > 0) {
                foreach ($match_short[0] as $val) {
                    if (strpos($val, "N") !== false || strpos($val, "E") !== false) {

                        if (isset($notamsLatLng[$key->notam_no . "," . $key->aerodrome])) {
                            array_push($notamsLatLng[$key->notam_no . "," . $key->aerodrome], $val);
                        } else {
                            $notamsLatLng[$key->notam_no . "," . $key->aerodrome] = array();
                            array_push($notamsLatLng[$key->notam_no . "," . $key->aerodrome], $val);
                        }
                    }
                }
            }
        }
        // print_r($notamsLatLng);
        // echo "<br/>";

        $latlngArr = array();
        foreach ($notamsLatLng as $notamValue) {

            foreach ($notamValue as $keys => $latlng) {
                if (strlen($latlng) == 15 || strlen($latlng) == 14) {
                    array_push($latlngArr, array('lat' => $this->dmsToDecimal(explode("N", $latlng)[0]), "lng" => $this->dmsToDecimal(substr((explode("N", $latlng)[1]), 1, 6))));
                } else {
                    if (strpos($latlng, "N") !== false && ($keys + 1) != sizeof($notamValue)) {
                        array_push($latlngArr, array('lat' => $this->dmsToDecimal(substr($notamValue[$keys], 0, 6)), "lng" => $this->dmsToDecimal(substr($notamValue[$keys + 1], 0, 6))));
                    }
                }
            }
        }

        
        foreach ($notams as $key) {
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
            if ($key['is_daily']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'daily', $key['aerodrome']);
            } elseif ($key['is_weekly']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'weekly', $key['aerodrome']);
            } elseif ($key['is_date_specific']) {
                $key['formatted_time'] = $this->combinedTimeForNotam("%" . $key['notam_no'] . "%", 'specificDate', $key['aerodrome']);
            }
        }
        return view('notams_ops.mapview', array('cords' => $latlngArr,'notams_array'=>$notams));
    }

    public function dmsToDecimal($data) {
        return round(substr($data, 0, 2) + (substr($data, 2, 2) / 60) + (substr($data, 4, 2) / 3600), 4);
    }

    public function weatherdownload() {
        $path = public_path('media/pdf/WEATHER_VTZOA VIDP-VABB 18-OCT-2016_2016.pdf');
        return response()->download($path);
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
        $subject= 'BACK UP  FETCH NOTAMS';
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
            Mail::send('emails.notam_remainder', array("cycle" => $notamUpdateCycle[$id], "cur_date" => $cur_date,"type"=>"fetch","regions"=>$missedRegions), function($message) use($subject) {
                $message->from('support@eflight.aero', 'EFLIGHT SUPPORT');
                $message->subject($subject);
                $message->to("ops@eflight.aero");
                $message->cc("prem@eflight.aero");
                $message->bcc("praveenkmr.t@gmail.com");
                // $message->to("praveenkmr.t@gmail.com");
            });
            return "Email send";
        }

        return "Not send";
    }

}
