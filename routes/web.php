<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\WeatherInformerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('orders', 'OrderController@index')->name('orders.index');

Route::get('weather/{city}', 'WeatherInformerController@show')->name('weather.show');
