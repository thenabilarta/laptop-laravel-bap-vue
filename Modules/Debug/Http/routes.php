<?php

Route::group(['middleware' => 'web', 'prefix' => 'debug', 'namespace' => 'Modules\Debug\Http\Controllers'], function()
{
    Route::get('/', 'DebugController@index');
});
