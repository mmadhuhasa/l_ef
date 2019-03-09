<?php

Route::get('/home', function () {
    return redirect('/fpl');
});
Route::get('/handlingorder', function () {
    return view('handler.order');
});
Route::get('/watch', function () {
    return view('notams.watchhours_list_new');
 
});
Route::get('/newaircraft_email', function () {
    return view('emails.newaircraft.signup');
 
});
Route::group(['namespace' => 'Newaircraft'], function() {
    Route::get('newaircraft_pdf',function(){
           return view('newaircraft.pdf');
 
    });
     Route::get('newaircraft','NewaircraftController@index');
     Route::post('newaircraft','NewaircraftController@store');
     Route::get('newaircraft_autosuggest','NewaircraftController@AutoSuggest');
     Route::get('newaircraft_callsign_check','NewaircraftController@callsign_check');
});
Route::group(['namespace' => 'Emailtracker'], function() {
    Route::get('emails','EmailtrackerController@index');
    Route::post('emails/store','EmailtrackerController@store');
    Route::post('emails/update','EmailtrackerController@update');
    Route::post('emails/delete','EmailtrackerController@delete');
    Route::post('emails','EmailtrackerController@filter');
    Route::get('emails/viewhistory', 'EmailtrackerController@ViewHistory');
    Route::get('auto_remainder/{status}', 'EmailtrackerController@email_tracker_auto_remainder');
    Route::get('auto_remainder_time/{status}/{time}', 'EmailtrackerController@email_tracker_auto_remainder_time');
    Route::get('auto_remainder_status_conversion', 'EmailtrackerController@email_tracker_auto_remainder_status_conversion');
   

});
Route::group(['namespace' => 'Home'], function() {
    Route::get('profile', 'HomeController@profile');
    Route::get('pilot_profile', 'HomeController@pilot_profile');
});
Route::group(['namespace' => 'Handler'], function() {
   Route::get('handling','HandlerController@index');
   Route::post('handling/store','HandlerController@store');
   Route::post('handlinglist', 'HandlerController@handlinglist');
   Route::post('handling', 'HandlerController@Search');
   Route::post('handling/update', 'HandlerController@Update');
   Route::post('handling/update-handler', 'HandlerController@UpdateHandler');
   Route::get('handling/viewhistory', 'HandlerController@ViewHistory');
   Route::get('handling/autosuggest_handler', 'HandlerController@AutoSuggestHandler');
   Route::post('handling/autosuggest_handler_airportcode', 'HandlerController@AutoSuggestHandlerAirportcode');
   Route::post('handling/autosuggest_callsign_airportcode', 'HandlerController@AutoSuggestCallsignAirportcode');
   Route::post('handling/autosuggest_handler_callsign_airportcode', 'HandlerController@AutoSuggestHandlerCallsignAirportcode');
   Route::get('handling/autosuggest_callsign','HandlerController@AutoSuggestCallsign');
   Route::get('handlingorder','HandlerOrderController@index');
   Route::post('handlingorder','HandlerOrderController@Search');
   Route::post('handlingorder/post','HandlerOrderController@order');
   Route::get('vieworderedhistory','HandlerOrderController@OrderHistory');
   Route::get('handler_info','HandlerOrderController@HandlerInfo');
   Route::post('handler_info','HandlerOrderController@UpdateHandlerInfo');
   Route::get('handling/autosuggest_operator','HandlerOrderController@AutoSuggestOperator');

   
});    
Route::group(['namespace' => 'Navlog'], function() {
    Route::get('navlog_file_plan/{id?}', 'NavlogController@file_plan');
    Route::get('pending_cancelled_completed', 'NavlogController@pending_cancelled_completed');
    Route::post('change_fic_adc', 'NavlogController@change_fic_adc');
    Route::post('update_navlog', 'NavlogController@update');
    Route::post('update_test_navlog', 'NavlogController@test_update');
    Route::get('edit_navlog', 'NavlogController@EditNavlog');
    Route::get('get_last_destination', 'NavlogController@LastDestination');
    Route::get('get_flying_time', 'NavlogController@FlyingTime');
    Route::get('get_last_flight_flying_time', 'NavlogController@LastflightFlyingTime');
    Route::post('navlog_cancel', 'NavlogController@navlog_cancel');
    Route::post('navlog_revice_time', 'NavlogController@revice_time');
    Route::post('navlog_get_filter_data', 'NavlogController@get_filter_data');
    Route::post('navlog_get_test_filter_data', 'NavlogController@get_test_filter_data');
    Route::post('navlog_modal_popups', 'NavlogController@modal_popups');
    Route::get('navlog','NavlogController@index');
    Route::get('change_navlog','NavlogController@edit');
    Route::post('navlog','NavlogController@store');
    Route::post('navlog_test','NavlogController@test_store');
    Route::get('navlog/search_filter','NavlogController@search_filter');
    Route::get('get_airport_name', 'NavlogController@AirportName');
    Route::get('get_time_diff', 'NavlogController@TimeDiff');
    Route::get('autofill_route', 'NavlogController@AutofillRoute');
    Route::post('navlog/copilot', 'NavlogController@copilot');
    Route::get('get_pax_no', 'NavlogController@NoOfPax');
    Route::get('get_max_fuel', 'NavlogController@Maxfuel');
    Route::get('get_speed_list', 'NavlogController@SpeedList');
    Route::get('navlog_list', 'NavlogController@navlog_list');
    Route::get('test_navlog_list', 'NavlogController@test_navlog_list');
    Route::get('navlog/test', 'NavlogController@test_index');
    Route::post('navlog_info_update','NavlogController@navlog_info_update');
    Route::get('navlog/autosuggest', 'NavlogController@AutoSuggest');
});

Route::group(['namespace' => 'Notams'], function () {
    Route::group(['prefix' => 'notams'], function () {
        Route::resource('/', 'NotamsController');
        Route::post('/filter', 'NotamsController@filter');
        Route::post('/fplnotamsfilter', 'NotamsController@fplnotamsfilter');
        Route::post('/uploadxls', 'NotamsController@uploadxls');
        Route::post('/fplnotams', 'NotamsController@fplnotams');
        Route::get('list/{id?}', 'NotamsController@api_notams_list');
        Route::get('list2/{id?}', 'NotamsController@api_notams_list2');
        Route::get('fetchnotams', 'NotamsController@notam_fetch_ui');
        Route::get('upload', 'NotamsController@notam_upload_ui');
        Route::get('getnotambyfir', 'NotamsController@getnotambyfir');
        Route::get('getnotamcount', 'NotamsController@getNotamCount');
        Route::get('fetchnotams_fir', 'NotamsController@fetch_notams_fir');
        Route::post('update', 'NotamsController@update_notams_description');
        Route::get('updatepending', 'NotamsController@update_pending_view');
        Route::get('getrecentnotam', 'NotamsController@getrecentnotam');
        Route::post('updatestatus', 'NotamsController@updatestatus');
        Route::post('updateemailstatus', 'NotamsController@updateemailstatus');
        Route::post('download/{id?}', 'NotamsController@download');
        Route::post('download', 'NotamsController@download');
        Route::get('exportxls', 'NotamsController@exportXls');
        Route::get('expirednotams', 'NotamsController@expiredNotams');
        Route::get('weatherdownload', 'NotamsController@weatherdownload');
        Route::get('getcategorylist', 'NotamsController@getCategorylist');
        Route::get('updatelasttime', 'NotamsController@updatelasttime');
        Route::get('getnotamcountforairport/{id}', 'NotamsController@getNotamCountForAirport');
        Route::get('airport/{airportcode}', 'NotamsController@notamsbyairport');
        Route::get('sendEmailBackup', 'NotamsController@sendEmailBackup');
        Route::get('findAirport', 'NotamsController@findAirport');

        Route::post('supervise/pending', 'SuperwiseController@showAllPending');
        Route::get('supervise/stats', 'SuperwiseController@supervisor_stats');
        Route::get('supervise/getpending', 'SuperwiseController@getPendingList');
        Route::get('supervise/updatelastseen', 'SuperwiseController@setLastViewedTime');
        Route::resource('supervise', 'SuperwiseController');
    });
    Route::get('watchhours/getWatchhoursInfo', 'WatchHoursController@getWatchhoursInfo');
    Route::get('watchhours/getpreviousdata', 'WatchHoursController@getpreviousdata');
    Route::get('watchhours/aerodromelist', 'WatchHoursController@aerodromelist');
    Route::get('watchhours/filter', 'WatchHoursController@filter');
    Route::get('watchhours_airport/find', 'WatchHoursController@find');
    Route::get('watchhours_airport/search', 'WatchHoursController@search');
    Route::get('watchhours_airport/newsearch', 'WatchHoursController@newsearch');
    Route::get('watchhours_testpdf', 'WatchHoursController@testpdf');
    Route::get('watchhours_favpdf', 'WatchHoursController@fav_pdf');
    Route::get('watchhours_region_pdf', 'WatchHoursController@region_pdf');
    Route::get('watchhours_searchedpdf', 'WatchHoursController@searched_pdf');
    Route::get('watchhours_viewhistory', 'WatchHoursController@ViewHistory');
    Route::get('watchhours_search_airport', 'WatchHoursController@search_airport');
    Route::resource('watchhours', 'WatchHoursController');
    //Route::get('watchhours_new', 'WatchHoursController@new_index');
    Route::post('delete_watch', 'WatchHoursController@delete_watch');
    Route::post('watchhours/add-airport','WatchHoursController@AddAirport');
});

Route::group(['namespace' => 'Fpl'], function () {
    Route::group(['prefix' => 'fpl'], function () {
        Route::resource('/', 'fplController');
        Route::resource('quick', 'fplController@quick_plan');
        Route::post('get_callsign_details', 'fplController@get_callsign_details');
        Route::post('get_callsign_details2', 'fplController@get_callsign_details2');
        Route::get('stations_autocomplete', 'fplController@stations_autocomplete');
        Route::post('station_latlong', 'fplController@station_latlong');
        Route::post('process_quick_plan', 'fplController@process_quick_plan');
        Route::post('filter_plans', 'fplController@filter_plans');
        Route::resource('new_quick', 'fplController@new_quick');
        Route::resource('new_full', 'fplController@new_full');
        Route::resource('new_edit', 'fplController@new_edit');
//        Route::resource('file_plan', 'fplController@file_plan');
        Route::post('check_callsign_exist', 'fplController@check_callsign_exist');
        Route::resource('new_plan', 'fplController@new_plan');
        Route::resource('on_edit_plan', 'fplController@on_edit_plan');
        Route::resource('edit_process', 'fplController@edit_process');
        Route::resource('file_the_process', 'fplController@file_the_process');
        Route::post('pilot_in_command', 'fplController@pilot_in_command');
        Route::post('get_pilot_details', 'fplController@get_pilot_details');
        Route::post('copilot', 'fplController@copilot');
        Route::get('file_plan/{id?}', 'fplController@file_plan');
        Route::get('station_addresses', 'fplController@station_addresses');
        Route::get('get_airports_list', 'fplController@get_airports_list');
        Route::get('get_plan_status', 'fplController@get_plan_status');



         Route::group(['middleware' => 'eflightadmin'], function() {
            Route::get('fuel', 'fplController@fuel');
        });



        Route::get('get_watch_hours', 'WatchHourController@get_watch_hours');

        Route::get('export/{dof}', function($dof) {
            $is_admin = \Illuminate\Support\Facades\Auth::user()->is_admin;
            if (!$is_admin) {
                return 'fail';
            } else {
                $notams = App\models\FlightPlanDetailsModel::where('date_of_flight', $dof)->get();
                $fileName = " FPL download on " . date('Hi') . " of " . date('d-M-Y');
                Excel::create($fileName, function($excel) use ($notams) {
                    $excel->sheet('notam_sheet', function($sheet) use ($notams) {
                        $sheet->fromModel($notams);
                        $sheet->setOrientation('landscape');
                    });
                })->export('xls');
            }
        });
    });

    Route::group(['prefix' => 'new_fpl'], function() {
        Route::resource('/', 'NewfplController');
        Route::get('quick_plan', 'NewfplController@quick_plan');

        Route::resource('fpl_list', 'NewfplController@fpl_list');
        Route::post('get_filter_data', 'NewfplController@get_filter_data');
        Route::post('modal_popups', 'NewfplController@modal_popups');
        Route::get('get_auto_num_details', 'NewfplController@get_auto_num_details');

        Route::resource('change_fic_adc', 'NewfplController@change_fic_adc');
        Route::resource('revice_time', 'NewfplController@revice_time');
        Route::post('fpl_cancel', 'NewfplController@fpl_cancel');
        Route::resource('change_plan', 'NewfplController@change_plan');
        Route::resource('pilot_details', 'PilotDetailsController');
        Route::get('auto_operator', 'NewfplController@auto_operator');
        Route::get('auto_callsigns', 'NewfplController@auto_callsigns');
    });

    Route::group(['prefix' => 'notifications'], function() {
        Route::post('onclick', 'WebNotificationController@onclick');
        Route::post('onclose', 'WebNotificationController@onclose');
    });

    // Route::group(['prefix' => 'fuel', 'middleware' => 'eflightadmin'], function() {
    Route::group(['prefix' => 'fuel'], function() {
        Route::post('update', 'FuelController@fuel_update');
        Route::get('download_excel', 'FuelController@download_excel');
        Route::get('list', 'FuelController@fuel_list');
        Route::post('get_filter_fuel', 'FuelController@get_filter_fuel');
        Route::get('fuel_count', 'FuelController@fuel_count');
        Route::get('price', 'FuelController@fuel_price');
        Route::post('order', 'FuelController@order');
        Route::get('get_price_data', 'FuelController@get_price_data');
        Route::get('get_call_ops', 'FuelController@get_call_ops');
    });
    
});

Route::group(['prefix' => 'fpl/fuelprice'], function() {
    Route::get('/', 'FuelpriceController@index');
    Route::post('add-airport', 'FuelpriceController@AddAirport');
    Route::post('update-fuelprice', 'FuelpriceController@UpdateFuelPrice');
    Route::post('add-fuelprice', 'FuelpriceController@AddFuelPrice');
    Route::get('autosuggest', 'FuelpriceController@AutoSuggest');
    Route::post('/', 'FuelpriceController@SearchFilter');
    Route::get('/viewhistory', 'FuelpriceController@ViewHistory');
});
//Route::group(['namespace' => 'LoadAndTrim'], function() {
//    Route::group(['prefix' => 'lnt'], function() {
//	Route::resource('/', 'LoadAndTrimController');
//	Route::post('get_trim_setting', 'LoadAndTrimController@get_trim_setting');
//    });
//});

Route::group(['namespace' => 'Navlog'], function() {
    Route::group(['prefix' => 'xml'], function() {
        Route::resource('/', 'NavlogController');
    });
});


Route::group(['namespace' => 'LoadAndTrim'], function() {

    Route::get('pilot_autosuggest', 'LoadAndTrimController@autosuggest_pilot');
    Route::get('copilot_autosuggest', 'LoadAndTrimController@autosuggest_copilot');
    Route::get('vtobrpdf', 'VtobrController@ltrimpdf');
    Route::group(['prefix' => 'loadtrim/{callsign?}'], function($callsign = '') {
        Route::resource('/', 'LoadAndTrimController');
    });
    Route::group(['prefix' => 'postlnt'], function() {
        Route::resource('/', 'LoadAndTrimController');
        Route::post('get_trim_setting', 'LoadAndTrimController@get_trim_setting');
        Route::get('print_lnt', 'LoadAndTrimController@print_lnt');
        Route::post('trim_setting', 'LoadAndTrimController@trim_setting');
        Route::post('insert_lnt_values', 'LoadAndTrimController@insert_lnt_values');
        Route::get('get_zfg_cg', 'LoadAndTrimController@get_zfg_cg');
        Route::post('save_lnt_data', 'LoadAndTrimController@save_lnt_data');
        Route::get('merge_pdfs', 'LoadAndTrimController@merge_pdfs');
        Route::post('upload', 'LoadAndTrimController@upload');
    });

    Route::group(['prefix' => 'load'], function() {
        Route::group(['prefix' => 'vtajj'], function() {
            Route::resource('/', 'VtajjController');
        });
    });
});

Route::group(['namespace' => 'Adc'], function () {
    Route::group(['prefix' => 'adc'], function() {
        Route::resource('/', 'AdcController');
    });
});

Route::group(['namespace' => 'Lr'], function() {
    Route::group(['prefix' => 'lr'], function() {
        Route::resource('/', 'LRController');
        Route::get('list', 'LRController@lr_list');
        Route::get('license-types', 'LRController@license_types');
        Route::get('license-types-list', 'LRController@license_types_list');
        Route::get('add-license-type', 'LRController@add_license_type');
        Route::get('users', 'LRController@users_list');
        Route::post('add-users', 'LRController@add_users');
        Route::get('history/{id?}', 'LRController@lr_history');
        Route::get('history/list', 'LRController@lr_history_list');
        Route::post('lr-filter', 'LRController@lr_filter');
        Route::get('get_license_details', 'LRController@get_license_details');
        Route::post('add_license_details', 'LRController@add_license_details');
        Route::post('delete_license', 'LRController@delete_license');
        Route::post('edit_license', 'LRController@edit_license');

        Route::get('autocomplete_user_name', 'LRController@autocomplete_user_name');
        Route::get('autocomplete_license_type', 'LRController@autocomplete_license_type');
        Route::get('pdf/{id?}', 'LRController@pdf');
        Route::post('get-lr-count', 'LRController@get_lr_count');
        Route::post('get_history_details', 'LRController@get_history_details');
        Route::get('test_email', 'LRController@test_email');
        Route::get('auto_remainder', 'LRController@auto_remainder');
        Route::get('get_operators', 'LRController@get_operators');

        Route::get('users_upload_page', 'LRController@users_upload_page');
        Route::get('lr_upload_page', 'LRController@lr_upload_page');

        Route::post('users_upload', 'LRController@users_upload');
        Route::post('lr_upload', 'LRController@lr_upload');

        Route::get('user_excel_download', 'LRController@user_excel_download');
        Route::get('lr_excel_download', 'LRController@lr_excel_download');
    });
});
Route::get('ltrimround', 'LoadAndTrimController@ltrimround');
Route::get('ltrim_graph', 'LoadAndTrimController@ltrim_graph');
Route::get('ltrimpdf/{name}', 'LoadAndTrimController@pdf');

Route::get('fplupload', function() {
    return view('fpl.getfplupload');
});

Route::post('fplupload', function() {
    try {
        ini_set('max_execution_time', 300);
        $is_admin = \Illuminate\Support\Facades\Auth::user()->is_admin;
        if (!$is_admin) {
            return 'fail';
        }
        $fplInfo = array();
        $this->j = 0;
        $this->k = 0;
        Excel::load(Input::file('fx'), function($reader) use($fplInfo) {
            $results = $reader->get();
            foreach ($results as $results_value) {
                $json_res = json_encode($results_value);
                $json_res2 = json_decode($json_res, TRUE);
                unset($json_res2['id']);
                unset($json_res2['is_app']);
                unset($json_res2['updated_by']);

                $aircraft_callsign = $json_res2['aircraft_callsign'];
                $departure_aerodrome = $json_res2['departure_aerodrome'];
                $destination_aerodrome = $json_res2['destination_aerodrome'];
                $departure_time_hours = $json_res2['departure_time_hours'];
                $departure_time_minutes = $json_res2['departure_time_minutes'];
                $date_of_flight = $json_res2['date_of_flight'];
                $plan_status = $json_res2['plan_status'];

                $fpl_count = App\models\FlightPlanDetailsModel::where('aircraft_callsign', $aircraft_callsign)
                                ->where('departure_aerodrome', $departure_aerodrome)
                                ->where('destination_aerodrome', $destination_aerodrome)
                                ->where('date_of_flight', $date_of_flight)
                                ->where('departure_time_hours', $departure_time_hours)
                                ->where('departure_time_minutes', $departure_time_minutes)
                                ->where('plan_status', $plan_status)->count();

                if ($fpl_count) {
                    $fpl_update = App\models\FlightPlanDetailsModel::where('aircraft_callsign', $aircraft_callsign)
                                    ->where('departure_aerodrome', $departure_aerodrome)
                                    ->where('destination_aerodrome', $destination_aerodrome)
                                    ->where('date_of_flight', $date_of_flight)
                                    ->where('departure_time_hours', $departure_time_hours)
                                    ->where('departure_time_minutes', $departure_time_minutes)
                                    ->where('plan_status', $plan_status)->update($json_res2);
                    $this->j++;
                } else {
                    $fpl_create = App\models\FlightPlanDetailsModel::create($json_res2);
                    $this->k++;
                }
            }
        });
        date_default_timezone_set('Asia/Kolkata');
        $sync_time = date('Hi');
        $current_date = date('ymd');
        $yesterday = date('ymd', strtotime("-1 days"));
        $is_mng = 0;
        $is_evening = 0;
        if ($sync_time < 1800 && $sync_time > 0600) {
            $is_mng = 1;
            $date_of_sync = $yesterday;
        } elseif ($sync_time > 1800) {
            $is_evening = 1;
            $date_of_sync = $current_date;
        }
        $sync = [
            'is_fpl' => 1,
            'is_mng' => $is_mng,
            'is_evening' => $is_evening,
            'sync_time' => $sync_time,
            'date_of_sync' => $date_of_sync,
            'is_active' => 1
        ];
        $sync_count = \App\models\SyncIntegrationModel::where('date_of_sync', $date_of_sync)->where('is_active', 1)->count();
        if ($sync_count) {
            $sync = [
                'is_fpl' => 1,
                'is_mng' => $is_mng,
                'is_evening' => $is_evening,
                'sync_time' => $sync_time,
                'date_of_sync' => $date_of_sync,
                'is_active' => 1
            ];
            \App\models\SyncIntegrationModel::where('date_of_sync', $date_of_sync)->where('is_active', 1)->update($sync);
        } else {
            \App\models\SyncIntegrationModel::create($sync);
        }
        $email_data = [
            'subject' => 'FPL RECORDS UPLOADED ON ' . date('d-M-Y')
        ];
        dispatch(new \App\Jobs\FPLUploadSuccessEmailJob($email_data));
        return back()->with('success', 'Successfully updated!')
                        ->with('update_count', $this->j)->with('insert_count', $this->k);
    } catch (\Exception $ex) {
        Log::info($ex->getMessage());
    }
});

Route::get('statspage', function() {
    return view('fpl.statspage');
});
Route::get('new_statspage', function() {
    return view('EflightAdmin.stats.new_fplstats');
});
Route::get('fpl/stats', function() {
    return view('fpl.statspage2');
});

Route::get('fdtl', function() {
    return view('fdtl.fdtl');
});

Route::group(['prefix' => 'ccavenue', 'namespace' => 'Payment'], function() {
    Route::post('ccavRequestHandler', 'CcavenueController@ccavenue');
//    Route::get('ccavenue_response', 'CcavenueController@ccavenue_response');
    Route::get('cancel_url', 'CcavenueController@cancel_url');
    Route::post('cancel_url', 'CcavenueController@cancel_url');
//    Route::post('ccavenue_response', 'CcavenueController@ccavenue_response');
      Route::get('payment_pdf','BillingController@PaymentAlertPdf');
    Route::get('{adv_cost}', function($adv_cost) {

        return view('payments.ccavenue')->with('adv_cost', $adv_cost);
    });
    
    // Route::get('payment_pdf', 'BillingController@PaymentAlertPdf');
  

});

//If Authentication success and the user is admin     
Route::group(['middleware' => 'billing'], function() {
    Route::group(['prefix' => 'billing', 'namespace' => 'Payment'], function() {
    Route::get('/', 'BillingController@billing');
    Route::get('autosuggest', 'BillingController@AutoSuggest');
    Route::match(['get','post'], 'process', 'BillingController@process');
    Route::post('check_otp','BillingController@check_otp');
    Route::post('send_otp','BillingController@send_otp');
    Route::get('fuel_agency','BillingController@FuelAgencyInfo');
    Route::get('amount_in_words','BillingController@AmountInWords');
    Route::post('login','BillingController@login');
    Route::match(['get'], 'processvalid', 'BillingController@processvalid');
    Route::get('callsign_operator','BillingController@callsign_operator');
  });
});
Route::group(['namespace' => 'NotamsOps'], function () {
    Route::group(['prefix' => 'notamsops'], function () {
    Route::resource('/', 'NotamsOpsController');
    Route::post('/filter', 'NotamsOpsController@filter');
    Route::post('/uploadxls', 'NotamsOpsController@uploadxls');
    Route::post('/fplnotams', 'NotamsOpsController@fplnotams');
    Route::get('list/{id?}', 'NotamsOpsController@api_notams_list');
    Route::get('list2/{id?}', 'NotamsOpsController@api_notams_list2');
    Route::get('fetch', 'NotamsOpsController@notam_fetch_ui');
    Route::get('upload', 'NotamsOpsController@notam_upload_ui');
    Route::get('getnotambyfir','NotamsOpsController@getnotambyfir');
    Route::get('getnotamcount','NotamsOpsController@getNotamCount');
    Route::get('fetchnotams_fir','NotamsOpsController@fetch_notams_fir');
    Route::post('update','NotamsOpsController@update_notams_description');
    Route::get('getrecentnotam','NotamsOpsController@getrecentnotam');
    Route::post('updatestatus','NotamsOpsController@updatestatus');
    Route::post('updatetime','NotamsOpsController@updatetime');
    Route::post('updateemailstatus','NotamsOpsController@updateemailstatus');
    Route::post('download/{id?}','NotamsOpsController@download');
    Route::post('download','NotamsOpsController@download');
    Route::get('exportxls','NotamsOpsController@exportXls');
    Route::get('weatherdownload','NotamsOpsController@weatherdownload');
    Route::get('getcategorylist','NotamsOpsController@getCategorylist');
    Route::get('getnotamtiming','NotamsOpsController@getNotamTiming');
    Route::post('editnotamtime','NotamsOpsController@editNotamtime');
    Route::get('latlong','NotamsOpsController@updateLatLong');
    Route::get('checkAerodrome','NotamsOpsController@checkAerodrome');
    Route::get('pushNotamtoLive', 'NotamsOpsController@pushNotamtoLive');
    Route::get('checkPendingEdit', 'NotamsOpsController@checkPendingEdit');
    

    });
});  
Route::group(['namespace' => 'NavlogV2'], function() {
    Route::group(['prefix' => 'navlogv2'], function() {
        Route::resource('/', 'NavlogV2');
        // Route::post('/storeNavlogData', 'shortfplController@fullfpl');
        // Route::post('/storeloadtrim', 'shortfplController@store_loadtrim');
        // Route::get('/new', 'shortfplController@combinedfpl');
    });
});  
