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

Route::get('/{any}', 'HomeController@index')->where('any', '^((?!api).)*$');
// $string = 'api/tesst';
// Route::get('/{id}', function ($id) {
//     echo 123;
// })->where('id', '^((?!api).)*$');
// Route::get('/{any}', function () {
//     echo '11';
// })->where('any', '^((?!api).)*$');
// Route::get('/{any}', function () {
//     echo '444';
// })->where('any', '/api/');
// Route::get('/pull-data','ProccessController@pullData');
// Route::get('/display-vnindex','ProccessController@displayVNindex')->name('display-vnindex');;
// Route::get('/sort-condition','ProccessController@sort')->name('sort');;
// Route::get('/generate-stock','ProccessController@generateStock');
// Route::post('/update-eps','ProccessController@updateEPSVNINDEX');
    Route::get('/api/login', 'AuthController@login');
    Route::post('/api/login', 'Auth\LoginController@login');
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/api/user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
        Route::post('register', 'AuthController@register');
        
        Route::get('refresh', 'AuthController@refresh');
    });

// Route::prefix('api')->group(function(){
//     post('register', 'AuthController@register');
//     Route::get('login', 'AuthController@login');
//     Route::post('login', 'Auth\LoginController@login');
//     Route::get('refresh', 'AuthController@refresh');
//     Route::group(['middleware' => 'auth'], function(){
//         Route::get('user', 'AuthController@user');
//         Route::post('logout', 'AuthController@logout');
//     });

// });
