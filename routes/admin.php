<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes for admin // admin dashboard routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['as' => 'admin.' , 'middleware'=> ['auth:admin' , 'NoCache']] , function(){
    // main page
    Route::view('/','admin.index')->name('main');

    // users
    Route::get('/users', UserController::class)->name('users');

    // products
    Route::post('/products/{product}/image/{image}' , [ ProductController::class , 'destroy_image']);
    Route::post('/products/{product}/image' , [ ProductController::class , 'update_image']);
    Route::resource('/products', ProductController::class);
});

