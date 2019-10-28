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


//Login and Register Advertiser
Route::get('getAdvertiser', 'API\AdvertiserController@getAdvertiser')->name('getAdvertiser');
Route::post('loginAdvertiser', 'API\AdvertiserController@loginAdvertiser')->name('loginAdvertiser');
Route::post('loginByGoogle', 'API\AdvertiserController@loginByGoogle')->name('loginByGoogle');


//Fetch data baliho
Route::get('dataListAllBaliho', 'API\BalihoController@dataListAllBaliho')->name('dataListAllBaliho');
Route::get('dataListBalihoSearchSpesifik', 'API\BalihoController@dataListBalihoSearchSpesifik')->name('dataListBalihoSearchSpesifik');
Route::get('dataListBalihoSearchGlobal', 'API\BalihoController@dataListBalihoSearchGlobal')->name('dataListBalihoSearchGlobal');
Route::get('showDetailBaliho/{id}', 'API\BalihoController@showDetailBaliho')->name('showDetailBaliho');

//Fetch data kota
Route::get('dataAllKota', 'API\KotaController@dataAllKota')->name('dataAllKota');

//Fetch data kategori
Route::get('dataAllKategori', 'API\KategoriController@dataAllKategori')->name('dataAllKategori');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\AdvertiserController@details');
});
