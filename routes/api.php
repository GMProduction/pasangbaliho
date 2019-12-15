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
Route::post('v1/registerAdvertiser', 'API\AdvertiserController@registerAdvertiser')->name('registerAdvertiser');

//CLient
Route::get('v1/cekLoginClient', 'API\ClientController@cekLoginClient')->name('cekLoginClient');
Route::post('v1/loginClient', 'API\ClientController@loginClient')->name('loginClient');
Route::post('v1/registerClient', 'API\ClientController@registerClient')->name('registerClient');


//Fetch data baliho
Route::get('v1/dataListAllBaliho', 'API\BalihoController@dataListAllBaliho')->name('dataListAllBaliho');
Route::get('v1/dataListBalihoSearchGlobal', 'API\BalihoController@dataListBalihoSearchGlobal')->name('dataListBalihoSearchGlobal');
Route::get('v1/showDetailBaliho/{id}', 'API\BalihoController@showDetailBaliho')->name('showDetailBaliho');

Route::get('v1/getBalihoClient', 'API\BalihoController@getBalihoClient')->name('getBalihoClient');

//Fetch data kota
Route::get('v1/dataAllKota', 'API\KotaController@dataAllKota')->name('dataAllKota');

//Fetch data kategori
Route::get('v1/dataAllKategori', 'API\KategoriController@dataAllKategori')->name('dataAllKategori');

//Transaksi
Route::post('v1/ajukanPenawaran', 'API\TransaksiController@ajukanPenawaran')->name('ajukanPenawaran');
Route::post('v1/setujuiHarga', 'API\TransaksiController@setujuiHarga')->name('setujuiHarga');
Route::post('v1/setReadAdvertiser', 'API\TransaksiController@setReadAdvertiser')->name('setReadAdvertiser');
Route::post('v1/setReadPerTransaksi', 'API\TransaksiController@setReadPerTransaksi')->name('setReadPerTransaksi');
Route::get('v1/dataTransaksi', 'API\TransaksiController@dataTransaksi')->name('dataTransaksi');
Route::get('v1/detailTransaksi/{idTransaksi}', 'API\TransaksiController@detailTransaksi')->name('detailTransaksi');
Route::get('v1/countNewTransaksi', 'API\TransaksiController@countNewTransaksi')->name('countNewTransaksi');

Route::get('v1/dataTransaksiClient', 'API\TransaksiController@dataTransaksiClient')->name('dataTransaksiClient');
Route::get('v1/allDataTransaksiClient', 'API\TransaksiController@allDataTransaksiClient')->name('allDataTransaksiClient');
Route::get('v1/countNewTransaksiClient', 'API\TransaksiController@countNewTransaksiClient')->name('countNewTransaksiClient');
Route::get('v1/detailTransaksiClient/{idTransaksi}', 'API\TransaksiController@detailTransaksiClient')->name('detailTransaksiClient');


//Slider
Route::get('v1/getSlider', 'API\SliderController@getSlider')->name('getSlider');

//News
Route::get('v1/getDataNews', 'API\NewsController@getDataNews')->name('getDataNews');

//Notifikasi
Route::get('v1/getDataNotifikasi', 'API\NotifikasiController@getDataNotifikasi')->name('getDataNotifikasi');
Route::get('v1/testMessage', 'API\AdvertiserController@testMessage')->name('testMessage');

//FCM
Route::post('v1/insertFcmAdvertiser', 'API\FcmController@insertFcmAdvertiser')->name('insertFcmAdvertiser');
Route::post('v1/deleteFcmAdvertiser', 'API\FcmController@deleteFcmAdvertiser')->name('deleteFcmAdvertiser');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('v1/details', 'API\AdvertiserController@details');
});
