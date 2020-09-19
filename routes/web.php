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

Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'App\Http\Controllers\ApprovalController@approval')->name('approval');

    Route::middleware(['approved', 'manager'])->group(function () {
        Route::get('/manager', 'App\Http\Controllers\ManagerController@index')->name('manager');
    });

    Route::middleware(['approved', 'cashier'])->group(function () {
        Route::get('/cashier', 'App\Http\Controllers\CartController@index')->name('cart.users.index');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'App\Http\Controllers\ApprovalController@index')->name('admin.users.index');
        Route::get('/users/{user}/approve', 'App\Http\Controllers\ApprovalController@approve')->name('admin.users.approve');
    });
});

Auth::routes();

Route::get('/export', 'App\Http\Controllers\ImportExportController@export')->name('export');
Route::post('/import', 'App\Http\Controllers\ImportExportController@import')->name('import');

Route::get('/p/index', 'App\Http\Controllers\ProductsController@index');
Route::get('/p/create', 'App\Http\Controllers\ProductsController@create');
Route::post('/p', 'App\Http\Controllers\ProductsController@store');
Route::get('/p/{product}/edit', 'App\Http\Controllers\ProductsController@edit')->name('product.edit');
Route::patch('/p/{product}', 'App\Http\Controllers\ProductsController@update')->name('product.update');
Route::delete('/p/{product}','App\Http\Controllers\ProductsController@destroy')->name('product.delete');

Route::get('/category/create', 'App\Http\Controllers\CategoryController@create');
Route::post('/category', 'App\Http\Controllers\CategoryController@store');

Route::get('/c/index', 'App\Http\Controllers\CashierController@index');
Route::get('/c/{user}/edit', 'App\Http\Controllers\CashierController@edit')->name('cashier.edit');
Route::patch('/c/{user}', 'App\Http\Controllers\CashierController@update')->name('cashier.update');
Route::delete('/c/{user}','App\Http\Controllers\CashierController@destroy')->name('cashier.delete');

Route::get('/add-to-cart/{id}', 'App\Http\Controllers\ProductsController@getAddToCart')->name('product.addToCart');
Route::get('/cart', 'App\Http\Controllers\ProductsController@getCart')->name('product.cart');
