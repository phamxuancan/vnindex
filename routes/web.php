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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pull-data','ProccessController@pullData');
Route::get('/display-vnindex','ProccessController@displayVNindex')->name('display-vnindex');;
Route::get('/generate-stock','ProccessController@generateStock');
Route::post('/update-eps','ProccessController@updateEPSVNINDEX');
