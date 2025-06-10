<?php

use Illuminate\Support\Facades\Route;

Route::prefix('events')->group(function () {
    Route::get('/', 'EventController@index');
    Route::post('/', 'EventController@store');
    Route::get('{id}', 'EventController@show');
    Route::put('{id}', 'EventController@update');
    Route::delete('{id}', 'EventController@destroy');
    Route::post('{id}/bookings', 'BookingController@store');
});
