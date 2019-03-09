<?php

Route::group(['namespace' => 'Weather'], function () {
    Route::group(['prefix' => 'weather'], function () {
        Route::resource('/', 'WeatherController');
        Route::get('/metar/upload', 'WeatherController@upload');
        Route::post('upload', 'WeatherController@store');
        Route::post('/', 'WeatherController@index');
        Route::get('autosuggest','WeatherController@autoSuggest');
        Route::resource('/longtaf/', 'TafController');
        Route::get('taf/upload', 'TafController@upload');
        Route::post('taf/upload', 'TafController@store');
        Route::get('/new', 'WeatherController@index');
    });
});
