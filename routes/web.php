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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('/testIpay', 'Member\testIpay88@index');
Route::post('/thankyou', 'Member\testIpay88@thx');

Route::post('/getResponse', 'Member\paymentController@getResponse');


Route::get('/', 'Member\indexController@index');
Route::get('product', 'Member\productController@cariProduk');
Route::get('product/search', 'Member\productController@cariProduk');
Route::get('m/{url}/{id}', 'Member\productController@detailProduct');
Route::get('corus', 'Member\indexController@showCorus');


Route::post('product/addTransaksi', 'Member\transaksiController@addTransaksi');
Route::get('news', 'Member\newsController@showNews');
Route::get('news/{$id}', 'Member\newsController@showNews');

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
Route::get('log', function () {
    return view('auth.login');
});

Route::post('testlogin', 'Auth\LoginController@login');
Route::GET('testlogout', 'Auth\LoginController@logout');

Route::get('redirect/{driver}', 'Auth\Member\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\Member\LoginController@handleProviderCallback')->name('login.callback');

Route::group(['middleware' => 'ifNotGuest'], function () {
    Route::get('registration', 'Auth\Member\RegisterController@showOptionRegister');
    Route::get('registration-client', 'Auth\Member\RegisterController@showRegisterClient');
    Route::get('registration-advertiser', 'Auth\Member\RegisterController@showRegisterAdvertiser');

    Route::get('login', 'Auth\Member\LoginClientController@showLoginForm');

    Route::post('loginAdvertiser', 'Auth\Member\LoginController@postlogin');
    Route::post('loginClient', 'Auth\Member\LoginClientController@postloginClient');
});


Route::group(['middleware' => 'advertiser'], function () {
    Route::get('logout', 'Auth\Member\LoginController@logout');
    Route::get('dashboard', 'Member\advertiserController@showDashboard');
    Route::get('dashboard/berlangsung', 'Member\transaksiController@showBerlangsung');
    Route::get('/dashboard/berlangsung/detail/{id}', 'Member\transaksiController@showDetailTransaksi');
    Route::get('/dashboard/berlangsung/detail/payment/{id}', 'Member\transaksiController@showpayment');
    Route::post('/dashboard/berlangsung/detail/payment/bayar', 'Member\paymentController@addPayment');
    Route::get('/dashboard/profile', 'Member\advertiserController@showDetailProfil');
    Route::get('/dashboard/notifikasi', 'Member\advertiserController@showNotif');
    Route::get('/dashboard/history', 'Member\historyController@dataHistory');
    Route::get('/dashboard/berjalan', 'Member\berjalanController@dataBerjalan');
    // Route::post('/dashboard/profile/editProfil', 'Member\profileController@editProfile');
    Route::group(['prefix' => 'dashboard/profile'], function () {
        Route::post('editProfil', 'Member\profileController@editProfile');
    });
    // Route::get('/payment', 'Member\testIpay88@posIpay');
    Route::post('/payment', 'Member\transaksiController@showpayment');
});
// Client Dashboar
Route::group(['middleware' => 'client'], function () {
    Route::get('logoutClient', 'Auth\Member\LoginClientController@logoutClient');
    Route::get('dashboardClient', 'Member\Client\clientController@showDashboard');
    Route::group(['prefix' => 'dashboardClient'], function () {
        Route::get('profile', 'Member\Client\profileController@getDataProfile');
        Route::get('disewa', 'Member\Client\disewaController@showDisewa');
        Route::get('history', 'Member\Client\historyController@showHistory');
        Route::get('asset', 'Member\Client\assetClientController@showAsset')->name('asset');
    });

    Route::group(['prefix' => 'dashboardClient/asset'], function () {
        Route::get('add', 'Member\Client\assetClientController@showAddAsset');
        Route::post('addAsset', 'Member\Client\assetClientController@addAsset');
        Route::get('info/{id}', 'Member\Client\assetClientController@detailAsset');
    });
    Route::get('dashboardClient/asset/updateVisible', 'Member\Client\assetClientController@editvisibleAsset');
});


Route::get('showStreetView/{id}', 'Member\productController@showStreetView');

Route::get('/toFcm', 'FCM\SenderMessage@toFcm')->name('toFcm');
Route::get('/toFcmClient', 'FCM\SenderMessage@toFcmClient')->name('toFcmClient');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashboardControll@index')->name('dashboard');
    Route::get('{any}', function () {
        return view('admin.layout');
    })->where('any', '.*');
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
        Route::get('/sendsms', 'Admin\TransaksiControll@sendSms');
    });
});
