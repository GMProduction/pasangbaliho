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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AdvertiserController@login')->name('login');
Route::post('register', 'API\AdvertiserController@register');

Route::get('getAdvertiser', 'API\AdvertiserController@getAdvertiser')->name('getAdvertiser');
Route::post('loginAdvertiser', 'API\AdvertiserController@loginAdvertiser')->name('loginAdvertiser');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\AdvertiserController@details');
});
