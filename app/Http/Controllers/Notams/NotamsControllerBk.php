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
use App\models\NotamCoordinatesModel;
use App\models\CoordinatesModel;
use App\models\StationsModel;

class NotamsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
	return view('notams.notam_update');
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

    public function api_notams_list(Request $request) {
	$id = $request->id;
	$json = file_get_contents("http://api.vateud.net/notams/" . $id . ".json");
	$json = str_replace("\\n", '<br/>   ', $json);

	$notams_array = json_decode($json);
//    echo '<pre>';print_r($notams_array);
//echo '</pre>';
//	foreach ($notams_array as $key => $object) {
//	    echo $object->raw;
//	    echo '<BR>';
//	    echo $object->message;
//	    echo '<BR>';
//	    echo '<BR>';
//	}

	$stations = \App\models\StationsModel::where('is_active', 1)->where('aero_id', $id)->first();
	$airport = ($stations) ? $stations->aero_name : '';

	return view('notams.display_list', ['notams_array' => $notams_array, 'airport' => $airport]);
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
	    
	    $from_mon_name = (array_key_exists("$from_month - 1",$monthNames)) ? $monthNames[$from_month - 1] : 'Jan';
	    $to_mon_name = (array_key_exists("$to_month - 1",$monthNames)) ? $monthNames[$to_month - 1] :  'Jan';
	    
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
    
    public function download(){
	$path = public_path('media/pdf/NOTAMS 18.OCT.2016.pdf');
	return response()->download($path);
    }
    
    public function weatherdownload(){
	$path = public_path('media/pdf/WEATHER_VTZOA VIDP-VABB 18-OCT-2016_2016.pdf');
	return response()->download($path);
    }

}
