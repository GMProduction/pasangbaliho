<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('v1/getDataNotifikasiClient', 'API\NotifikasiController@getDataNotifikasiClient')->name('getDataNotifikasiClient');

//FCM
Route::post('v1/insertFcmAdvertiser', 'API\FcmController@insertFcmAdvertiser')->name('insertFcmAdvertiser');
Route::post('v1/deleteFcmAdvertiser', 'API\FcmController@deleteFcmAdvertiser')->name('deleteFcmAdvertiser');

Route::post('v1/insertFcmClient', 'API\FcmController@insertFcmClient')->name('insertFcmClient');
Route::post('v1/deleteFcmClient', 'API\FcmController@deleteFcmClient')->name('deleteFcmClient');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('v1/details', 'API\AdvertiserController@details');
});




Route::group(['prefix' => 'admin'], function(){
    Route::post('/sms', 'Admin\smsControll@sms');
    Route::group(['prefix' => 'v1'], function(){
        Route::post('/register', 'Admin\AdminControll@register');
        Route::post('/login', 'Admin\AdminControll@login');

        Route::group(['middleware' => 'auth:admin-api'], function(){

            Route::group(['prefix' => 'kategori'], function () {
                Route::get('/request', 'Admin\KategoriControll@getKategori');
            });
        
            Route::group(['prefix' => 'lokasi'], function () {
                Route::get('/requestProvinsi', 'Admin\LokasiControll@getProvinsi');
                Route::get('/requestProvinsiById', 'Admin\LokasiControll@getProvinsiById');
                Route::get('/requestKota', 'Admin\LokasiControll@getKota');
                Route::get('/requestKotaById', 'Admin\LokasiControll@getKotaById');
                Route::post('/addProvinsi', 'Admin\LokasiControll@addProvinsi');
                Route::post('/addKota', 'Admin\LokasiControll@addKota');
            });

            Route::group(['prefix' => 'mitra'], function () {
                Route::get('/cMitra', 'Admin\MitraControll@getCountMitra');
                Route::get('/request', 'Admin\MitraControll@getMitra');
                Route::get('/requestById', 'Admin\MitraControll@getMitraById');
                Route::post('/add', 'Admin\MitraControll@addMitra');
                Route::post('/edit', 'Admin\MitraControll@editMitra');
                Route::delete('/delete/{id}', 'Admin\MitraControll@deleteMitra');
            });
            
            Route::group(['prefix' => 'advertiser'], function(){
                Route::get('/cAdvertiser', 'Admin\AdvertiserControll@getCountAdvertiser');
                Route::get('/request', 'Admin\AdvertiserControll@getAdvertiser');
                Route::get('/requestById', 'Admin\AdvertiserControll@getAdvertiserById');
                Route::post('/add', 'Admin\AdvertiserControll@addAdvertiser');
                Route::post('/edit', 'Admin\AdvertiserControll@editAdvertiser');
                Route::delete('/delete/{id}', 'Admin\AdvertiserControll@deleteAdvertiser');
            });

            Route::group(['prefix' => 'mediaiklan'], function () {
                Route::get('/cMedia', 'Admin\MediaControll@getCountMedia');
                Route::get('/request', 'Admin\MediaControll@getMedia');
                Route::get('/requestExceptPending', 'Admin\MediaControll@getMediaExceptPending');
                Route::get('/requestById', 'Admin\MediaControll@getMediaById');
                Route::post('/addMedia', 'Admin\MediaControll@addMedia');
                Route::post('/patchMedia', 'Admin\MediaControll@patchMedia');
                Route::post('/uploadImage', 'Admin\MediaControll@multipleUpload');
                Route::post('/patchStatusMedia', 'Admin\MediaControll@patchStatusMedia');
                Route::delete('/delete/{id}', 'Admin\MediaControll@delete');
            });

            Route::group(['prefix' => 'negosiasi'], function () {
                Route::get('/request', 'Admin\TransaksiControll@getNegosiasi');
                Route::get('/requestById', 'Admin\TransaksiControll@getNegosiasiById');
                Route::post('/patchTransaksi', 'Admin\TransaksiControll@patchTransaksi');
                Route::post('/sendemail', 'Admin\MailSender@send');
        
                Route::get('/mediausedon', 'Admin\TransaksiControll@getBalihoOnUsed');
                Route::get('/sendsms', 'Admin\TransaksiControll@sendSms');
            });

            Route::group(['prefix' => 'news'], function (){
                Route::post('/addNews', 'Admin\NewsControll@addNews');
                Route::post('/patchNews', 'Admin\NewsControll@patchNews');
            });

            Route::group(['prefix' => 'payment'], function (){
                Route::get('/getPayment', 'Admin\PaymentControll@getPayment');
                Route::post('/patchPayment', 'Admin\PaymentControll@patchPayment');
                Route::get('/requestPaymentById', 'Admin\PaymentControll@getPaymentById');
                Route::get('/requestSaldo', 'Admin\PaymentControll@getSaldoPayment');
                Route::get('/requestSaldoById', 'Admin\PaymentControll@getSaldoPaymentById');
            });

        });
    });
});