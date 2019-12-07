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

// Route::get('/', function () {
//     return view('main.index');
// });

use Illuminate\Support\Facades\Route;

Route::get('/', 'Member\indexController@index');

Route::get('product', 'Member\productController@cariProduk');
Route::get('product/search', 'Member\productController@cariProduk');
Route::get('product/detail', 'Member\productController@detailProduct');
Route::post('product/addTransaksi', 'Member\transaksiController@addTransaksi');
Route::get('news', 'Member\indexController@showNews');
// Route::get('product/search',function(){
//     echo 'asd';
// });



// Route::get('/detail', function () {
//     return view('main.detailproduct');
// });

//Register
Route::post('addAdvertiser', 'Auth\Member\RegisterController@registerAdvertiser');
Route::post('addClient', 'Auth\Member\RegisterController@registerClient');

//

Route::get('registration', 'Auth\Member\RegisterController@showOptionRegister');
Route::get('registration-client', 'Auth\Member\RegisterController@showRegisterClient');
Route::get('registration-advertiser', 'Auth\Member\RegisterController@showRegisterAdvertiser');

Route::get('login', 'Auth\Member\LoginClientController@showLoginForm');
// Route::get('login', function(){
//     return view('auth.member.login');
// });
Route::post('loginAdvertiser', 'Auth\Member\LoginController@postlogin');
Route::post('loginClient', 'Auth\Member\LoginClientController@postloginClient');
Route::get('logout', 'Auth\Member\LoginController@logout');
Route::get('logoutClient', 'Auth\Member\LoginClientController@logoutClient');
Route::get('dashboard/addProduk', function(){
    return view('advertiser.data.input');
});

Route::group(['middleware' => 'advertiser'], function () {
    Route::get('dashboard', 'Member\advertiserController@showDashboard');
    Route::get('dashboard/berlangsung', 'Member\transaksiController@showBerlangsung');
    Route::get('/dashboard/berlangsung/detail', 'Member\transaksiController@showDetailTransaksi');
    Route::get('/dashboard/profile/{id}', 'Member\advertiserController@showDetailProfil');
    Route::get('/dashboard/notifikasi', 'Member\advertiserController@showNotif');
    Route::get('/dashboard/history', 'Member\historyController@dataHistory');
    Route::get('/dashboard/berjalan', 'Member\berjalanController@dataBerjalan');
});
// Client Dashboar
// Route::group(['middleware' => 'client'], function () {
    Route::get('dashboardClient', 'Member\clientController@showDashboard');
    Route::get('dashboardClient/profile', 'Member\clientController@showProfile');
    Route::get('dashboardClient/asset', 'Member\clientController@showAsset');
// });



Route::get('showStreetView/{id}','Member\productController@showStreetView');

Route::get('/toFcm', 'FCM\SenderMessage@toFcm')->name('toFcm');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'DashboardControll@index')->name('dashboard');
    Route::get('{any}', function () {
        return view('admin.layout');
    })->where('any','.*');

    Route::get('/api/negosiasi/request', 'Admin\TransaksiControll@getPermintaanharga');
});

Route::group(['prefix' => 'adminapi'], function(){


    Route::group(['prefix' => 'mitra'], function(){
        Route::get('/request', 'Admin\MitraControll@getMitra');
        Route::get('/requestAdvertiser', 'Admin\AdvertiserControll@getAdvertiser');
    });

    Route::group(['prefix' => 'kategori'], function(){
        Route::get('/request', 'Admin\KategoriControll@getKategori');
    });

    Route::group(['prefix' => 'lokasi'], function(){
        Route::get('/requestProvinsi', 'Admin\LokasiControll@getProvinsi');
        Route::get('/requestKota', 'Admin\LokasiControll@getKota');
    });

    Route::group(['prefix' => 'negosiasi'], function(){
        Route::get('/request', 'Admin\TransaksiControll@getPermintaanharga');
        Route::get('/requestById', 'Admin\TransaksiControll@getPermintaanHargaById');
        Route::post('/postPrice', 'Admin\TransaksiControll@setPemberianHarga');
        Route::get('/nego', 'Admin\TransaksiControll@getNegosiasiHarga');
        Route::get('/negoById', 'Admin\TransaksiControll@getNegosiasiHargaById');
        Route::post('/postPriceDeal', 'Admin\TransaksiControll@setHargaDeal');
        Route::get('/negomateri', 'Admin\TransaksiControll@getNegosiasiMateri');
        Route::get('/negomateriById', 'Admin\TransaksiControll@getNegosiasiMateriById');
        Route::post('/finishnego', 'Admin\TransaksiControll@setFinisNego');
        Route::get('/mediausedon', 'Admin\TransaksiControll@getBalihoOnUsed');
    });

    Route::group(['prefix' => 'mediaiklan'], function(){
        Route::get('/request', 'Admin\MediaControll@getPermintaanMedia');
        Route::get('/requestAllMedia', 'Admin\MediaControll@getAllMedia');
        Route::get('/requestpublish', 'Admin\MediaControll@getMediaPublish');
        Route::get('/requestblock', 'Admin\MediaControll@getMediaBlock');
        Route::get('/requestById', 'Admin\MediaControll@getPermintaanMediaById');
        Route::post('/konfirmmedia','Admin\MediaControll@konfirmasiMedia');
        Route::post('/addmedia','Admin\MediaControll@addMedia');
    });
});
