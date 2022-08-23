<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Design\ShopController;
use App\Http\Controllers\Admin\ProductController;

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



Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('shop', 'shop')->name('shop');
    Route::get('detail/{id}', 'show')->name('shop.details');
});

// admin dashboard routes
Route::group(['prefix'=> 'admin' , 'as' => 'admin.'] , function(){
    Route::view('/','admin.index')->name('main');// main page
    Route::get('/users', UserController::class)->name('users');
    Route::get('/products' ,[ProductController::class , 'index'])->name('products');
    Route::post('/products' ,[ProductController::class , 'store'])->name('products.store');
});
