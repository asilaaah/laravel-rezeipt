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
    Route::get('/approval', 'App\Http\Controllers\HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    });
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'App\Http\Controllers\UserController@index')->name('admin.users.index');
        Route::get('/users/{user_id}/approve', 'App\Http\Controllers\UserController@approve')->name('admin.users.approve');
    });
});

Auth::routes();

Route::get('/p/index', 'App\Http\Controllers\ProductsController@index');
Route::get('/p/create', 'App\Http\Controllers\ProductsController@create');
Route::post('/p', 'App\Http\Controllers\ProductsController@store');
Route::get('/p/{product}/edit', 'App\Http\Controllers\ProductsController@edit')->name('product.edit');
Route::patch('/p/{product}', 'App\Http\Controllers\ProductsController@update')->name('product.update');
Route::delete('/p/{product}','App\Http\Controllers\ProductsController@destroy')->name('product.delete');

Route::get('/category/create', 'App\Http\Controllers\CategoryController@create');
Route::post('/category', 'App\Http\Controllers\CategoryController@store');

Route::get('/c/index', 'App\Http\Controllers\CashierController@index');


Route::get('/manager/{user}', 'App\Http\Controllers\ManagerController@index')->name('manager')->middleware('manager');
Route::get('/cashier', 'App\Http\Controllers\CartController@index')->name('cart.index')->middleware('cashier');
