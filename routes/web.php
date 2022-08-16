<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Design\ShopController;

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
Route::prefix('admin')->group(function () {
    Route::view('/','admin.index');// main page
});
