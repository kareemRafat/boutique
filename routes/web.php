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


// design routes
Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('shop', 'shop')->name('shop');
    Route::get('detail/{id}', 'show')->name('shop.details');
});

// admin dashboard routes
Route::group(['prefix'=> 'admin' , 'as' => 'admin.'] , function(){
    Route::view('/','admin.index')->name('main');// main page
    // users
    Route::get('/users', UserController::class)->name('users');
    // products
    Route::controller(ProductController::class)->group(function(){
        Route::get('/products' , 'index')->name('products');
        Route::post('/products' , 'store')->name('products.store');
        Route::get('/products/{id}' , 'edit')->name('products.edit');
        Route::post('/products/{id}' , 'update')->name('products.update');
    });
});
