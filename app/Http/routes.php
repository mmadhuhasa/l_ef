<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//without api routes
require __DIR__ . '/routes/api.php';

//without authentication routes
require __DIR__ . '/routes/beforeauth.php';

Route::get('navemail', function(){
    $data = ['email' => 'dev.eflight@pravahya.com',
             'subject' => 'CALL SIGN NAV LOG REQUEST // DATE OF FLIGHT'];
   dispatch(new \App\Jobs\Navlog\NavlogJob($data)); 
   return 1;
});

//For testing local routes
if (env('APP_ENV') == 'local') {
    require __DIR__ . '/routes/local.php';
}

//If Authentication success
Route::group(['middleware' => 'auth'], function() {
    require __DIR__ . '/routes/afterauth.php';
    require __DIR__ . '/routes/weather.php';
});

//If Authentication success and the user is admin     
Route::group(['middleware' => 'eflightadmin'], function() {
    require __DIR__ . '/routes/admin.php';
});

//If exception happend throw 404 or 503 pages
require __DIR__ . '/routes/exceptions.php';

Route::get('sendemail', function () {
    $data = array(
        'name' => "Learning Laravel",
    );
    Mail::send('emails.welcome', $data, function ($message) {
        $message->from('suuport@eflight.aero', 'Learning Laravel');
        $message->to('dev.eflight@pravahya.com')->subject('Learning Laravel test email');
    });
    return "Your email has been sent successfully";
});

////Added by naresh
//Route::get('weatherGeoLookUp/{location}', 'WeatherController@geoLookUp');
//Route::get('weatherForecast/{location}', 'WeatherController@forecast');
//Route::get('metar/{location}', 'WeatherController@getMetAbbreviation');
//
//Route::any('autoCompleteAirports', 'WeatherController@autoCompleteLocation');
//
////Route::get('getAirportWeather1/{location}', 'WeatherController@getAirportLocationWeather1');
//Route::any('getAirportWeather', 'WeatherController@getAirportLocationWeather');
//Route::get('loadwather/', 'WeatherController@loadwather');
//
//
//Route::get('metarAuto', 'MetarController@index');
////Google geo links
//Route::get('weatherGoogleGeoLookUp/{location}', 'GoogleWeatherController@geoLookUp');
//Route::get('weatherGoogleForecast/{location}', 'GoogleWeatherController@forecast');
//Route::any('getGoogleWeather', 'GoogleWeatherController@getAirportLocationWeather');


Route::get('excel', function() {

    $result = App\models\ExcelModel::all();
    foreach ($result as $value) {
        $signdata = App\models\ExcelModel::getsigndata($value->Date);
        $sign_calc = date('H:i', strtotime($signdata->SignOff) - strtotime($signdata->SignOn));
        $Block_calc = date('H:i', strtotime($signdata->OnBlock) - strtotime($signdata->OffBlock));
        $count = App\models\ExcelModel::landings($value->Date);
        $data = ['duty_tyme' => $sign_calc, 'flying_time' => $Block_calc, 'landings' => $count];
        $result = App\models\ExcelModel::update_data($value->Date, $data);
    }
    return 1;



//     $maxSignOff = App\models\ExcelModel::maxSignOff($value->Date);
//	 $minSignOn = App\models\ExcelModel::minSignOn($value->Date);
//	$maxOnBlock = App\models\ExcelModel::maxOnBlock($value->Date);
//	$minOffBlock = App\models\ExcelModel::minOffBlock($value->Date);
//	$sign_calc = date('H:i', strtotime($maxSignOff) - strtotime($minSignOn));
//	$Block_calc = date('H:i', strtotime($maxOnBlock) - strtotime($minOffBlock));
//	$count = App\models\ExcelModel::landings($value->Date);
//	$data = ['duty_tyme' => $sign_calc, 'flying_time' => $Block_calc, 'landings' => $count];
//	$result = App\models\ExcelModel::update_data($value->Date, $data);
});


Route::get('xml2', function() {
    $xml = simplexml_load_file("http://notams.euroutepro.com/notams.xml") or die("Error: Cannot create object");
    echo '<pre>';
    print_r($xml);
    echo '</pre>';
});

Route::get('json/{id?}', function($id) {
    $json = file_get_contents("http://api.vateud.net/notams/" . $id . ".json");
//    $description = str_replace(array("\r\n","\r","\n"),"<br/>", $json);
    $json = str_replace("\\n", '<br/>   ', $json);

    $notams_array = json_decode($json);
//    echo '<pre>';print_r($notams_array);
//echo '</pre>';

    foreach ($notams_array as $key => $object) {
        echo $object->raw;
        echo '<BR>';
    }
});


Route::get('weatherjson', function() {
    $stations_list = App\models\StationsModel::where('is_active', '1')->where('aero_id', '!=', 'ZZZZ')->orderBy('id', 'desc')->get()->take(20);
    foreach ($stations_list as $stations_list_value) {
        $id = $stations_list_value->aero_id;
        $json = file_get_contents("http://avwx.rest/api/metar.php?station=" . $id . "&format=json");
        $notams_array = json_decode($json, TRUE);
//	echo '<pre>';print_r($notams_array);echo '</pre>';exit;
        if (is_array($notams_array)) {
            echo $Raw_Report = (array_key_exists('Raw-Report', $notams_array)) ? $notams_array['Raw-Report'] : '';
            echo ($Raw_Report) ? '</br>' : '';
        }
    }
});

Route::get('weatherapi', function() {
    $array = ['VEAT', 'VAAH', 'VIAR', 'VAAU', 'VOBL', 'VABO', 'VEBS', 'VOMM', 'VOCB'
        , 'VCBI', 'VIDP', 'VIDN', 'VEGT', 'VEGY', 'VIGG', 'VERB', 'VOHS', 'VEIM', 'VAID', 'VIJP', 'VEKO'];
    foreach ($array as $value) {
        $json = file_get_contents("http://avwx.rest/api/metar.php?station=" . $value . "&format=JSON");
        $json = json_decode($json, TRUE);
        if (is_array($json)) {
            $Report = (array_key_exists('Raw-Report', $json)) ? $json['Raw-Report'] : '';
            $Station = (array_key_exists('Station', $json)) ? $json['Station'] : '';

            $airport_details = App\models\StationsModel::get_aerodrome_details($Station);
            $station_id = ($airport_details) ? $airport_details->id : '';

            $data = ['airport_code' => $Station,
                'station_id' => $station_id,
                'raw_report' => $Report, 'is_active' => 1];
            $result = \App\models\WeatherDataModel::create($data);
        }
    }
    return 'Success';
});

Route::get('weatherapi2', function() {
    $array2 = ['VOCI', 'VECC', 'VOCL', 'VILK', 'VILD', 'VOMD', 'VEMN', 'VABB', 'VANP', 'VIPT', 'VEPT', 'VERP',
        'VIDD', 'VISM', 'VERC', 'VOTR', 'VOTV', 'VAUD', 'VEBN', 'VOVZ', 'VRMM', 'VRMG', 'VNKT', 'VGHS',
        'VCBI', 'OPKC', 'OPLA', 'VILH', 'VISR', 'VIJU', 'VEBD', 'VIGR', 'VAPO', 'VICG'];
    foreach ($array2 as $value) {
        $json = file_get_contents("http://avwx.rest/api/metar.php?station=" . $value . "&format=JSON");
        $json = json_decode($json, TRUE);
        if (is_array($json)) {
            $Report = (array_key_exists('Raw-Report', $json)) ? $json['Raw-Report'] : '';
            $Station = (array_key_exists('Station', $json)) ? $json['Station'] : '';
            $airport_details = App\models\StationsModel::get_aerodrome_details($Station);
            $station_id = ($airport_details) ? $airport_details->id : '';

            $data = ['airport_code' => $Station,
                'station_id' => $station_id,
                'raw_report' => $Report, 'is_active' => 1];
            $result = \App\models\WeatherDataModel::create($data);
        }
    }
    return 'Success';
});

Route::get('weather/api/list', function() {
    $data = \App\models\WeatherDataModel::list_of_raw_data();
//    $data = json_decode(json_encode($data), true);
//    print_r($data);exit;
    return view('weather.weather_list', ['data' => $data]);
});



// Route::group(['namespace' => 'Notams'], function () {
//     Route::group(['prefix' => 'notams'], function () {
// 	Route::resource('/', 'NotamsController');
// 	Route::get('list/{id?}', 'NotamsController@api_notams_list');
//     });
// });
//Route::group(['namespace' => 'LoadAndTrim'], function() {
//    Route::group(['prefix' => 'lnt'], function() {
//	Route::resource('/', 'LoadAndTrimController');
//	Route::post('get_trim_setting', 'LoadAndTrimController@get_trim_setting');
//    });
//});
Route::group(['namespace' => 'excel'], function() {
    Route::resource('excels', 'ExcelController');
});

Route::get('imagepdf', function() {

    $img = url('media/pdf/fpl/pdfbg.png');


    echo ' <img src="https://www.eflight.aero/media/pdf/fpl/pdfbg.png" />     ';
});

//use Illuminate\Support\Facades\Storage;
Route::get('s3down/{id}', function($id) {
    
    $lr_details = \App\models\lr\LicenseDetailsModel::get_license_details($id);
    
    $file_name = ($lr_details) ? $lr_details->file_name : '';
    $user_name = ($lr_details) ? $lr_details->user_name : '';
    $mime = ($lr_details) ? $lr_details->mime_type : '';
    $file_original_name = ($lr_details) ? $lr_details->file_original_name : '';
    $assetPath = Storage::disk('s3')->url("media/$user_name/lr/$file_name");

    header("Cache-Control: public");
    header("Content-Description: File Transfer");
//    header("Content-Disposition: attachment; filename=" . $file_original_name);
    header("Content-Type: " . "$mime");

    return readfile($assetPath);
    
    return response()->file($assetPath);
});
