<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->post('/login', function (Request $request) {
//     return 1;
//     return $request->user();
// });
Route::middleware('guest:api')->group(function () {
    Route::post('login','ProccessController@updateEPSVNINDEX');
});