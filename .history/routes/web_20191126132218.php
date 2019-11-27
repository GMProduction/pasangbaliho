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


Route::get('login', 'Auth\Member\loginController@showLoginForm');
// Route::get('login', function(){
//     return view('auth.member.login');
// });
Route::post('login', 'Auth\Member\loginController@postlogin');
Route::post('loginClint', 'Auth\Member\loginController@postloginClient');
Route::get('logout', 'Auth\Member\loginController@logout');

Route::get('dashboard/addProduk', function(){
    return view('advertiser.data.input');
});


Route::get('dashboard', 'Member\advertiserController@showDashboard');
Route::get('dashboard/berlangsung', 'Member\transaksiController@showBerlangsung');
Route::get('/dashboard/berlangsung/detail', 'Member\transaksiController@showDetailTransaksi');
Route::get('/dashboard/profile/{id}', 'Member\advertiserController@showDetailProfil');
Route::get('/dashboard/notifikasi', 'Member\advertiserController@showNotif');




Route::get('showStreetView/{id}','Member\productController@showStreetView');

Route::get('/toFcm', 'FCM\SenderMessage@toFcm')->name('toFcm');
