<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/subscriber', 'SubscriberController@index');
Route::post('/subscriber/save', 'SubscriberController@store');
Route::get('/subscriber/list', 'SubscriberController@view');
Route::post('/subscriber/list', 'SubscriberController@show');

Route::get('/segment', 'SegmentController@index');
Route::post('/segment/save', 'SegmentController@store');
