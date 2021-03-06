<?php

Route::group(['middleware' => 'web', 'prefix' => 'schedule', 'namespace' => 'Modules\Schedule\Http\Controllers'], function () {
    Route::get('/', 'ScheduleController@index');
    Route::post('/data', 'ScheduleController@data');
    Route::post('/', 'ScheduleController@addSchedule');
    Route::post('/edit', 'ScheduleController@editSchedule');
    Route::post('/delete', 'ScheduleController@delete');
});
