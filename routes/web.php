<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagesController;
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

    Route::get('/create', '\App\Http\Controllers\AdminController@create')->name('admin.create');
    Route::post('/store', 'App\Http\Controllers\AdminController@store')->name('admin.store');

    Route::get('/edit/{id}', 'App\Http\Controllers\AdminController@edit');
    Route::post('/update', 'App\Http\Controllers\AdminController@update')->name('admin.update');

    Route::get('/delete/{id}', 'App\Http\Controllers\AdminController@destroy');
});

// Buyer Routes
Route::group(['prefix' => 'buyer', 'middleware' => ['role:2', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', 'App\Http\Controllers\BuyerController@index')->name('buyer.dashboard');
    Route::get('profile', 'App\Http\Controllers\BuyerController@profile')->name('buyer.profile');
    Route::get('settings', 'App\Http\Controllers\BuyerController@settings')->name('buyer.settings');

    Route::post('update-profile-info', 'App\Http\Controllers\BuyerController@updateInfo')->name('buyerUpdateInfo');
    Route::post('change-profile-picture', 'App\Http\Controllers\BuyerController@updatePicture')->name('buyerPictureUpdate');
    Route::post('change-password', 'App\Http\Controllers\BuyerController@changePassword')->name('buyerChangePassword');

    Route::get('product/{id}', 'App\Http\Controllers\BuyerController@detail');

    Route::post('add_to_cart', 'App\Http\Controllers\BuyerController@addToCart')->name('addToCart');
    Route::get('cart_list', 'App\Http\Controllers\BuyerController@cartList')->name('cartList');
    Route::get('/removecart/{id}', 'App\Http\Controllers\BuyerController@removeCart');

    Route::get('/checkout', 'App\Http\Controllers\BuyerController@checkout');

    Route::post('payment_stripe', [BuyerController::class, 'stripePost'])->name('stripe.payment');
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

Route::get('/chat', [HomeController::class, 'chat'])->name('chat');
Route::get('/load-latest-messages', [MessagesController::class, 'getLoadLatestMessages']);
Route::post('/send', [MessagesController::class, 'postSendMessage']);
Route::get('/fetch-old-messages', [MessagesController::class, 'getOldMessages']);
Route::get('/emit', function () {
    \App\Events\MessageSent::broadcast(\App\Models\User::find(1));
});