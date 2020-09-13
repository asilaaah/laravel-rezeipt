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

Auth::routes();

Route::get('/p/index', 'App\Http\Controllers\ProductsController@index');
Route::get('/p/create', 'App\Http\Controllers\ProductsController@create');
Route::post('/p', 'App\Http\Controllers\ProductsController@store');

Route::get('/manager/{user}', 'App\Http\Controllers\ManagerController@index' )->name('manager')->middleware('manager');
Route::get('/cashier/{user}', 'App\Http\Controllers\CashierController@index' )->name('cashier')->middleware('cashier');
