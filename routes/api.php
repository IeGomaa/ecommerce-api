<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\EndUser\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * EndUser Login Cycle
 */

Route::group(['prefix' => '/'], function () {
    Route::controller(ClientController::class)->group(function () {
        Route::post('login','login');
        Route::post('register','register');
    });
});

/**
 * EndUse Cycle
 */


/**
 * Admin Login Cycle
 */

Route::group(['prefix' => 'auth'], function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('login','login');
    });
});

/**
 * Admin Cycle
 */

Route::group(['prefix' => 'category', 'middleware' => 'jwt.verify'], function () {
    Route::controller(AdminCategoryController::class)->group(function () {
        Route::get('/','index');
        Route::post('create','create');
        Route::post('delete','delete');
        Route::post('update','update');
    });
});

Route::group(['prefix' => 'product', 'middleware' => 'jwt.verify'], function () {
    Route::controller(AdminProductController::class)->group(function () {
        Route::get('/','index');
        Route::post('create','create');
        Route::post('delete','delete');
        Route::post('update','update');
    });
});

Route::group(['prefix' => 'client', 'middleware' => 'jwt.verify'], function () {
    Route::controller(AdminClientController::class)->group(function () {
        Route::get('/','index');
        Route::post('delete','delete');
    });
});

Route::group(['prefix' => 'order', 'middleware' => 'jwt.verify'], function () {
    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('/','index');
        Route::post('delete','delete');
    });
});

