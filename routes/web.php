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

Route::get('/', function(){
    echo "tes cuk";
});
Route::get('detail', 'Member\productController@detailProduct');

Route::get('product', 'Member\productController@showProduct');
Route::get('dashboard/berlangsung', 'Member\transaksiController@showBerlangsung');
Route::get('/dashboard/berlangsung/detail', 'Member\transaksiController@showDetailTransaksi');
Route::post('addTransaksi', 'Member\transaksiController@addTransaksi');

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
Route::post('login', 'Auth\Member\loginController@postlogin');
Route::get('logout', 'Auth\Member\loginController@logout');
Route::get('dashboard', function(){
    return view('advertiser.index');
});
Route::get('dashboard/addProduk', function(){
    return view('advertiser.data.input');
});


Route::get('showStreetView',function(){
    return view('item.streetview');
});
