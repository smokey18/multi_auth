<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:1', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');
    Route::get('profile', 'App\Http\Controllers\AdminController@profile')->name('admin.profile');
    Route::get('settings', 'App\Http\Controllers\AdminController@settings')->name('admin.settings');

    Route::post('update-profile-info', 'App\Http\Controllers\AdminController@updateInfo')->name('adminUpdateInfo');
    Route::post('change-profile-picture', 'App\Http\Controllers\AdminController@updatePicture')->name('adminPictureUpdate');
    Route::post('change-password', 'App\Http\Controllers\AdminController@changePassword')->name('adminChangePassword');
});

// Buyer Routes
Route::group(['prefix' => 'buyer', 'middleware' => ['role:2', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', 'App\Http\Controllers\BuyerController@index')->name('buyer.dashboard');
    Route::get('profile', 'App\Http\Controllers\BuyerController@profile')->name('buyer.profile');
    Route::get('settings', 'App\Http\Controllers\BuyerController@settings')->name('buyer.settings');

    Route::post('update-profile-info', 'App\Http\Controllers\BuyerController@updateInfo')->name('buyerUpdateInfo');
    Route::post('change-profile-picture', 'App\Http\Controllers\BuyerController@updatePicture')->name('buyerPictureUpdate');
    Route::post('change-password', 'App\Http\Controllers\BuyerController@changePassword')->name('buyerChangePassword');
});

// Seller Routes
Route::group(['prefix' => 'seller', 'middleware' => ['role:3', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', 'App\Http\Controllers\SellerController@index')->name('seller.dashboard');
    Route::get('profile', 'App\Http\Controllers\SellerController@profile')->name('seller.profile');
    Route::get('settings', 'App\Http\Controllers\SellerController@settings')->name('seller.settings');

    Route::post('update-profile-info', 'App\Http\Controllers\SellerController@updateInfo')->name('sellerUpdateInfo');
    Route::post('change-profile-picture', 'App\Http\Controllers\SellerController@updatePicture')->name('sellerPictureUpdate');
    Route::post('change-password', 'App\Http\Controllers\SellerController@changePassword')->name('sellerChangePassword');


    Route::get('/create', '\App\Http\Controllers\SellerController@create')->name('seller.create');
    Route::post('/store', 'App\Http\Controllers\SellerController@store')->name('seller.store');

    Route::get('/edit/{id}', 'App\Http\Controllers\SellerController@edit');
    Route::post('/update', 'App\Http\Controllers\SellerController@update')->name('seller.update');

    Route::get('/delete/{id}', 'App\Http\Controllers\SellerController@destroy');
});