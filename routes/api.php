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

Route::post('v1/login', 'API\AdvertiserController@login')->name('login');
Route::post('v1/register', 'API\AdvertiserController@register');


//Login and Register Advertiser
Route::get('v1/getAdvertiser', 'API\AdvertiserController@getAdvertiser')->name('getAdvertiser');
Route::post('v1/loginAdvertiser', 'API\AdvertiserController@loginAdvertiser')->name('loginAdvertiser');
Route::post('v1/loginByGoogle', 'API\AdvertiserController@loginByGoogle')->name('loginByGoogle');


//Fetch data baliho
Route::get('v1/dataListAllBaliho', 'API\BalihoController@dataListAllBaliho')->name('dataListAllBaliho');
Route::get('v1/dataListBalihoSearchGlobal', 'API\BalihoController@dataListBalihoSearchGlobal')->name('dataListBalihoSearchGlobal');
Route::get('v1/showDetailBaliho/{id}', 'API\BalihoController@showDetailBaliho')->name('showDetailBaliho');

//Fetch data kota
Route::get('v1/dataAllKota', 'API\KotaController@dataAllKota')->name('dataAllKota');

//Fetch data kategori
Route::get('v1/dataAllKategori', 'API\KategoriController@dataAllKategori')->name('dataAllKategori');

//Transaksi
Route::post('v1/ajukanPenawaran', 'API\TransaksiController@ajukanPenawaran')->name('ajukanPenawaran');
Route::post('v1/setujuiHarga', 'API\TransaksiController@setujuiHarga')->name('setujuiHarga');
Route::get('v1/dataTransaksi', 'API\TransaksiController@dataTransaksi')->name('dataTransaksi');
Route::get('v1/detailTransaksi/{idTransaksi}', 'API\TransaksiController@detailTransaksi')->name('detailTransaksi');

//Slider
Route::get('v1/getSlider', 'API\SliderController@getSlider')->name('getSlider');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('v1/details', 'API\AdvertiserController@details');
});
