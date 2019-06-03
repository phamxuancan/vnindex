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
    Route::get('/api/pull-data','ProccessController@pullData');
// Route::get('/generate-stock','ProccessController@generateStock');
// Route::post('/update-eps','ProccessController@updateEPSVNINDEX');
    Route::get('/api/login', 'AuthController@login');
    //Route::post('/api/login', 'Auth\LoginController@login');
    Route::post('/api/register', 'AuthController@register');
    Route::get('/api/display-vnindex','ProccessController@displayVNindex')->name('display-vnindex');;
    Route::get('/api/foreign','ProccessController@sort')->name('foreign');;
    Route::get('/api/stand-filter','ProccessController@standFilter')->name('standFilter');;
    Route::get('/api/pivote/add','HomeController@pivot_add')->name('pivote_add');;
    Route::get('/api/collection_put','HomeController@collection_put')->name('collection_put');;
    Route::get('/api/test_data','HomeController@test_data')->name('test_data');;
    
    Route::get('/api/sendEmail','ProccessController@send')->name('send');;
    Route::get('/api/suc-manh-mua','ProccessController@buyStrong')->name('buyStrong');;



    Route::group(['middleware' => 'auth'], function(){
        Route::middleware('throttle:2,1')->group(function () {
            Route::post('/api/login', 'Auth\LoginController@login');
        });
        Route::get('/api/user', 'AuthController@user');
        Route::post('/api/logout', 'AuthController@logout');
        
        
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
