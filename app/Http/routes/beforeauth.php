<?php
//use PDF;

Route::get('/redis2', function() {
    $redis = app()->make('redis');
    print_r($redis);
});
Route::get('/testsumit', function() {
  return "hii";
});
Route::get('/fdtltest', function () {
   return view('fdtl.fdtltest');
});

Route::get('/statistic', function () {
   return view('stats');
});
Route::get('/fpltest', function () {
   return view('fpl.fpltest');
});
Route::get('watchhours/expire-alert', 'Notams\WatchHoursController@watchhoursExpiryAlert');
Route::get('watchhours/expired-alert', 'Notams\WatchHoursController@watchhoursExpiredAlert');
// Authentication routes...
Route::get('account/login', 'Auth\AuthController@getLogin');
Route::post('account/login', 'Test\TestController@check');
//Route::post('account/login', 'Auth\AuthController@postLogin');
Route::get('account/logout', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('account/register', 'Auth\AuthController@getRegister');
Route::post('account/register', 'Auth\AuthController@postRegister');
//Authenticate User
Route::post('authenticate_user', 'CustomAuthController@authenticate_user');

Route::post('forgot_password', 'Auth\AuthController@forgot_password');
Route::get('password/reset', 'Auth\AuthController@reset_password');
Route::post('password/reset', 'Auth\AuthController@post_reset_password');

Route::post('change_password', 'Auth\AuthController@change_password');

Route::get('get_user_details', 'Auth\AuthController@get_user_details');


Route::get('sign-up', 'CustomAuthController@signup');



Route::group(['namespace' => 'Home'], function() {
    Route::resource('/','HomeController');
    Route::post('contact-us', 'HomeController@contact_form');
    Route::get('contact-us','HomeController@contact_us');
    Route::get('about-us','HomeController@about_us');
    Route::get('contact-us2','HomeController@contact_us2');
    Route::get('cfp2','HomeController@cfp2');
    Route::post('update_user','HomeController@update_user');
    Route::post('update_user_fav','HomeController@update_user_fav');
    Route::get('getuser','HomeController@getuser');
    Route::put('remove_fav','HomeController@remove_fav');
    Route::get('getairportlist','HomeController@getAirportList');
Route::post('change_profile_password', 'HomeController@change_password');

});

Route::resource('/queue','HomeController');
Route::get('/send','HomeController@send');

Route::get('site-register', 'Auth\AuthController2@siteRegister');
Route::post('site-register', 'Auth\AuthController2@siteRegisterPost');

Route::group(['namespace'=>'tripsupport','prefix'=>'trip-support'], function(){
   Route::resource('/','TripSupportController'); 
});


Route::get('airport','AirportController@index');

Route::post('airport','AirportController@index_post');

Route::get('validate_airport','AirportController@validate_airport');
Route::get('autosuggest_post','AirportController@autosuggest_post');


Route::get('remainderEmail','NotamsOps\NotamsOpsController@remainderEmail');
Route::get('remainderEmailForUpload','Notams\NotamsController@remainderEmail');
Route::get('backupFetchDB', 'NotamsOps\NotamsOpsController@sendEmailBackup');
Route::get('backUpViewDB', 'Notams\NotamsController@sendEmailBackup');



Route::get('verify-reminder-email','Notams\SuperwiseController@reminderEmail');
//Route::get('watchhours/expire-alert', 'Notams\WatchHoursController@watchhoursExpiryAlert');
Route::get('riseset', 'SunriseController@index');
Route::post('riseset', 'SunriseController@store');

Route::post('search','AirportController@search');
Route::get('autosuggest','AirportController@autosuggest');
Route::get('airport/{apcode}/{apname}','AirportController@ap_info');
//Route::get('airport/vtssf','AirportController@vtssf');

Route::get('sidpopup',function(){
    return view('airport.sid_table');
});
Route::get('starpopup',function(){
    return view('airport.star_table');
});
Route::get('starpopup',function(){
    return view('airport.star_table');
});
Route::get('approachpopup',function(){
    return view('airport.approach_table');
});
Route::get('apronpopup',function(){
    return view('airport.apron_table');
});

Route::get('ltrim_vtnma',function(){
    return view('ltrim.vtnma.show');
});
 Route::post('calculate','LoadAndTrimController@calculate');
 Route::post('vtanfcalculate','LoadAndTrimController@vtanf_calculate');
 Route::get('weather_form','WeatherController@weather_get');
 Route::post('weather_form','WeatherController@weather_parse');
 Route::get('taf_form','WeatherController@taf_get');
 Route::post('taf_form','WeatherController@taf_parse');
 /*Route::get('add_licence_user','AirportController@add_licence_user');
 Route::get('add_licence_detail','AirportController@add_licence_detail');
 Route::get('add_vtauv_fuel','AirportController@vtauv'); */
 Route::get('vtram',function(){
    return view('ltrim.vtram.store');
 });
 Route::get('vtmam',function(){
    return view('ltrim.vtmam.store');
 });
  Route::get('vtsrc',function(){
    return view('ltrim.vtsrc.store');
 });
   Route::get('vtehb',function(){
    return view('ltrim.vtehb.store');
 });
 Route::get('vtdbc',function(){
    return view('ltrim.vtdbc.store');
 });  
Route::get('vtgkb',function(){
    return view('ltrim.vtgkb.store');
 });  
Route::get('vtejz',function(){
    return view('ltrim.vtejz.store');
 }); 
 Route::get('vtltc',function(){
    return view('ltrim.vtltc.store');
 });  

// Route::get('vtjhp',function(){
//     dd("ss");
//    // return view('ltrim.vtjhp.pdf');
//     $pdf = \PDF::loadView('ltrim.vtjhp.pdf');
//    return $pdf->stream('vtjhp.pdf');
//  });  

 
 Route::group(['prefix' => 'ccavenue', 'namespace' => 'Payment'], function() {
    Route::get('ccavenue_response1', 'CcavenueController@ccavenue_response');
    Route::post('ccavenue_response', 'CcavenueController@ccavenue_response');
});