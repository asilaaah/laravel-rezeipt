<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'App\Http\Controllers\ApprovalController@approval')->name('approval');

    Route::middleware(['approved', 'manager'])->group(function () {
        Route::get('/manager/{user}', 'App\Http\Controllers\ManagerController@index')->name('manager');

        Route::get('/export', 'App\Http\Controllers\ImportExportController@export')->name('export');
        Route::post('/import', 'App\Http\Controllers\ImportExportController@import')->name('import');

        Route::get('/p/index', 'App\Http\Controllers\ProductsController@index');
        Route::get('/p/create', 'App\Http\Controllers\ProductsController@create');
        Route::post('/p', 'App\Http\Controllers\ProductsController@store');
        Route::get('/p/{product}', 'App\Http\Controllers\ProductsController@show')->name('product.show');
        Route::get('/p/{product}/edit', 'App\Http\Controllers\ProductsController@edit')->name('product.edit');
        Route::patch('/p/{product}', 'App\Http\Controllers\ProductsController@update')->name('product.update');
        Route::delete('/p/{product}','App\Http\Controllers\ProductsController@destroy')->name('product.delete');

        Route::get('/category/create', 'App\Http\Controllers\CategoryController@create');
        Route::post('/category', 'App\Http\Controllers\CategoryController@store');
        Route::get('/category/index', 'App\Http\Controllers\CategoryController@index');
        Route::get('/category/{category}', 'App\Http\Controllers\CategoryController@show');
        Route::get('/category/{category}/edit', 'App\Http\Controllers\CategoryController@edit');
        Route::patch('/category/{category}', 'App\Http\Controllers\CategoryController@update');
        Route::delete('/category/{category}','App\Http\Controllers\CategoryController@destroy')->name('category.delete');

        Route::get('/c/index', 'App\Http\Controllers\CashierController@index');
        Route::get('/c/{user}/edit', 'App\Http\Controllers\CashierController@edit')->name('cashier.edit');
        Route::patch('/c/{user}', 'App\Http\Controllers\CashierController@update')->name('cashier.update');
        Route::delete('/c/{user}','App\Http\Controllers\CashierController@destroy')->name('cashier.delete');

    });

    Route::middleware(['approved', 'cashier'])->group(function () {
        Route::get('/cashier/{user}', 'App\Http\Controllers\CartController@index')->name('cashier');
        Route::get('/product-list', 'App\Http\Controllers\CartController@productList')->name('cart.product-list');
        Route::post('/add-to-cart/{id}', 'App\Http\Controllers\CartController@addToCart')->name('cart.addToCart');
        Route::get('/cart', 'App\Http\Controllers\CartController@cart')->name('cart.cart');
        Route::get('/reduce/{id}', 'App\Http\Controllers\CartController@reduceByOne')->name('cart.reduceByOne');
        Route::get('/remove/{id}', 'App\Http\Controllers\CartController@removeItem')->name('cart.remove');

        Route::get('/qrcode', 'App\Http\Controllers\CartController@generateQRCode')->name('cart.qrcode');
        Route::get('/receipt/{id}', 'App\Http\Controllers\CartController@getReceipt')->name('cart.receipt');
        Route::match(['get', 'post'], '/payment', 'App\Http\Controllers\CartController@getChange')->name('cart.payment');
        Route::match(['get', 'post'], '/coupon', 'App\Http\Controllers\CartController@validateCode')->name('coupon.validate');
        Route::delete('/coupon','App\Http\Controllers\CartController@destroyCode')->name('coupon.destroy');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/{user}','App\Http\Controllers\ApprovalController@index');
        Route::get('/users', 'App\Http\Controllers\ApprovalController@approveList')->name('admin.users.index');
        Route::get('/users/{user}/approve', 'App\Http\Controllers\ApprovalController@approve')->name('admin.users.approve');
        Route::get('/store/index','App\Http\Controllers\StoreController@index');
        Route::get('/store/create','App\Http\Controllers\StoreController@create');
        Route::post('/store', 'App\Http\Controllers\StoreController@store');
        Route::get('/store/{store}/edit', 'App\Http\Controllers\StoreController@edit')->name('store.edit');
        Route::patch('/store/{store}', 'App\Http\Controllers\StoreController@update')->name('store.update');
        Route::delete('/store/{store}','App\Http\Controllers\StoreController@destroy')->name('store.delete');

        Route::get('/redemption/index','App\Http\Controllers\RedemptionController@index');
        Route::get('/redemption/create','App\Http\Controllers\RedemptionController@create');
        Route::post('/redemption', 'App\Http\Controllers\RedemptionController@store');
        Route::get('/redemption/{redemption}/edit', 'App\Http\Controllers\RedemptionController@edit')->name('redemption.edit');
        Route::patch('/redemption/{redemption}', 'App\Http\Controllers\RedemptionController@update')->name('redemption.update');
        Route::delete('/redemption/{redemption}','App\Http\Controllers\RedemptionController@destroy')->name('redemption.delete');
    });
});

Auth::routes();

Route::get('/profile/{user}', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfileController@edit');
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
Route::get('/profile/{user}/add/edit', 'App\Http\Controllers\ProfileController@editAdditional');
Route::patch('/profile/{user}/add', 'App\Http\Controllers\ProfileController@updateAdditional');
Route::get('/change-password', 'App\Http\Controllers\ChangePasswordController@index');
Route::post('/change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password');
