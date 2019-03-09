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
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
	$api->get('/hello', function () {
		return 'Testing';
	});
// Set our namespace for the underlying routes
	$api->group(['namespace' => 'App\Api\Controllers', 'middleware' => 'cors'], function ($api) {

		// Auth routes
		$api->post('login', 'AuthController@authenticate');
		$api->post('register', 'AuthController@register');
		$api->post('forgot_password', 'AuthController@forgot_password');
		$api->get('users/me', 'AuthController@me');
		$api->get('users/list', 'AuthController@users_list');
		$api->resource('users/delete', 'AuthController');
		$api->resource('users/update', 'AuthController');
		$api->post('change_password', 'AuthController@change_password');
                
                $api->group(['namespace' => 'Home', 'prefix' => 'home'], function ($api) {
                $api->post('contact-us','HomeController@contact_us');
                });

		$api->get('user/{id?}', function ($id) {
			$result = \App\User::where('is_active', '1')->where('id', $id)->first();
			return response()->json(['result' => $result]);
		});

		//FPL APIs
		$api->group(['namespace' => 'Fpl', 'prefix' => 'fpl'], function ($api) {
			$api->get('/', 'fplControllerAPI@index');
			$api->post('process_quick_plan', 'fplControllerAPI@process_quick_plan');
			$api->post('edit_process', 'fplControllerAPI@edit_process');
			$api->post('new_plan', 'fplControllerAPI@new_plan');
			$api->post('file_the_process', 'fplControllerAPI@file_the_process');
			$api->get('pdf_download/{id?}', 'fplControllerAPI@pdf_download');
			$api->get('stations_list', 'fplControllerAPI@stations_autocomplete');
			$api->get('get_fpl_list', 'fplControllerAPI@get_fpl_list');
			$api->post('fpl_cancel/{id?}', 'fplControllerAPI@fpl_cancel');
			$api->post('revise_time/{id?}', 'fplControllerAPI@revise_time');
			$api->get('fpl_atc_info/{id?}', 'fplControllerAPI@fpl_atc_info');
			$api->get('pilots_list/{aircraft_callsign?}', 'fplControllerAPI@get_pilots');
			$api->get('get_airports_list', 'fplControllerAPI@get_airports_list');
			$api->get('get_dep_zzzz_name/id/{id?}/email/{email?}', 'fplControllerAPI@get_dep_zzzz_name');
			$api->get('get_dest_zzzz_name/id/{id?}/email/{email?}', 'fplControllerAPI@get_dest_zzzz_name');
			$api->post('change_fpl/{id?}', 'fplControllerAPI@change_fpl');
			$api->get('get_fpl_record/{id?}', 'fplControllerAPI@get_fpl_record');
			$api->get('get_count_fpl', 'fplControllerAPI@get_count_fpl');
                        $api->get('get_adc_count','fplControllerAPI@get_adc_count');
                        $api->post('fdtlpopup','FDTLPopUpControllerAPI@FDTLPopup');
                        $api->get('getFDTLPopup','FDTLPopUpControllerAPI@getFDTLPopup');
                        $api->post('change_fic_adc','fplControllerAPI@change_fic_adc');
		});

		$api->group(['namespace' => 'Notifications', 'prefix' => 'notifications'], function ($api) {
			$api->get('new', 'WebNotificationControllerApi@get_notifications');
		});

		// All routes in here are protected and thus need a valid token
		$api->group(['middleware' => 'jwt.auth'], function ($api) {
			$api->get('validate_token', 'AuthController@validateToken');
		});

		//Fdtl API's starts here

		$api->group(['namespace' => 'Fdtl', 'prefix' => 'fdtl'], function ($api) {
			$api->get('hello', 'FdtlControllerAPI@index');
			$api->post('fdtl_store_first_landing/{id?}', 'FdtlControllerAPI@fdtl_store_first_landing');
			$api->post('fdtl_store_second_landing/{id?}', 'FdtlControllerAPI@fdtl_store_second_landing');
			$api->post('fdtl_store_third_landing/{id?}', 'FdtlControllerAPI@fdtl_store_third_landing');
			$api->post('fdtl_store_fourth_landing/{id?}', 'FdtlControllerAPI@fdtl_store_fourth_landing');
			$api->post('fdtl_store_fifth_landing/{id?}', 'FdtlControllerAPI@fdtl_store_fifth_landing');
			$api->post('fdtl_store_sixth_landing/{id?}', 'FdtlControllerAPI@fdtl_store_sixth_landing');
		});
		//Fdtl API's end up here
                
//                Stats API
                
                $api->group(['namespace' =>'Stats', 'prefix' =>'stats'], function($api){
                    $api->get('get_fpl_stats','FPLStatsController@get_fpl_stats');
                    $api->get('auto_remainder','FPLStatsController@auto_remainder');
                    $api->get('operator_auto_remainder','FPLStatsController@operator_auto_remainder');
                });
                
                $api->group(['namespace' =>'Sync', 'prefix' =>'sync'], function($api){
                    $api->get('fpl_sync_email/{sync_time}','SyncController@fpl_sync_email');
                });

		//end of Name space API Controllers
                $api->group(['namespace' => 'Navlog', 'prefix' => 'navlog'], function ($api) {
                	$api->post('store', 'navlogControllerAPI@store');
                	$api->get('get_speed_list', 'navlogControllerAPI@SpeedList');
                	$api->get('get_airport_name', 'navlogControllerAPI@AirportName');
                	$api->get('get_pax_no', 'navlogControllerAPI@NoOfPax');
                	$api->get('pilot_in_command', 'navlogControllerAPI@pilot_in_command');
                	$api->get('copilot', 'navlogControllerAPI@copilot');
                	$api->get('get_max_fuel', 'navlogControllerAPI@Maxfuel');
                	$api->get('get_pilot_details', 'navlogControllerAPI@get_pilot_details');
                    $api->get('stations_autocomplete', 'navlogControllerAPI@stations_autocomplete');
        			$api->get('station_latlong', 'navlogControllerAPI@station_latlong');	
        			$api->get('pending_cancelled_count', 'navlogControllerAPI@pending_cancelled_count');
        			$api->get('pending_navlog', 'navlogControllerAPI@PendingNavlog');
        			$api->get('cancelled_navlog', 'navlogControllerAPI@CancelledNavlog');
        			$api->get('edit_navlog', 'navlogControllerAPI@EditNavlog');	
        			$api->get('navlog_preview', 'navlogControllerAPI@NavlogPreview');	
        			$api->post('navlog_cancel', 'navlogControllerAPI@NavlogCancel');
        			$api->post('navlog_revice_time', 'navlogControllerAPI@revice_time');	
        			$api->post('change_fic_adc', 'navlogControllerAPI@change_fic_adc');
        			$api->post('update_navlog', 'navlogControllerAPI@update_navlog');
        			$api->get('navlog_search', 'navlogControllerAPI@navlog_search');
        			$api->get('navlog_filter', 'navlogControllerAPI@navlog_filter');
                });
	});
    
});
