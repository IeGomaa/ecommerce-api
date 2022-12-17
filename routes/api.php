<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\EndUser\AuthController;
use App\Http\Controllers\EndUser\CartController;
use App\Http\Controllers\EndUser\CategoryController;
use App\Http\Controllers\EndUser\ClientController;
use App\Http\Controllers\EndUser\OrderController;
use App\Http\Controllers\EndUser\ProductController;
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
    Route::controller(AuthController::class)->group(function () {
        Route::post('login','login');
        Route::post('register','register');
    });
});

/**
 * EndUse Cycle
 */

Route::group(['prefix' => 'souq', 'middleware' => 'client.auth'], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('logout','logout');
        Route::post('refresh','refresh');
        Route::get('user-profile','userAccount');
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('index','index');
        Route::get('delete','delete');
        Route::post('update','update');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::controller(CartController::class)->group(function () {
            Route::get('/','clientCart');
            Route::post('create','addToCart');
            Route::post('delete','deleteFromCart');
            Route::get('delete','deleteCart');
            Route::post('update','updateCount');
        });
    });

    Route::group(['prefix' => 'category'], function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/','index');
        });
    });

    Route::group(['prefix' => 'product'], function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/','index');
        });
    });

    Route::group(['prefix' => 'order'], function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('/','index');
            Route::get('create','create');
        });
    });


});



/**
 * Admin Login Cycle
 */

Route::group(['prefix' => 'auth'], function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('login','login');
        Route::post('register','register');
    });
});

/**
 * Admin Cycle
 */

Route::group(['prefix' => 'admin'], function () {

    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('logout','logout');
        Route::post('refresh','refresh');
        Route::get('user-profile','userAccount');
    });

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
            Route::post('import','import');
            Route::get('export','exportDummyData');
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

});
