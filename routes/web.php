<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/**
 * Routes for the admin panel.
 */
Route::group(['prefix' => 'admin'], function () {

    /**
     * Admin Authentication Routes
     */
    Route::get('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'index'])->name('admin-login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'process'])->name('admin-login-process');
    Route::get('/logout', [\App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin-logout');

    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
            Route::get('/processed', [App\Http\Controllers\Admin\OrderController::class, 'procesed_order'])->name('processed.orders');
            Route::get('/finished', [App\Http\Controllers\Admin\OrderController::class, 'finished_order'])->name('finished.orders');
        });
        Route::get('/transaction', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transaction');
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('/customer', App\Http\Controllers\Admin\CustomerController::class);
    });
});

Route::get('/landing-page', function() {
    return view('landing');
});
