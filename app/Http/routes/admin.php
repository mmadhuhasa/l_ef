<?php

Route::group(['namespace' => 'EflightAdmin'], function () {
    Route::group(['prefix' => 'Admin'], function () {
        Route::resource('/', 'AdminHomeController');
        Route::resource('myaccount', 'MyAccountController');
        Route::resource('change_fic_adc', 'MyAccountController@change_fic_adc');
        Route::resource('revice_time', 'MyAccountController@revice_time');
        Route::post('fpl_cancel', 'MyAccountController@fpl_cancel');
        Route::resource('change_plan', 'MyAccountController@change_plan');
        Route::resource('pilots', 'PilotDetailsController');
        Route::resource('info', 'InfoController');
        Route::get('get_designations', 'InfoController@get_designations');
        Route::post('get_callsign_info', 'InfoController@get_callsign_info');
        Route::get('pilot_list', 'PilotDetailsController@pilot_list');
        Route::get('upload', 'PilotDetailsController@upload');
        Route::post('save_callsign_info', 'InfoController@save_callsign_info');
        Route::post('save_callsign_handlers', 'InfoController@save_callsign_handlers');
        Route::post('modal_msg_text', 'InfoController@modal_msg_text');
        Route::post('checkbox_info', 'InfoController@checkbox_info');
        Route::resource('handlers', 'HandlersController');
        Route::post('update_callsign_info', 'InfoController@update_callsign_info');

        Route::get('auto_email', 'InfoController@auto_email');
        Route::get('auto_mobile', 'InfoController@auto_mobile');
        Route::get('auto_name', 'InfoController@auto_name');
        Route::get('get_pilot_data', 'InfoController@get_pilot_data');

        Route::resource('fplstats', 'StatsController');
        Route::get('get_fpl_stats', 'StatsController@get_fpl_stats');
        Route::post('get_fpl_stats', 'StatsController@get_fpl_stats');
        Route::get('stats/callsigns', 'StatsController@get_callsign_stats');

        Route::group(['middleware' => 'usersadmin'], function () {
            Route::resource('/users', 'UserController');
            Route::get('user_list', 'UserController@user_list');
            Route::post('update_users', 'UserController@update_users');
            Route::post('add_users', 'UserController@add_users');
            Route::get('user/auto_email', 'UserController@auto_email');
            Route::get('user/auto_mobile', 'UserController@auto_mobile');
            Route::get('user/auto_operator', 'UserController@auto_operator');
            Route::get('user/auto_name', 'UserController@auto_name');
            Route::get('get_user_data', 'UserController@get_user_data');
            Route::get('fplstats', 'FPLStatsController@fplstats');
            Route::post('update_fplstats', 'FPLStatsController@update_fplstats');
        });

        Route::get('pilots_filter', 'PilotDetailsController@filter_pilots');
        Route::get('get_user_details', 'UserController@get_user_details');
        Route::post('delete_user', 'UserController@delete_user');
    });
});
Route::group(['namespace' => 'Shortfpl'], function() {
    Route::group(['prefix' => 'shortfpl'], function() {
        Route::resource('/', 'shortfplController');
        Route::post('/fullfpl', 'shortfplController@fullfpl');
        Route::post('/storeloadtrim', 'shortfplController@store_loadtrim');
        Route::get('/new', 'shortfplController@combinedfpl');
    });
});
