<?php

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


Route::get('/', function () {
    return view('welcome');
});*/
//->middleware('auth')
Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard']);
Route::get('/order_confirmation', [App\Http\Controllers\HomeController::class, 'success']);
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search']);
Route::get('/details/{id}', [App\Http\Controllers\HomeController::class, 'details']);
Route::get('/delete_product', [App\Http\Controllers\RequestController::class, 'delete_product']);
Route::get('/checkout/{id}', [App\Http\Controllers\RequestController::class, 'checkout'])->name('add_to_cart');
Route::get('/cart/{id}', [App\Http\Controllers\RequestController::class, 'buy_now']);
Route::get('/shopping_cart', [App\Http\Controllers\RequestController::class, 'shopping_cart']);
Route::post('/checkout', [App\Http\Controllers\ContactController::class, 'cart_details']);
Route::post('/change_admin_password','App\Http\Controllers\RequestController@store_password')->name('update-password');
Route::get('contact','ContactController@index');
Route::post('contact-submit','ContactController@mailsending');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::delete('/delete/{id}',[App\Http\Controllers\RequestController::class, 'delete'])->middleware('auth');
Route::delete('/delete1/{id}',[App\Http\Controllers\RequestController::class, 'delete1'])->middleware('auth');
Route::get('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update')->middleware('auth');
Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update_product'])->name('update_products')->middleware('auth');
Route::get('/enter', [App\Http\Controllers\HomeController::class, 'entry'])->middleware('auth');
Route::post('/enter', [App\Http\Controllers\RequestController::class, 'store_products'])->name('store_products')->middleware('auth');
Route::get('/change_admin_password', [App\Http\Controllers\HomeController::class, 'change_password'])->name('home')->middleware('auth');
Route::get('/manage_orders', [App\Http\Controllers\RequestController::class, 'manage_orders'])->name('manage_orders')->middleware('auth');