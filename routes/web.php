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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/how_to_order', [App\Http\Controllers\HomeController::class, 'howToOrder'])->name('how-order-page');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about-page');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact-page');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product-page');
Route::get('/product/category/{slug}', [App\Http\Controllers\ProductController::class, 'productsByCategory'])
    ->name('productsByCategory');
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'productDetail'])
    ->name('productDetail');

Route::group(['middleware' => 'customerauth'], function () {
    Route::get('/purchase_order', [App\Http\Controllers\OrderController::class, 'create'])->name('purchase.order');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.customer');
});

/**
 * Routes for the admin panel.
 */
Route::group(['prefix' => 'admin'], function () {

    /**
     * Admin Authentication Routes
     */
    Route::get('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'index'])->name('admin-login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'process'])->name('admin-login-process');
    Route::post('/logout', [\App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin-logout');

    Route::group(['middleware' => 'adminauth:ADMIN'], function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        // route orders
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
            Route::get('/{status}/status', [App\Http\Controllers\Admin\OrderController::class, 'status_order'])->name('admin.orders.status');
            Route::get('/{code}/details', [App\Http\Controllers\Admin\OrderController::class, 'order_detail'])->name('admin.order.details');
        });
        // route invoice
        Route::get('/transaction', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transaction');
        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.report');


        // route master data
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
        Route::get('/products/{id}/galleries', [App\Http\Controllers\Admin\ProductGalleryController::class, 'index'])->name('product.galleries');
        Route::post('/products/galleries_upload', [App\Http\Controllers\Admin\ProductGalleryController::class, 'upload'])->name('galleries.upload');
        Route::post('/products/galleries_store', [App\Http\Controllers\Admin\ProductGalleryController::class, 'store'])->name('galleries.store');
        Route::get('/products/{id}/specifications', [App\Http\Controllers\Admin\ProductSpecificationController::class, 'index'])->name('product.specs');

        Route::resource('/customer', App\Http\Controllers\Admin\CustomerController::class);
        Route::patch('/customer/{id}/update_status',  [App\Http\Controllers\Admin\CustomerController::class, 'update_status'])->name('update.customer.status');
        Route::resource('/data_admin', App\Http\Controllers\Admin\AdminController::class);

        // route profile and settings
        Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('admin.setting');
    });
});

Route::get('/landing-page', function () {
    return view('landing');
});
