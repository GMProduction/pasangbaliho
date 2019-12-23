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
Route::get('product/detail/{id}/{url}', 'Member\productController@detailProduct');
Route::post('product/addTransaksi', 'Member\transaksiController@addTransaksi');
Route::get('news', 'Member\indexController@showNews');
Route::get('kebijakan-privasi', function () {
    return view('main.kebijakan');
});
Route::get('syarat-dan-ketentuan', function () {
    return view('main.sk');
});


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
Route::group(['guard' => 'guest'], function () {
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
    Route::get('dashboard/addProduk', function () {
        return view('advertiser.data.input');
    });
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
Route::get('dashboardClient', 'Member\Client\clientController@showDashboard');
Route::get('dashboardClient/profile', 'Member\Client\clientController@showProfile');
Route::get('dashboardClient/asset', 'Member\Client\assetClientController@showAsset');
// });

Route::group(['prefix' => 'dashboardClient'], function () {
    Route::group(['prefix' => 'asset'], function () {
        Route::get('add', 'Member\Client\assetClientController@showAddAsset');
    });
});




Route::get('showStreetView/{id}', 'Member\productController@showStreetView');

Route::get('/toFcm', 'FCM\SenderMessage@toFcm')->name('toFcm');
Route::get('/toFcmClient', 'FCM\SenderMessage@toFcmClient')->name('toFcmClient');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashboardControll@index')->name('dashboard');
    Route::get('{any}', function () {
        return view('admin.layout');
    })->where('any', '.*');

    Route::get('/api/negosiasi/request', 'Admin\TransaksiControll@getPermintaanharga');
});

Route::group(['prefix' => 'adminapi'], function () {

    Route::group(['prefix' => 'mitra'], function () {
        Route::get('/cMitra', 'Admin\MitraControll@getCountMitra');
        Route::get('/request', 'Admin\MitraControll@getMitra');
        Route::get('/requestById', 'Admin\MitraControll@getMitraById');
        Route::post('/add', 'Admin\MitraControll@addMitra');
        Route::post('/edit', 'Admin\MitraControll@editMitra');
        Route::delete('/delete', 'Admin\MitraControll@deleteMitra');
    });

    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('/cAdvertiser', 'Admin\AdvertiserControll@getCountAdvertiser');
        Route::get('/request', 'Admin\AdvertiserControll@getAdvertiser');
        Route::get('/requestById', 'Admin\AdvertiserControll@getAdvertiserById');
        Route::post('/add', 'Admin\AdvertiserControll@addAdvertiser');
        Route::post('/edit', 'Admin\AdvertiserControll@editAdvertiser');
        Route::delete('/delete', 'Admin\AdvertiserControll@deleteAdvertiser');
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/request', 'Admin\KategoriControll@getKategori');
    });

    Route::group(['prefix' => 'lokasi'], function () {
        Route::get('/requestProvinsi', 'Admin\LokasiControll@getProvinsi');
        Route::get('/requestKota', 'Admin\LokasiControll@getKota');
    });

    Route::group(['prefix' => 'mediaiklan'], function () {
        Route::get('/cMedia', 'Admin\MediaControll@getCountMedia');
        Route::get('/request', 'Admin\MediaControll@getMedia');
        Route::get('/requestExceptPending', 'Admin\MediaControll@getMediaExceptPending');
        Route::get('/requestById', 'Admin\MediaControll@getMediaById');
        Route::post('/konfirmmedia', 'Admin\MediaControll@konfirmasiMedia');
        Route::post('/addmedia', 'Admin\MediaControll@addMedia');
        Route::post('/updateStatus', 'Admin\MediaControll@updateStatusMedia');
        Route::delete('/delete', 'Admin\MediaControll@delete');
    });

    Route::group(['prefix' => 'negosiasi'], function () {
        Route::get('/request', 'Admin\TransaksiControll@getNegosiasi');
        Route::get('/requestById', 'Admin\TransaksiControll@getNegosiasiById');
        Route::post('/postPrice', 'Admin\TransaksiControll@postPrice');
        Route::post('/sendemail', 'Admin\MailSender@send');

        Route::get('/mediausedon', 'Admin\TransaksiControll@getBalihoOnUsed');
    });
});
